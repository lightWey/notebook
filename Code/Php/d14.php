<?php
/**
 * 手写冒泡
 */

/**
 * @param array $array
 */
function bubble(array $array)
{
    $count = count($array);

    for ($i=0;$i<$count;$i++) {
        for ($j=0;$j<$count-1;$j++) {
            echo $i,'-',$j,':',$j+1,PHP_EOL;
            if ($array[$j] > $array[$j+1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j+1];
                $array[$j+1] = $temp;
            }
        }
    }
    return $array;
}

function select($arr) {
    $len=count($arr);
     for($i=0; $i<$len-1; $i++) {
         //先假设最小的值的位置
         $p = $i;

         for($j=$i+1; $j<$len; $j++) {
             if($arr[$p] > $arr[$j]) {
                 $p = $j;
             }
         }
         //已经确定了当前的最小值的位置，保存到$p中。如果发现最小值的位置与当前假设的位置$i不同，则位置互换即可。
         if($p != $i) {
             $tmp = $arr[$p];
             $arr[$p] = $arr[$i];
             $arr[$i] = $tmp;
         }
     }
     //返回最终结果
     return $arr;
 }

 function quick($arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }
    $middle = $arr[0];
    $left = $right = [];

    for ($i=0;$i<count($arr);$i++) {
        if ($arr[$i] > $middle) {
            $right[] = $arr[$i];
        } else {
            $left[] = $arr[$i];
        }
    }
    print_r($left);print_r($right);

//    $left = quick($left);
//    $right = quick($right);
    //return array_merge($left, [$middle], $right);
}

function quick_sort($a)
{
    // 判断是否需要运行，因下面已拿出一个中间值，这里<=1
    if (count($a) <= 1) {
        return $a;
    }

    $middle = $a[0]; // 中间值

    $left = array(); // 接收小于中间值
    $right = array();// 接收大于中间值

    // 循环比较
    for ($i=1; $i < count($a); $i++) {

        if ($middle < $a[$i]) {

            // 大于中间值
            $right[] = $a[$i];
        } else {

            // 小于中间值
            $left[] = $a[$i];
        }
    }

    // 递归排序划分好的2边
    $left = quick_sort($left);
    $right = quick_sort($right);

    // 合并排序后的数据，别忘了合并中间值
    return array_merge($left, array($middle), $right);
}


$arr = [4,1,5,3,6,2];
print_r(quick($arr));

