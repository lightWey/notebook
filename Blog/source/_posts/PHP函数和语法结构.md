---
title: PHP函数和语法结构
date: 2016-02-23 17:17:56
updated: 2016-02-23 17:17:56
tags: [PHP]
categories: [语言, PHP]
---

## 问题

我们先来看看语言结构和函数的区别

###  什么是语言结构和函数

#### 语言结果
语言结构就是PHP语言的关键词，语言语法的一部分；它不可以被用户定义或者添加到语言扩展或者库中；它可以有也可以没有变量和返回值。

<!-- more -->

#### 函数
函数是由代码块组成的，可以复用。

### 语言结构为什么比函数快
原因是在PHP中，函数都要先被PHP解析器分解成语言结构，所以有此可见，函数比语言结构多了一层解析器解析。这样就能比较好的理解为什么语言结构比函数快了。

### 语言结构和函数的不同
1. 语言结构比对应功能的函数快
2. 语言结构在错误处理上比较鲁棒，由于是语言关键词，所以不具备再处理的环节
3. 语言结构不能在配置项(php.ini)中禁用，函数则可以。
4. 语言结构不能被用做回调函数


## 实践
看看常见的，混淆我们视听的语法结构和函数有哪些吧

``` php
echo "<pre>";
 
echo "list ：";
var_dump(function_exists('list'));
 
echo "print ：";
var_dump(function_exists('print'));
 
echo "array ：";
var_dump(function_exists('array'));
 
echo "list ：";
var_dump(function_exists('list'));
 
echo "echo ：";
var_dump(function_exists('echo'));
 
echo "include ：";
var_dump(function_exists('include'));
 
echo "require ：";
var_dump(function_exists('require'));
```

运行结果如下图所示

![运行结果](https://img-blog.csdn.net/20160223173151591?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast)

以上是常见的一些容易混淆的，语言结构，非函数，面试的时候可能会遇到问这样的问题
