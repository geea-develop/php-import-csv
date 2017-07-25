<?php
/**
 * Created by PhpStorm.
 * User: guy
 * Date: 25/07/17
 * Time: 09:40
 */

// import the DB connection helper file
require 'mysql_connection.php';

// create the sql db connection
$conn = createConnection();

// retrieve data from the csv file
$csv = array_map('str_getcsv', file('transactions.csv'));

// remove titles
array_shift($csv);

if (count($csv) / 50 > 1) {
    $chunks = array_chunk($csv, 50);

    // insert in chunks
    foreach ($chunks as $chunk) {
        addChunk($chunk, $conn);
    }
} else {

    addChunk($csv, $conn);
}

function addChunk($chunk, $conn) {
    // set the table cols
    $cols = ["price", "category_id"];

    // create the sql query
    $sql_data = prepareQuery("transactions", $cols, $chunk);

    // prepare and execute
    $res = runQuery($conn, $sql_data, $cols);

    // echo the result
    echo nl2br(showResult($res) . "\n");

}