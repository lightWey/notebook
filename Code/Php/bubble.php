<?php
$arr = [1,3,5,2,4];

$len = count($arr);

for ($i=1;$i<$len;$i++) {
    for ($j=0;$j<$len-1;$j++) {
        if ($arr[$j] > $arr[$j + 1]) {
            $tmp = $arr[$j];
            $arr[$j] = $arr[$j + 1];
            $arr[$j + 1] = $tmp;
        }
    }
}

print_r($arr);