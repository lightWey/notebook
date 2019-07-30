---
title: PHP中empty()和isset()的区别
date: 2016-02-20 09:37:36
updated: 2016-02-20 09:37:36
tags: [empty, isset, PHP]
categories: [语言, PHP]
---

## 起因
虽然记得，"empty()" 是检测变量是否为空，"isset()"是检测变量是否设置，但是有时候还是容易凌乱，看千遍不如自己写一遍。

手册中是这样定义的...

<!-- more -->

### empty
> 判断一个变量是否被认为是空的，当一个变量并不存在，或者它的值等同于FALSE，那么它会被认为不存在。如果变量不存在的话，"empty"并不会产生警告。

### isset
> 检测变量是否设置，并且不是NULL。如果已经使用了 "unset" 释放了一个变量后，它将不再是 "isset()" 。若使用 "isset()" 测试一个被设置成NULL的变量，将返回FALSE。同时要注意的是一个NULL字节（"\0"）并不等同于PHP的NULL常数。

## 实践
### 代码
下面我们来代码里面看看

``` php
<?php
 
    $a = null;
    $b = 'null';
    $c = 0;
    $d = '0';
    $e = '';
    $f = ' ';
    $g;
    $i = FALSE;
    $j = 'false';
 
    echo '$a的类型是'.gettype($a).'<br />'; //$a的类型是NULL
    echo '$b的类型是'.gettype($b).'<br />'; //$b的类型是string
    echo '$c的类型是'.gettype($c).'<br />'; //$c的类型是integer
    echo '$d的类型是'.gettype($d).'<br />'; //$d的类型是string
    echo '$e的类型是'.gettype($e).'<br />'; //$e的类型是string
    echo '$f的类型是'.gettype($f).'<br />'; //$f的类型是string
    echo '$g的类型是'.gettype($g).'<br />'; //Notice: Undefined variable: g in E:\WWW\pdemo\demo6.php on line 17 $g的类型是NULL
    echo '$i的类型是'.gettype($i).'<br />'; //$i的类型是boolean
    echo '$j的类型是'.gettype($j).'<br />'; //$j的类型是string
    
    echo "<pre>";
 
    echo '$a isset()后的结果：';
    var_dump(isset($a)); //$a isset()后的结果：bool(false)
 
    echo '$b isset()后的结果：';
    var_dump(isset($b)); //$b isset()后的结果：bool(true)
 
    echo '$c isset()后的结果：';
    var_dump(isset($c)); //$c isset()后的结果：bool(true)
 
    echo '$d isset()后的结果：';
    var_dump(isset($d)); //$d isset()后的结果：bool(true)
 
    echo '$e isset()后的结果：';
    var_dump(isset($e)); //$e isset()后的结果：bool(true)
 
    echo '$f isset()后的结果：';
    var_dump(isset($f)); //$f isset()后的结果：bool(true)
 
    echo '$g isset()后的结果：';
    var_dump(isset($g)); //$g isset()后的结果：bool(false)
 
    echo '未定义变量isset()后的结果：';
    var_dump(isset($h)); //未定义变量isset()后的结果：bool(false)
 
    echo '$i isset()后的结果：';
    var_dump(isset($i)); //$g isset()后的结果：bool(false)
 
    echo '$j isset()后的结果：';
    var_dump(isset($j)); //$g isset()后的结果：bool(false)
 
    echo "<hr />";
 
    echo '$a empty()后的结果：';
    var_dump(empty($a)); //$a empty()后的结果：bool(true)
 
    echo '$b empty()后的结果：';
    var_dump(empty($b)); //$b empty()后的结果：bool(false)
 
    echo '$c empty()后的结果：';
    var_dump(empty($c)); //$c empty()后的结果：bool(true)
 
    echo '$d empty()后的结果：';
    var_dump(empty($d)); //$d empty()后的结果：bool(true)
 
    echo '$e empty()后的结果：';
    var_dump(empty($e)); //$e empty()后的结果：bool(true)
 
    echo '$f empty()后的结果：';
    var_dump(empty($f)); //$f empty()后的结果：bool(false)
 
    echo '$g empty()后的结果：';
    var_dump(empty($g)); //$g empty()后的结果：bool(true)
 
    echo '未定义变量empty()后的结果：';
    var_dump(empty($h)); //未定义变量empty()后的结果：bool(true)
 
    echo '$i empty()后的结果：';
    var_dump(empty($i)); //$g empty()后的结果：bool(true)
 
    echo '$j empty()后的结果：';
    var_dump(empty($j)); //$g empty()后的结果：bool(true)
```
### 结果

运行结果如下图所示：
![执行结果](https://img-blog.csdn.net/20160220105233133)

### 结论

看的出来， `isset()`  把值为`NULL`的`null`类型的和没赋值的，没定义的变量，认为是空，返回`FALSE`;  `empty()` 把 值为`null`的`null`类型的，`integer`类型的`0`，字符串类型的`0`，字符串类型的 '' ，未定义的变量，布尔类型的`false`，认为是空，返回`TRUE`。

不过有意思的是 `‘’`判断为空返回`TRUE`，`‘ ’`却判断不为空，返回`FALSE`。

## 完
结果就是这样了，大家可以看看，或者运行下。