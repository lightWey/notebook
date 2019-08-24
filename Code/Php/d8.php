<?php

class ListNode {

     public $val = 0;
     public $next = null;

     function __construct($val)
     {
         $this->val = $val;
     }
}


class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2)
    {
        $l = $l1;
        $carry = 0;
        $flag = true;

        while ($flag) {
            $l1->val = $l1->val + $carry;
            $carry = 0;
            $sum = $l1->val + $l2->val;
            if ($sum < 10) {
                $l1->val = $sum;
            } else {
                $carry = 1;
                $l1->val = $sum - 10;
            }

            if ($l2->next && !$l1->next) {
                $l1->next = new ListNode(0);
            }

            if ($l1->next && !$l2->next) {
                $l2->next = new ListNode(0);
            }

            $flag = isset($l1->next) && isset($l2->next);

            if (!$flag && $carry) {
                $l1->next = new ListNode($carry);
            }

            $l2 = $l2->next;
            $l1 = $l1->next;

        }
        return $l;
    }
}

$l1 = new ListNode(9);
$l1->next = new ListNode(8);
//$l1->next->next = new ListNode(3);

$l2 = new ListNode(1);
//$l2->next = new ListNode(3);
//$l2->next->next = new ListNode(4);

$obj = new Solution();
$data = $obj->addTwoNumbers($l1, $l2);
var_dump($data);
