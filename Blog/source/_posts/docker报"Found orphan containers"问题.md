---
title: docker报"Found orphan containers"问题
date: 2019-06-02 20:14:06
updated: 2019-06-02 20:14:06
tags: [docker, docker-compose]
categories: [工具, docker]
---

## 起因
最近拆分项目，然后每个项目都是用的公司的同一个框架，但是由于该框架的所有的`docker`相关的文件都在放在docker子目录下面。我们都知道，`docker-compose`管理是以目录为基础的，所以就会报一个`WARNING`，如下图所示。
<!-- more -->

![百度](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/06/1.png)

## 问题原因
在网上找了下,发现主要是`docker-compose`会以默认的目录作为项目，但是我们项目的每个`docker-compose.yml`所在的目录都是`docker`子目录，没有`COMPOSE_PROJECT_NAME`才导致的。
![](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/06/2.png)

其实git会去解析了一些预置的环境变量，其中就包括`COMPOSE_PROJECT_NAME`

所以我们可以通过设置项目名称环境变量就可以解决啦

![](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/06/3.png)
## 解决方法
解决方法主要有这几种
### docker-compose 启动时候携带项目名称
只有这一种方法是直接设置项目名称，后面的三种方法都是通过设置环境变量曲线救国
``` bash
docker-compose -p 项目名
```

### docker-compose 启动时候携带配置文件
携带配置文件，配置文件里面加入环境变量设置
``` bash
docker-compose -f ./coupon.yml
```
### Dockerfile 文件里面指定
在Dockerfile 里面里面的`ENV`指令里面加入配置，由于是在`Dockerfile`文件里面配置的，以至于不够灵活，所以此方法并不太建议。如图所示
![Dockerfile配置](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/06/6.png)


### docker-compose.yml 配置环境变量
在配置文件的`service`的`environment`配置就可以了，如图所示
![docker-compose.yml](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/06/4.png)

以上几种方法，最后一种方法更便于管理，所以推荐