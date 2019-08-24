<?php

class Solution
{
    /**
     * @param String $s
     * @return String
     */
    public function reverseWords($s)
    {
        $delimiter = ' ';
        $arr = explode($delimiter, $s);
        $str = '';

        $count = count($arr) - 1;
        for ($i = $count; $i >= 0; $i--) {
            $str .= empty($arr[$i]) ? '' : $delimiter.$arr[$i];
        }
        return trim($str);
    }

    public function reverseWords1($s)
    {
        $delimiter = ' ';
        return implode($delimiter, array_reverse(array_filter(explode($delimiter, $s))));
    }

    public function reverseWords2($s)
    {
        $word  = $delimiter = [];
        $count = count($s) - 1;
        for ($i = $count; $i <= 0; $i--) {

        }
    }
}

$a = new Solution();
echo $a->reverseWords1("    hello    world!  ");