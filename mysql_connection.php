<?php
/**
 * Created by PhpStorm.
 * User: guy
 * Date: 25/07/17
 * Time: 10:26
 */

/**
 * @return PDO|null
 */
function createConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "pesemv6";
    $dbname = "test_yukon";
    $sql = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    return $conn = null;
}

/**
 * @param $table string
 * @param $cols array
 * @param $data array
 * @return string
 * @throws Exception
 */
function prepareQuery($table, $cols, $data) {
    if (count($data ) < 1) throw new Exception("no data to insert");

    $fields = implode(",", $cols);

    $n = 0;
    $executeData = [];
    $sql = [];

    foreach ($data as $key => $value) {

        // category array simple insert
        if (gettype($value) == "string") {
            $sql[] = "(:name" . $n . ")";
            $executeData['name' . $n] = $value;
            $n++;
        } // transactions array insert with multiple fields
        else {
            // get the category from the first col in the csv file
            $executeData['name' . $n] = (string)$value[0];
            // get the price from the second col in the csv file
            $executeData['price' . $n] = (int)$value[1];
            // get category id from categories table from category name
            $category_id = "(SELECT id from categories where name=:name" . $n . ")";

            // add sql query row for each of the transactions
            $sql[] = "(:price" . $n . ", $category_id)";

            $n++;

        }
    }


    // sql array to string with commas
    $sql = sprintf("INSERT INTO %s (%s) VALUES ", $table, $fields) . implode(', ', $sql);

    // return the sql query and data
    return (object)[ "sql" => $sql, "data" => $executeData ];
}

/**
 * @param PDO $conn
 * @param $sql_data
 * @param $cols
 * @return PDOStatement
 */
function runQuery(PDO $conn, $sql_data, $cols) {

    // Prepare query
    $query = $conn->prepare($sql_data->sql);

    // execute the query
    $query->execute($sql_data->data);

    return $query;
}

/**
 * @param $res PDOStatement
 * @return string
 */
function showResult($res) {
    // return a message
    return $res->rowCount() . " records ADDED successfully";
}