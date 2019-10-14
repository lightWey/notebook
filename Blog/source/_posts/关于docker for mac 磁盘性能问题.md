---
title: 关于docker for mac 磁盘性能问题
date: 2019-10-14 15:37:25
updated: 2019-10-14 15:37:25
tags: [Docker, Docker-sync, PHP]
categories: [工具, Docker]
---

## 问题起因
由于`MAC OS`和`Linux`在文件系统上的差异[^文件系统]上的差别，和`MAC OS`系统本身版本导致的文件系统差异，`Docker for mac`专门提供了`File system sharing`，简称`osxfs`[^osxfs]，
`osxfs`是`Docker for Mac`专用的新共享文件系统解决方案。 `osxfs`提供了接近本机的用户体验，可将安装的`macOS`文件系统树绑定到`Docker`容器中。为此，它`osxfs`具有许多独特的功能以及与传统`Linux`文件系统的不同之处。

由于文件系统API非常广泛（20-40种消息类型），具有许多复杂的语义，涉及磁盘状态，内存中的缓存状态以及多个进程的并发访问。此外，`osxfs`集成了`macOS`的`FSEvents API`和`Linux`的`inotifyAPI`之间的映射，该映射是在文件系统本身内部实现的，从而使事情进一步复杂化，尤其是缓存行为。

可以理解成`osxfs`是一个翻译层，它对`mac OS`和`Linux`做了文件系统的映射。当然，这也就是问题的原因所在了。

## 解决方案
更具`docker`官方文档里面的介绍,由于`osxfs`作为的是解释层，那么在大量的IO的时候，就容易产生性能的瓶颈，因为解释层是一直要保持两个文件系统之间的一致性的，所以解决方案就可以从这里来着手。目前市面上有两套解决方案：

### docker-sync
`docker-sync`这边又提出来了一个概念，叫`native_osx`简称`OSX`,它其实是两个概念的组合，即`osxfs`和`Unison`的组合，具体的就是通过`osxfs`来同步宿主机和容器的双向修改，也就是`host_sync `，然后通过`Unison`来同步`host_sync`和`app_sync`，`app_sync`作为命名的卷安装公开，然后其他的容器就可以绑定这个卷了。由于在容器中使用`Unison`，基于`inotify-event`的观察程序的作用，`Unison`的性能可以达到很好的程度，具体原理如下[^docker-sync]

![图片1](https://docker-sync.readthedocs.io/en/latest/_images/native_osx.png)

#### 安装
``` bash
sudo gem install docker-sync
brew install fswatch
brew install unison
brew install eugenmayer/dockersync/unox //安装这个步骤会安装python，大概率会出现权限问题的报错，可以根据提示，给予对应的权限，和建立相关文件夹即可
```

#### 配置
在项目根目录下面建立`docker-sync.yml`文件，然后按照下面方式填写
``` yml
# 版本
version: '2'

syncs:
  # 同步容器名称
  sync-folder:
    # 同步路径选择
    src: '.'
    # 同步方式选择
    sync_strategy: 'unison'
    # 同步时的用户ID，不指定的话为root
    sync_userid: '1000'
    # 需要过滤的文件
    sync_excludes: ['vendor/bundle/'， 'node_modules'， 'tmp']
```

#### 启动
在项目根目录下面执行以下命令

``` bash
docker-sync start
```

执行过程中会有一些状态信息打印出来，一般不出错，可以不用管，执行完毕之后，就生成了一个额外的容器，执行`docker ps`可以查看到容器，或者执行`docker-sync list`也能看到


#### 项目容器绑定卷

``` bash
docker run -d -p 80:80 -v sync-folder:/web/httpd/test nginx
```
`sync-folder`就是我们刚刚启动的共享文件的容器，执行`docker run`命令的时候，只需要注意`-v 共享容器名称:项目容器目录`就可以了



### docker自带的挂载卷缓存
由于很多时候，容器与主机之间不需要完美的一致性。 特别是，在许多情况下，不需要在容器中执行的写入立即反映在主机上。例如，尽管交互式开发要求对主机上的绑定安装目录的写操作立即在容器内生成文件系统事件，但无需进行构建容器内构件的写操作以立即反映在主机文件系统上。区分这两种情况可以显着提高性能。

`docker` 给我们提供了三个选项

1. `consistent` 完全一致性（默认项）
2. `cached` 宿主机的视图具有权威性（允许延迟，直到主机上的更新出现在容器中）
3. `delegated` 容器的视图具有权威性（允许延迟，直到容器上的更新出现在主机中）

我们可以看出端倪，实际上这几个选项就是让我们选择通过什么样的方式降低一致性的标准，从而来提高性能，因此我们可以简单归纳一下，`cached`的使用场景大概是读多写少的情况，`delegated`的使用场景是写多读少。

#### 使用
因为是`docker`已经内置的功能，所以我们只需要在挂载卷的时候，后面携带上参数即可，比如我有个读取比较频繁的项目，启动命令如下

``` bash
docker run -d -p 80:80 -v ~/workspace/test:/web/httpd/test: cached nginx

```

## 性能对比
以我现在的一个`laravel`项目为例，整个项目大小大概是`1.2 G`

### 宿主机性能
我们先直接在宿主机的项目文件下测试下性能

#### 写性能

![宿主机IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/01.png)

大概是`611 MB/s`

#### 读性能
![宿主机IO读](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/02.png)

大概是`379 MB/s`


### 不做任何优化的容器

#### 写性能
![容器IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/03.png)

#### 读性能
![容器IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/04.png)

### 使用容器的挂载卷时候的缓存

#### 写性能
![容器IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/05.png)

#### 读性能
![容器IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/06.png)

### 使用`docker-sync`的方式

#### 写性能
![容器IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/08.png)

#### 读性能
![容器IO写](https://dev.tencent.com/u/lightWay/p/notebook/git/raw/master/imageHost/2019/10/07.png)


#### 两种优化方式的总结
当然，由于很多物理因素的原因，测试结果可能没有想象中精准，但是仍然可以作为一种参考，我奇怪的是，为啥优化后的容器，读取速度竟然比宿主机还快，不得其解啊。

大概可以看出，性能最好的应该是`docker-sync`方式，无论读写性能，都很强大，但是该方式比较麻烦，需要安装大量的工具，和配置，适合比较在意性能，但是不太怕麻烦的童鞋

其次是`docker`自带的，挂载卷时候配置缓存参数的方式，当然这种方式有针对读和针对写的方式，我这里只测试了针对读的方式，写入性能和不做优化的容器相比，确实鲜有提升，但是读取性能确实高了不少，这种方式相对来说比较简单，只需要一个配置参数即可，身世来源也正，毕竟官方集成，而且官方还在持续优化中，相对来说比较推荐这种方式的



[^文件系统]: 参考[macOS 和 Linux 的内核有什么区别](https://zhuanlan.zhihu.com/p/40187660)
[^osxfs]: 参考[File system sharing](https://docs.docker.com/docker-for-mac/osxfs/#performance-issues-solutions-and-roadmap)
[^docker-sync]: 参考[Sync strategies](https://docker-sync.readthedocs.io/en/latest/advanced/sync-strategies.html)
