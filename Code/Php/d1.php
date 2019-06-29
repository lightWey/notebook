<?php

$arr = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];
$newArr = [];
foreach ( $arr as $row ) {
    $newArr[0][] = $row[0];
    $newArr[1][] = $row[1];
    $newArr[2][] = $row[2];
}

print_r($newArr);

//foreach ($newArr as &$item) {
//    rsort($item);
//}

echo "<pre>";print_r($newArr);