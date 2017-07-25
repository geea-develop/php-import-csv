<?php
/**
 * Created by PhpStorm.
 * User: guy
 * Date: 25/07/17
 * Time: 10:09
 */


function getRandomCategory() {
    $categories = ['Insurance', 'Services', 'Taxes', 'Check Payment', 'Loans', 'Rewards', 'Deposits', 'Transfers', 'Credit Card Payments', 'Uncategorized'];
    $max = count($categories) - 1;
    return $categories[rand(0,$max)];
}

function getRandomPrice() {
    return rand( 100, 10000 );
}

$generate = 1000;

$html = "<table cellpadding='10' cellspacing='1' border='1'>";
$html .= "<tr><th>Category</th><th>Price</th></tr>";

for ($i = 0; $i <= $generate; $i++) {
    $html .= "<tr><td>" . getRandomCategory() . "</td><td>" . getRandomPrice() . "</td></tr>";
}

$html .= "</table>";

echo $html;