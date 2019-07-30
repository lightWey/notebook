---
title: PHP命名空间
date: 2019-08-23 10:19:15
updated: 2019-08-23 10:19:15
tags: [PHP, namespace]
categories: [语言, PHP]
---

## 介绍
什么是命名空间？从广义上来说，命名空间是一种封装事物的方法。在很多地方都可以见到这种抽象概念。

例如，在操作系统中目录用来将相关文件分组，对于目录中的文件来说，它就扮演了命名空间的角色。具体举个例子，文件 `foo.txt` 可以同时在目录`/home/greg` 和 `/home/other` 中存在，但在同一个目录中不能存在两个 `foo.txt` 文件。另外，在目录 `/home/greg` 外访问 `foo.txt` 文件时，我们必须将目录名以及目录分隔符放在文件名之前得到 `/home/greg/foo.txt`。这个原理应用到程序设计领域就是命名空间的概念。

<!-- more -->

## 使用方式

在`PHP`中，命名空间用来解决在编写类库或应用程序时创建可重用的代码如类或函数时碰到的两类问题：

1. 用户编写的代码与`PHP`内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。
2. 为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。

必须注意的是，php也有保留一些关键字，官方的notice是这样说的
>名为PHP或php的命名空间，以及以这些名字开头的命名空间（例如PHP\Classes）被保留用作语言内核使用，而不应该在用户空间的代码中使用。
>
>只有类（包括抽象类和`traits`）、接口、函数和常量受命名空间的影响

命名空间通过关键字`namespace` 来声明。如果一个文件中包含命名空间，它必须在其它所有代码之前声明命名空间，除了一个以外：`declare`关键字。

PHP 命名空间中的元素使用同样的原理。例如，类名可以通过三种方式引用：

### 非限定名称
非限定名称，或不包含前缀的类名称，例如 `$a=new foo()`; 或 `foo::staticmethod();`。如果当前命名空间是 `currentnamespace`，`foo` 将被解析为`currentnamespace\foo`。如果使用 `foo` 的代码是全局的，不包含在任何命名空间中的代码，则 `foo` 会被解析为`foo`。 警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。详情参见 [使用命名空间：后备全局函数名称/常量名称](https://php.net/manual/zh/language.namespaces.fallback.php)。

### 限定名称
限定名称,或包含前缀的名称，例如 `$a = new subnamespace\foo();` 或 `subnamespace\foo::staticmethod();`。如果当前的命名空间是`currentnamespace`，则 `foo` 会被解析为 `currentnamespace\subnamespace\foo`。如果使用 `foo` 的代码是全局的，不包含在任何命名空间中的代码，`foo` 会被解析为`subnamespace\foo`。

### 完全限定名称
完全限定名称，或包含了全局前缀操作符的名称，例如， `$a = new \currentnamespace\foo();` 或 `\currentnamespace\foo::staticmethod();`。在这种情况下，`foo` 总是被解析为代码中的文字名`(literal name)currentnamespace\foo`。

也没啥太深奥的东西，上一段代码就明白了

``` php
namespace A;
const aa = "haha";
 
namespace B\BB;
const aa = "xixi";
 
namespace B;
const aa = "heihei";
 
echo aa; //heihei 非限定名称采用上一个命名空间 解析出来就是\B\aa
echo \B\aa; //heihei 完全限定命名空间 
echo BB\aa; // xixi 限定命名空间 解析出来就是\B\BB\aa
```



