---
title: 关于js里面的变量范围
date: 2016-02-23 16:27:33
updated: 2016-02-23 16:27:33
tags: [js, javaScript]
categories: [语言, javaScript]
---

## 起因
今天写一个滑动自动加载的功能的时候，遇到了切换就发现加载完毕的情况，查看了下发现可能是js的全局变量和局部变量的问题，自己测试了下，果不其然，下面分享下。

<!-- more -->

## 实践
先上两段代码

``` javascript
var i = 2;
function test(){
	var i = 1;
}
test();
alert(i);//值为2
```

``` javascript
var i = 2;
function test(){
	i = 1;
}
test();
alert(i);//值为1
```

是不是觉得很奇怪，我当时也是这样搞晕了，代码没问题啊，咋回事，最后找了找，原来是var作怪。我自己的理解是，var是用来申明变量的，在方法体里面申明的就是局部变量，局部变量自然不会影响到全局变量的值了。所以第一段代码alert出来的是2；

第二段由于没有用var关键词申明，所以默认用的是全局的i的值，在全局里面改变全局变量的值，所以全局变量i的值被修改成1了。

## 结论

下面再多看几个demo

``` javascript
/*这个很简单,就是改变全局的值*/
var i = 2;
function test(){
	alert(i);//弹框2
	i = 1;
	alert(i);//弹框1
}
test();
alert(i);//弹框1
```

``` javascript
/*这里就有点奇怪了,为啥第一个alert弹框是undefine呢？*/
var i = 2;
function test(){
	alert(i);//弹框undefined,查了下，这个i不是全局变量，因为在function scope里已经声明了，var i = 1;所以全局的i被覆盖了，这说明了js在执行前会对整个脚本文件的定义部分做完整分析，所以在test()函数执行前，函数体中的变量i都已经被指向了内部的局部变量，而不是指向外部的全局变量，但这是i还没有申明和赋值，所以弹的是undefined。(从刀刀的专栏(http://blog.csdn.net/zyz511919766/article/details/7276089)得知)
	var i = 1;
	alert(i);//弹框1 这里已经赋值了1，然后在函数体里面,所以弹值是1
}
test();
alert(i);//弹框2 因为局部变量不会影响全局变量，所以这里弹的值是2
```

``` javascript
var i =1;
function test(){
	alert(i);//undefined 这个上一段代码已经说了，js会先做解析，只要有var，就会只想局部变量，但是这个时候同样还没定义和赋值，所以undefined
	i=2;
	alert(i)//2 已经赋值了，所以是2
	var i;
	alert(i);//2 这里还是2.因为在前面已经把2赋值给i了
}
test();
alert(i);//1 弹全局的值，毫无疑问
```

``` javascript
/**如果我们方法体里面变量名是一样，但是我又要用到全局的变量怎么办呢**/
var i =1;
function test(){
	var i = 2;
	alert(i);//这里是2，不解释
	alert(window.i);//这里是1 因为用window.globalVariableName方式可以访问到全局的i
}
test();
alert(i);//这里是1，不解释
```

解释性文字都写在代码里面，大家搞不懂，可以运行下，就到这了