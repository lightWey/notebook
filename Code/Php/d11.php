<?php

function index (&$arr)
{
    $len = count($arr);
    cut($arr, 0, $len-1);
}

function cut(&$arr, $left, $right)
{
    if ($left == $right) {
        return;
    }

    $mid = floor(($left + $right)/2);
    cut($arr, $left, $mid);
    cut($arr, $mid+1, $right);
    merge($arr, $left, $mid, $right);
}

function merge(&$arr, $left, $mid, $right)
{
    print_r([$left,$mid, $right]);

    $temp = [];
    $l = $left;
    $r = $mid+1;

    while ($l <= $mid && $r <= $right) {
        $temp[] = min($arr[$l], $arr[$r]);
        $l++;$r++;
    }

    print_r($temp);
}

$arr = [2,4,3,5,1];
index($arr);

//print_r($arr);