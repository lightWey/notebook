---
title: PHP序列化反序列化serialize和unserialize函数
date: 2017-02-21 10:42:06
updated: 2017-02-21 10:42:06
tags: [serialize, unserialize, PHP, 序列化]
categories: [语言, PHP]
---

## 起因
昨天网上看到一道面试题，如下：

“类的属性可以序列化后保存到session中，从而以后可以恢复整个类，这要用到的函数是？”
我记得原来老师说过序列化函数是"serialize"，查了下，果不其然，今天记录下，免得忘记了

<!-- more -->

## 实践
写了段代码

``` php
class aa{
    public $a = 1;
    private $b = 2;
    protected $c = 3;
 
    function afun(){
        return $this->a;
    }
    function bfun(){
        return $this->b;
    }
    function __destruct(){
        echo "变量销毁了";
    }
}
 
$v = new aa;
echo $v->afun();
$se = serialize($v);
unset($v); //这里先销毁$v，这个时候会自动调用析构函数
echo "<hr />";
$v = unserialize($se); //再反序列化
echo $v->bfun();
```

看看运行结果

![执行结果](https://img-blog.csdn.net/20160221105832237?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/Center)

如果觉得还不明显， 好，我们在改一下代码

aa.class.php

``` php
class aa{
    public $a = 1;
    private $b = 2;
    protected $c = 3;
 
    function afun(){
        return '$a的值是：'.$this->a;
    }
    function bfun(){
        return '$b的值是：'.$this->b;
    }
}
```

a1.php

``` php
require './demo8.php';
Session_start();
$v = new aa();
$_SESSION['v'] = serialize($v);
```

a2.php

``` php
require './demo8.php';
Session_start();
$v = unserialize($_SESSION['v']);
echo $v->bfun();
```

## 结论
再看看结果是不是一目了然了呢，好了，试验做完了，结论调用下公论。

例子中的对象我们还可以换为数组等其他类型，效果都是一样的！
其实serialize()就是将PHP中的变量如对象(object),数组(array)等等的值序列化为字符串后存储起来.序列化的字符串我们可以存储在其他地方如数据库、Session、Cookie等,序列化的操作并不会丢失这些值的类型和结构。这样这些变量的数据就可以在PHP页面、甚至是不同PHP程序间传递了。
而`unserialize()`就是把序列化的字符串转换回PHP的值。

这里再引用一段`PHP`手册上的说明，看了上面的例子，应该很容易明白下面这些话的意思了
想要将已序列化的字符串变回 PHP 的值，可使用 `unserialize()`。`erialize()` 可处理除了 `resource` 之外的任何类型。甚至可以 `serialize()` 那些包含了指向其自身引用的数组。你正 `serialize()` 的数组／对象中的引用也将被存储。

>当序列化对象时，PHP 将试图在序列动作之前调用该对象的成员函数 __sleep()。这样就允许对象在被序列化之前做任何清除操作。类似的，当使用 unserialize() 恢复对象时， 将调用 __wakeup() 成员函数

>unserialize() 对单一的已序列化的变量进行操作，将其转换回 PHP 的值。返回的是转换之后的值，可为 integer、float、string、array 或 object。如果传递的字符串不可解序列化，则返回 FALSE。


