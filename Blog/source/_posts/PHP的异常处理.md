---
title: PHP的异常处理
date: 2016-02-17 19:23:39
updated: 2016-02-17 19:23:39
tags: [异常处理, PHP, exception]
categories: [语言, PHP]
---

## 起因
昨天晚上，看了下顺平老师的视频，原来一直没用到过php的异常处理，今天写一篇，记录下，先来了解下异常处理

<!-- more -->

## 什么是异常处理
异常处理（又称为错误处理）功能提供了处理程序运行时出现的错误或异常情况的方法。异常处理通常是防止未知错误产生所采取的处理措施。异常处理的好处是你不用再绞尽脑汁去考虑各种错误，这为处理某一类错误提供了一个很有效的方法，使编程效率大大提高。当异常被触发时，通常会发生：

- 当前代码状态被保存
- 代码执行被切换到预定义的异常处理器函数

根据情况，处理器也许会从保存的代码状态重新开始执行代码，终止脚本执行，或从代码中另外的位置继续执行脚本PHP 5 提供了一种新的面向对象的错误处理方法。可以使用检测（try）、抛出（throw）和捕获（catch）异常。即使用try检测有没有抛出（throw）异常，若有异常抛出（throw），使用catch捕获异常。一个 try 至少要有一个与之对应的 catch。定义多个 catch 可以捕获不同的对象。

PHP 会按这些 catch 被定义的顺序执行，直到完成最后一个为止。而在这些 catch 内，又可以抛出新的异常。

## 实践

说的可能有点迷糊，直接上代码

``` php
tyy {
	//可能会出现错误的代码放到这里
} catch (Exception $e) {
	//捕获到错误后的处理代码
}
```

太基础的也就不说了，说说自己遇到的，抛出了异常，一定要捕获（也可以自己定义顶级异常处理），不然会产生一个错误

``` php
<?php
function a($a){
    if($a>5){
        echo "您输入的值是".$a;
    }else{
        throw new Exception("本方法只接受大于5的数据");
    }
}
 
function b($b){
    if($b<5){
        echo "您输入的值是".$b;
    }else{
        throw new Exception("本方法只接受大于5的数据");
    }
}
a(5);
```

以上代码会产生如下错误

``` php
Fatal error: Uncaught exception 'Exception' with message '本方法只接受大于5的数据' in E:\WWW\pdemo\demo5.php:6
Stack trace:
#0 E:\WWW\pdemo\demo5.php(17): a(5)
#1 C:\Users\Administrator\AppData\Local\Temp\dummy.php(1): include('E:\\WWW\\pdemo\\de...')
#2 {main}
  thrown in E:\WWW\pdemo\demo5.php on line 6
```

很显然这不是我们想看到的，我们需要定义捕获这段异常的代码

``` php
<?php
function a($a){
    if($a>5){
        echo "您输入的值是".$a;
    }else{
        throw new Exception("本方法只接受大于5的数据");
    }
}
 
function b($b){
    if($b<5){
        echo "您输入的值是".$b;
    }else{
        throw new Exception("本方法只接受大于5的数据");
    }
}
try {
    a(5);
    echo "hello";
}catch (Exception $e){
    echo $e->getMessage()."<br />"; //获得异常信息
    echo $e->getCode()."<br />"; //获得异常代码
    echo $e->getFile()."<br />"; //获得异常文件
    echo $e->getLine()."<br />"; //返回异常行数
}
```

更多的内容可以去PHP的内置异常处理可以在手册/语言参考/[异常处理](https://www.php.net/manual/zh/class.exception.php)里面找到