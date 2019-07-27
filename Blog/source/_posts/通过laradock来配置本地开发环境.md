---
title: 通过laradock来配置本地开发环境
date: 2019-04-18 12:29:22
updated: 2019-04-18 12:29:22
tags: [Docker, Laravel, LaraDock, PHP]
categories: [工具, Docker]
---

## 本地开发之痛苦
在开发之前，首先你需要安装各种开发工具和服务支持到你的开发环境当中，可能会出依赖问题，环境变量问题，端口冲突，经编译库问题等等。

开发途中，可能你又需要依赖一些其他的服务，你最好祈祷不会出问题，可能你又要重写来配置你的环境，因为你的所有的依赖服务都在你的唯一的工作空间里面。

<!-- more -->

如果你的伙伴的操作系统不统一，可能你还会遇到一些不同元字符解析不一致的问题。

然后上线之前，可能你在本地开发调试都可以完美运行，一但部署到服务器，就会出现各种问题。因为大多数情况下，我们的开发环境和生产环境并不相同。

可能你下次又有要用到一个新的开项目的开发环境。你又要重复面对上面这些问题.

你不得不去审视，你要话费大量的时间用在搭建环境当中来。

## 什么是`Docker`

Docker 是一个开源的应用容器引擎，让开发者可以打包他们的应用以及依赖包到一个可移植的容器中，然后发布到任何流行的 `Linux` 机器上，也可以实现虚拟化。容器是完全使用沙箱机制，相互之间不会有任何接口。
对我们而言，我觉得只需要把他理解成一个**便携的应用容器**即可

## `Docker`本地开发环境的好处

### 试错
对开发者而言，每天会催生出的各式各样的新技术都需要尝试，然而开发者却不太可能为他们一一搭建好环境并进行测试。时间非常宝贵，正是得益于 `Docker`，让我们有可能在一条或者几条命令内就搭建完环境，而且这个环境大到一个特定版本的操作系统，小到一个软件。Docker 有一个傻瓜化的获取软件的方法，`Docker`后台会自动获得环境镜像并且运行环境。

### 统一开发和生产环境
对于一般的小公司来说，搭建一个公用的开发环境是一件不那么划算的事情。那么就可以用`Docker`来统一开发环境，因为不管你用的是`Windows`、`Mac` 还是 `Ubuntu`。
如果生产环境也使用的`Docker`的话，你甚至可以直接打包一套环境，直接丢上去就可以运行了，再也不用担心开发-生产环境之间的差异了。

### 高性能
虚拟机的粒度是**虚拟出的机**，而`Docker`的粒度则是**被限制的应用**，相比较而言 Docker 的内存占用更少，更加轻量级，性能也更优。

而秒级的启动，也可以让我们启动电脑时候，开发环境的运行是无感知的。

### 成果展示
我们可能经常要给用户或者是同事展示一样功能的，但是搭建演示环境的过程却是非常麻烦的。现在可以直接将我们的镜像打包丢过去，而不必去做任何环境配置的工作，同时也不必担心他们的环境配置会导致我们的产品无法运行。


## 安装`Docker`
在`mac`平台下，就是去下载一个`dmg`的安装文件。下载好了之后，双击，然后拖入就可以了，`windows`应该也是类似的。

就是安装`qq`一样简单，傻瓜式的。

附上`dockerhub`上的[下载链接](https://hub.docker.com/search/?type=edition&offering=community)

成功之后属于`docker version`如果出来版本信息就是安装成功，类似如下

```bash
Client: Docker Engine - Community
 Version:           18.09.0
 API version:       1.39
 Go version:        go1.10.4
 Git commit:        4d60db4
 Built:             Wed Nov  7 00:47:43 2018
 OS/Arch:           darwin/amd64
 Experimental:      false

Server: Docker Engine - Community
 Engine:
  Version:          18.09.0
  API version:      1.39 (minimum version 1.12)
  Go version:       go1.10.4
  Git commit:       4d60db4
  Built:            Wed Nov  7 00:55:00 2018
  OS/Arch:          linux/amd64
  Experimental:     true
```


## 安装`docker-composer`
一般来说，mac安装`docker`之后就会携带`docker-composer`。

其他平台，附上[下载链接](https://github.com/docker/compose/releases)

安装完成之后可以输入命令检测

``` bash
➜  ~ docker-compose version
docker-compose version 1.23.2, build 1110ad01
docker-py version: 3.6.0
CPython version: 3.6.6
OpenSSL version: OpenSSL 1.1.0h  27 Mar 2018
```
如果没有出现版本相关信息，可以尝试再次安装

## 下载`laradock`
`laradock`的项目地址是`https://github.com/laradock/laradock`
我们找一个地方`clone`下来即可

我这里是在我的用户目录下面新建了一个`Docker`目录，然后`clone`了项目下来

## 配置`env`文件
1. 拷贝example成.env

	```bash
	cp env-example env
	```

2. `.env`文件中`APP_CODE_PATH_HOST`是本地路径 `APP_CODE_PATH_CONTAINER`是远程映射路径，看需求修改，大多数情况下是不需要的
3. 如果有调试代码的需求，也可以将`PHP_FPM_INSTALL_XDEBUG`和`WORKSPACE_INSTALL_XDEBUG`两个选项打开
4. 如果还有其他的需求，可以在`.env`里面搜索，里面已经将大多数配置项都给独立出来了

## 运行容器
进入到`laradock`的工作目录下面，就是`clone`的项目的根目录我的工作目录就是`~/Docker/laradock`。

然后运行如下命令


``` bash
docker-compose up -d nginx mysql
```
就会看到在自动执行`build`操作，并且build完了之后自动后台启动了如下容器

- nginx
- php-fpm
- workspace
- mysql

那是因为`php-fpm`和`workspace`还有`docker-in-docker`是随`nginx`一并启动的

所以实际上

``` bash
docker-compose up -d nginx mysql
```
和

``` bash
docker-compose up -d nginx workspace php-fpm mysql
```
这两条命令的效果是一样的，可以都带上，也可以不写。

`up`命令在第一次启动的时候实际上就是`build` + `start`的组合，如果容器不存在，那么就`build`一个容器，并且启动服务，如果容器存在那么直接启动服务，大概就是这么个意思 `-d`的意思是后台运行

## 配置web项目
一下是我`laravel`项目的部分配置

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=root
......
```

注意，数据库主机必须得是别名才可以，如果`DB_CONNECTION`这个地方输入172.0.0.1或者是`localhost`都是会连接失败的。

在其它的项目中也必须是这样的，配置数据库链接，`redis`，或者`MemCache`链接都必须设置成具体的别名。或者你说我找到各个容器的ip，可以嘛。可以，但是并不建议这样做，因为ip是会变动的。

具体别名可以参考`./docker-compose.yml`文件中的设置

这个主要的技术实现应该是用了`docker`的虚拟网桥技术.

## 配置宿主机的`host`
因为，往往我们访问的时候，是通过宿主机上面的浏览器发送请求的，所以，配置宿主机上面的`host`必不可少。

``` bash
vim /etc/hosts
```

我这里加入一条我自己设置的虚拟域名

``` bash
127.0.0.1       blog.test
```

然后保存，刷新下host。

## 配置`nginx`
进入到`./laradock/nginx/sites`文件夹，然后`ll`一下，我们会发现，laradock已经帮我们放了好多列举的文件进来

```bash
app.conf.example
default.conf
laravel.conf.example
symfony.conf.example
```
根据需求拷贝一份，然后修改一下就可以了，都不是很难，由于我们本地是laravel开发的博客项目，所以我就直接拷贝`laravel.conf.example`，然后使用vim打开
```bash
cp laravel.conf.example blog.conf
vim blog.conf
```
打开后的内容...

```bash
server {

    listen 80;
    listen [::]:80;

    # For https
    # listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    # ssl_certificate /etc/nginx/ssl/default.crt;
    # ssl_certificate_key /etc/nginx/ssl/default.key;

    server_name laravel.test;
    root /var/www/laravel/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
```

我们会发现，如果没有特殊需求的话，这个里面大多数地方我们并不需要修改。我们只需要关注`server_name`和`root`这两个参数，把这个里面的`laravel`换成我们项目名就可以了，这里我们换成`blog`

下面是修改后的内容

```bash
server {

    listen 80;
    listen [::]:80;

    # For https
    # listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    # ssl_certificate /etc/nginx/ssl/default.crt;
    # ssl_certificate_key /etc/nginx/ssl/default.key;

    server_name blog.test;
    root /var/www/blog/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
```

## 完
输入`url`

```
http://blog.test/
```

浏览器返回结果

![blog项目](https://raw.githubusercontent.com/lightWey/notebook/master/imageHost/2019/04/blog.png)

enjoy !

