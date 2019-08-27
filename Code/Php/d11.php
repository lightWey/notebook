<?php

function index (&$arr)
{
    $len = count($arr);
    cut($arr, 0, $len-1);
}

function cut(&$arr, $left, $right)
{
    print_r([$left, $right]);
    if ($left != $right) {
        $mid = floor(($left + $right)/2);
        cut($arr, $left, $mid);
        cut($arr, $mid+1, $right);
    }
}

$arr = [2,4,3,5,1];
index($arr);