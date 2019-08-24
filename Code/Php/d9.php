<?php

class Example
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

$ex1 = new Example('test1');// $ex1->name现在是：test1
$ex2 = $ex1;// $ex2->name现在是：test1

$ex1->name = 'test2';// 这样修改一下之后，$ex1->name与$ex2->name都变为了：test2

var_dump($ex1);
var_dump($ex2);