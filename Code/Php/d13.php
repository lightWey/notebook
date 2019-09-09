<?php
$a = '12345';
$b = '00235';

$strLenOfA = strlen($a);
$strLenOfB = strlen($b);

$cha = $strLenOfB - $strLenOfA;

$maxLen = $cha >= 0 ? $strLenOfB : $strLenOfA;

$j = abs($cha);

$b = str_pad($b,$maxLen,0,STR_PAD_LEFT);

$arrOfA = $arrOfB = [];

for ($i=0;$i<$maxLen;$i++) {
    $arrOfA[] = $a[$i];
    $arrOfB[] = $b[$i];
}
$sum = [];
$jin = 0;
for ($i=$maxLen-1;$i>=0;$i--) {
    $ji = $arrOfA[$i] + $arrOfB[$i] + $jin;
    if ($ji - 10 >= 0) {
        $jin = 1;
        $sum[] = $ji-10;
    } else {
        $jin = 0;
        $sum[] = $ji;
    }
}

$a = 'a=1&b=2&c=3&b=4&c=5';

parse_str($a, $b);
print_r($b);

$b = str_replace('&', ',', $a);
$b = '{'.$b.'}';


