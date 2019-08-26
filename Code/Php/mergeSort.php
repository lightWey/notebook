<?php
/**
 * Created by PhpStorm.
 * User: bocai@ibantang.com
 * Date: 2019-08-26
 * Time: 18:00
 */

/**
 * @param array $arr
 */
function index(array &$arr)
{
    $start = 0;
    $end = count($arr) - 1;
    mSort($arr, $start, $end);
}

/**
 * @param array $arr
 * @param int $start
 * @param int $end
 * @return void
 */
function mSort(array &$arr, int $start, int $end)
{
    if ($start < $end) {
        echo '----',PHP_EOL;
        $mid = floor(($start + $end) / 2);
        print_r([$start, $mid, $end]);
        mSort($arr, $start, $mid);
        mSort($arr, $mid + 1, $end);
        merge($arr, $start, $mid, $end);
    }
}


/**
 * @param array $arr
 * @param int $start
 * @param int $mid
 * @param int $end
 */
function merge(array &$arr, int $start, int $mid, int $end)
{
    print_r([$start, $mid, $end]);
    echo '----',PHP_EOL;
    $i = $start;
    $j = $mid + 1;
    $k = $start;
    $tempArr = [];

    while ($i != $mid + 1 && $j != $end + 1) {
        if ($arr[$i] >= $arr[$j]) {
            $tempArr[$k++] = $arr[$j++];
        } else {
            $tempArr[$k++] = $arr[$i++];
        }
    }

    while ($i != $mid + 1) {
        $tempArr[$k++] = $arr[$i++];
    }

    while ($j != $end + 1) {
        $tempArr[$k++] = $arr[$j++];
    }

    for ($i = $start; $i <= $end; $i++) {
        $arr[$i] = $tempArr[$i];
    }
}

$arr = [2,4,1,5,3];

index($arr);

//print_r($arr);