<?php
/**
 * Created by PhpStorm.
 * User: guy
 * Date: 25/07/17
 * Time: 12:11
 */

require 'mysql_connection.php';

$conn = createConnection();
$sql = prepareQuery("categories",["name"], ['Insurance', 'Services', 'Taxes', 'Check Payment', 'Loans', 'Rewards', 'Deposits', 'Transfers', 'Credit Card Payments', 'Uncategorized']);
$res = runQuery($conn, $sql, ["name"]);
echo showResult($res);