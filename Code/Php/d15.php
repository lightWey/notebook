<?php

$str = "z123abc456efg78h";
$j = $n = $k = false;
for ($i=0; $i < strlen($str); $i++) {
    $k = is_numeric($str[$i]);
    if (empty($i)) {
        $j = $k;
        echo $str[$i];
    } else {
        if ($k === $j && $k !== $n) {
            echo PHP_EOL;
        }

        if ($k !== $j && $k !== $n) {
            echo ':';
        }

        echo $str[$i];
    } 
    $n = $k;
    
}