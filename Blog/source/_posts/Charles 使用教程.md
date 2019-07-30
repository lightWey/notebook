

## 简介
是一个`HTTP`代理服务器，`HTTP`监视器,反转代理服务器，当浏览器连接`Charles`的代理访问互联网时，`Charles`可以监控浏览器发送和接收的所有数据。它允许一个开发者查看所有连接互联网的`HTTP`通信，这些包括`request`, `response`和`HTTP headers` （包含`cookies`与`caching`信息）。
<!-- more -->
## 主要功能
* 支持SSL代理。可以截取分析SSL的请求。
* 支持流量控制。可以模拟慢速网络以及等待时间（latency）较长的请求。
* 支持AJAX调试。可以自动将json或xml数据格式化，方便查看。
* 支持AMF调试。可以将Flash Remoting 或 Flex Remoting信息格式化，方便查看。
* 支持重发网络请求，方便后端调试。
* 支持修改网络请求参数。
* 支持网络请求的截获并动态修改。
* 检查HTML，CSS和RSS内容是否符合W3C标准。

## 开始使用
### 简单使用
1. 点击[下载](http://www.baidu.com)
2. 安装并注册软件
3. 打开`菜单`->`Proxy`->`macOS Proxy`
![name](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524808380.png?raw=true, '安装页面')
4. 开始使用
![name](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809040.png?raw=true,'开始使用')
### 添加SSL证书
![乱码](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809044.png?raw=true)
> 当我们访问`https`请求抓包乱码的试试，就需要添加`Charles`提供的`https`证书
 
1. 首选下载证书 点击`菜单`->`Help`->`SSL Proxying`->`Install Charles Root Certificate`
![下载证书](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809043.png?raw=true)
2. 然后点击加入钥匙串
![加入证书](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809045.png?raw=true)
3. 在钥匙串找到该证书，双击，给予信任
![添加证书信任](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809041.png?raw=true)
4. 然后点击`菜单`->`Proxy`->`SSL Proxying Setting` 按照下图配置
![添加ssl代理](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809042.png?raw=true)
5. 成功之后再次抓取请求看看
![添加ssl代理](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809047.png?raw=true)

### 抓手机访问
1. 首先确保手机和电脑在一个局域网下面，然后通过`ifconfig`命令查看电脑ip地址
!['ifconfig'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809053.png?raw=true)
2. 点击`菜单`->`Proxy`->`Proxy Setting`打开`Enable transparent HTTP proxying`配置
!['打开配置'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809054.png?raw=true)
3. 配置手机访问代理 `设置`->`Wi-Fi`->`wifi名右侧感叹号`->`HTTP代理`
!['配置手机访问'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809054.jpeg?raw=true)
4. 这个时候电脑会出现一个提示框，点`Allow`
!['电脑提示框'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809051.png?raw=true)
5. 点击`菜单`->`Help`->`SSL Proxying`->`Install Charles Root Certificate on a Mobile Device or Remote Browser`
!['获取手机证书'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809055.png?raw=true)
6. 电脑端会提示下载地址
!['ifconfig'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809052.png?raw=true)
7. 手机输入提示的`url`信息，提示安装描述文件
!['ifconfig'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809049.png?raw=true)
8. 这个时候在用手机访问网址发现还是不行
!['ifconfig'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809048.png?raw=true)
9. 去到`设置`->`通用`->`关于本机`->`证书信任设置`
!['ifconfig'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809050.png?raw=true)
10. 这时候再通过手机访问，发现电脑端的`Charles`已经可以正常抓包了
!['ifconfig'](https://github.com/lightWey/notebook/blob/master/imageHost/2018/04/27/1524809056.png?raw=true)
## 完