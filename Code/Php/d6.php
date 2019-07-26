<?php
class Solution
{
function twoSum($nums, $target) {
    if (!empty($nums)) {
        $array = array_flip($nums);
        print_r($array);
        foreach ($nums as $key => $value) {
            if ($target > 0) {
                if ($value > $target) {
                    continue;
                }
            } else {
                if ($value < $target) {
                    continue;
                }
            }
            $difference = $target - $value;
            if (isset($array[$difference]) && $array[$difference] != $key) {
                return [$key, $array[$difference]];
            }
        }
    }
    return [0,0];
}
}

$obj = new Solution();

$result = $obj->twoSum([-1,-2,-3,-4,-5], -8);
print_r($result);