# PHP下面简单使用memcache

记录下，以后脑袋不好使了，可以返回来看看。

## 安装

### 下载
首先下载 memcached ，百度上面很多，按照自己对应系统下载对应的即可

### 解压
解压到本地任意一个地方，记住位置，这里我是解压到D盘 memcached 文件夹里面的。

### 选择路径
打开终端，也就是dos命令台（windows下面按win+r，输入cmd，敲回车），这个时候就出现了熟悉的dos界面。先进入上面记住位置的盘看看（我是解压在D:\memcached 所以我输入"D:"敲回车，然后在dir看下有没有对应文件夹）如图所示

![命令行](https://img-blog.csdn.net/20160219095519161?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast)

可以看得出来，有这个文件夹，那么我们就开始安装了

### 安装
进入这个文件夹（"cd memcached"），然后输入"memcached.exe -d install" 回车，稍微停顿后就安装好了，如图所示

![安装成功](https://img-blog.csdn.net/20160219095541083?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast)

### 启动服务
现在要启动memcache服务，输入"memcached.exe -d start" 回车，也是稍微停顿下，就启动好了。

### 检查服务
检查是否启动了此服务，还是win + r 回车，输入"services.msc"，然后会进入服务的窗口，在里面找找看，是不是已经看到了memcached的服务了呢，这个是开机自启动的。

![服务](https://img-blog.csdn.net/20160219095603899?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast)

## 使用
 安装告一段落了，现在要开始使用
 
### 添加PHP扩展
memcached 客户端安装好了，但是我们的PHP还是操作不了啊，所以我们要给PHP添加memcache扩展（memcached的驱动分为memcached和memcache两个扩展，这也是问同事得到的回答），我用的是phpStudy 的集成开发环境，里面已经内置了各种驱动，用wamp server的可以在网上查找下载，放到PHP目录下面的ext文件夹下面，然后到php.ini配置文件里面添加一项"extension=memcache.dll"，重启下 “apache” 。打印下 "phpinfo()" 看一下，是不是已经看到了memcache呢
![phpinfo](https://img-blog.csdn.net/20160219095628724?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast)


### 用法
然后大家就可以使用了，上面说到，有两个扩展，大家按照自己对应的扩展去php手册里面找找看，别使用错了哦
![手册](https://img-blog.csdn.net/20160219095655365?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast)

### 尝试一下
把我的一个demo粘贴出来吧。

demo1.php

``` php
<?php
$memcache = new Memcache();
$memcache->connect('localhost') or die("error"); //链接memcache 端口默认是11211,可写可不写
$memcache->set('key','777',MEMCACHE_COMPRESSED,10); //这里设置的过期时间是10秒
```

demo2.php

``` php
<?php
$memcache = new Memcache();
$memcache->connect('localhost') or die("error");
echo "<pre>";
var_dump($memcache->get('key'));
```

通过demo1.php的设置，demo2.php里面也能访问到，是不是成功啦！，网上例子很多，这里就不一一复述了，还有，链接memcache服务的时候，后面有个数字 11211，那是memcache的默认监听端口。

祝大家新年快乐！