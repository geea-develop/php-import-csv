<?php
/**
 * Created by PhpStorm.
 * User: guy
 * Date: 25/07/17
 * Time: 15:50
 */

// Write a function that receives two parameters: array of integers, and an additional integer, which returns ‘true’ if any combination of the integers inside the array sums up to the second parameter.

$generate = 10;
$array1 = [];
$number = rand(1,99);

for ($i = 0; $i <= $generate; $i++) {
    $array1[] = rand(1,99);
}

echo nl2br("hello \n\n");

function findSums($array, $number) {
    // run through all the numbers
    for($n = 0; $n < count($array); $n++) {

        // add each number and the next number until end of array; (ignore previous numbers)
        for($j = $n; $j < count($array); $j++) {

            // if the sum equals the number return true;
            if ($array[$n]+$array[$j] == $number) return true;
        }
    }

    // if no true sum found return false;
    return false;
}

echo nl2br("Array1: \n");
foreach ($array1 as $number) {
    echo nl2br($number . "\n");
}
echo nl2br("\n\n");

echo nl2br("Number: " . $number . " \n\n");

echo nl2br("Result: \n");
var_dump(findSums($array1, $number));