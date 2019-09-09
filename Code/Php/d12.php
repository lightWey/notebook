<?php

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}

class Solution
{

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n)
    {
        $dummy = new ListNode(0);
        $dummy->next = $head;
        $first = $head;
        $length = 0;

        while ($first) {
            $length ++;
            $first = $first->next;
        }
        $length -= $n;
        $first = $dummy;

        while ($length > 0) {
            $first = $first->next;
            $length --;
        }

        $first->next = $first->next->next;
        return $dummy->next;
    }
}


$data = [1,2,3,4];

foreach ($data as $key => $val) {
    $temp = 'd'.$key;
    $$temp = new ListNode($val);
}


$count = count($data);

for ($i=$count-1;$i>=0;$i--) {
    if ($i == 0) {
        break;
    }

    $preTemp = 'd'.($i-1);
    $temp = 'd'.$i;
    $$preTemp->next = $$temp;
}

$head = $d0;


$obj = new Solution();
var_dump($obj->removeNthFromEnd($head,2));





