<?php

class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $m = count($nums1);
        $n = count($nums2);
        if($m>$n){
            return $this->findMedianSortedArrays($nums2, $nums1);
        }
        $iMin = 0;$iMax = $m;
        while($iMin <= $iMax){
            $i = floor(($iMin + $iMax)/2);
            $j = floor(($m + $n + 1)/2) - $i;
            if($j!=0 && $i!=$m && $nums2[$j-1]>$nums1[$i]){
                $iMin = $i + 1;
            }else if($i!=0 && $j!=$n && $nums1[$i-1]>$nums2[$j]){
                $iMax = $i - 1;
            }else{
                $maxLeft = 0;
                if($i == 0){ $maxLeft = $nums2[$j-1]; }
                else if($j == 0){ $maxLeft = $nums1[$i-1]; }
                else { $maxLeft = max($nums1[$i-1], $nums2[$j-1]); }
                if(($m + $n) % 2 == 1) return $maxLeft;

                $minRight = 0;
                if ($i == $m) { $minRight = $nums2[$j]; }
                else if ($j == $n) { $minRight = $nums1[$i]; }
                else { $minRight = min($nums2[$j], $nums1[$i]); }

                return ($maxLeft + $minRight)/2;
            }
        }
        return 0;
    }

    function findMedianSortedArrays1($nums1, $nums2)
    {
        $l1 = count($nums1);
        $l2 = count($nums2);
        $merge = array_merge($nums1, $nums2);
        sort($merge);

        $m = ($l1+$l2)/2;

        if (is_float($m)) {
            $middle = ceil($m) -1;
            return $merge[$middle];
        } else {
            $middle = $m;
            return ($merge[$middle-1] + $merge[$middle])/2;
        }
    }
}

$nums1 = [1,3];
$nums2 = [2];
$obj = new Solution();
echo $obj->findMedianSortedArrays1($nums1, $nums2);