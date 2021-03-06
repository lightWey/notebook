# PHP浮点数精度问题

## 起因
今天测试突然提了一个很奇怪的bug，返利有好多位小数，小数点溢出？ 然后查了下发现是老代码，做一个记录吧

当时的代码如下:

```php
echo json_encode(0.1+0.7);
// 0.7999999999999999
```

很神奇是吧

## json_encode 相关
然后试了下之后很神奇，然后就去查了下文档，发现了这个
![](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/07/3.png)

>serialize_precision integer
>
>The number of significant digits stored while serializing floating point numbers. -1 means that an enhanced algorithm for rounding such numbers will be used.

大概是序列化浮点数值时候存储的有效位数的意思，这个值设置为-1就会舍去这些数字

## 浮点型本身的问题

### 什么是浮点型
浮点型（也叫浮点数 float，双精度数 double 或实数 real）

浮点数的字长和平台相关，尽管通常最大值是 1.8e308 并具有 14 位十进制数字的精度（64 位 IEEE 格式）

### 浮点型精度
浮点数的精度有限。尽管取决于系统，PHP 通常使用 IEEE 754 双精度格式，则由于取整而导致的最大相对误差为 1.11e-16。非基本数学运算可能会给出更大误差，并且要考虑到进行复合运算时的误差传递。

此外，以十进制能够精确表示的有理数无论有多少尾数都不能被内部所使用的二进制精确表示，因此不能在不丢失一点点精度的情况下转换为二进制的格式。如图所示

``` php
echo floor((0.1+0.6)*10);
//结果7
echo floor((0.1+0.7)*10);
//结果还是7
```

所以永远不要相信浮点数结果精确到了最后一位，也永远不要比较两个浮点数是否相等。如果确实需要更高的精度，应该使用任意精度数学函数或者 gmp 函数。

## 解决方式
网上一般建议是将`serialize_precision `配置项改成-1，但是这个涉及到浮点精度问题。
其实个人并不建议，精度问题毕竟还是一个进步，不能因为菜刀可以当凶器，就不准切菜了。所以我们可以在我们代码层面注意和解决，比如浮点数的文档里面就写了使用`gmp`函数运算呀，或者是转成字符串运算这种方式

我们把上面的列子解决下

```php
echo json_encode(bcadd(0.1, 0.7, 1));
//0.8 注意这段代码
echo json_encode(strval(0.1+0.7));
//0.8
```

完美解决！


#### 小插曲
最近有大佬找到我说`gmp`的函数参数是字符串，我去看了下确实是的，然后，想了很久，为啥官方文档会在浮点型的介绍里面推荐一个接受字符串类型参数的数学函数，会不会是整形或者浮点型长度问题呢，然后去`stackoverflow`上面，问了一个问题（撒网）。第二天去查看了下(收网)，差不多是这个意思，因为bcMatch系列函数是支持的是任意精度的数学运算，所以整形和浮点型是没办法承载的，所以参数是字符串。

附上`stackoverflow`的[钓鱼链接](https://stackoverflow.com/questions/56987282/why-is-the-parameter-type-of-the-bcadd-method-in-php-a-string?noredirect=1#comment100512033_56987282)

然后无意间看到了`php`文档中关于字符串转换的描述
![字符串描述](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/07/6.png)

没错当一个字符串被当作一个数值来取值时，如果该字符串没有包含 '.'，'e' 或 'E' 并且其数字值在整型的范围之内，该字符串将被当成 integer 来取值。其它所有情况下都被作为 float 来取值。

所以实际上，这段代码

```php
bcadd(0.1, 0.7, 1);
```

和这下面这段代码是等效的

```php
bcadd('0.1', '0.7', 1);
```

不过，打码呢，还是要对自己严格一些，语法糖虽好，也不要贪食。
毕竟，不可能一辈子写世界上最好的语言。


