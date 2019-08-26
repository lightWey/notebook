<?php

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        $a = [];
        $b = strlen($s);

        for ($i=0; $i<$b; $i++) {
            if (isset($a[$s[$i]])) {
                $a = [];
            } else {
                $a[$s[$i]] = $i;
            }
        }
        return count($a);
    }
}

$obj = new Solution();
echo $obj->lengthOfLongestSubstring("pwwkew");