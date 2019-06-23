# codesniffer编码规范检查工具

## 前提
原来的[配置 git pre-commit hook](http://wiki.17gwx.com/pages/viewpage.action?pageId=11765951)，由于部分问题，逐渐瓦解。commit之路，困难重重，经常出现，由于原来的老代码不符合`psr-2`规范，新写的代码，一直提交不上去。
但是，作为程序员，我们要对他人包容，对自己严格，所以，`hook`不强制用，那我们就自己本地通过`PhpStorm`来检测。

## 安装`codesniffer`
### 全局安装
执行如下命令
`composer global require "squizlabs/php_codesniffer=*"`

或者去到用户目录下的.composer目录里面，找到对应的`composer.json`文件并打开，然后在`require`里面添加`"squizlabs/php_codesniffer": "*"`语句，执行`composer update`命令即可

局部安装的话，只需要找到项目路径执行`requires`或者去到项目路径下面的`composer.json`文件里面添加`require`即可。

## 配置`phpcs`
去到`Languages&Frameworks > PHP > Quality Tools`，配置`phpcs`路径。如下所示

![图片1](https://raw.githubusercontent.com/lightWey/notebook/master/imageHost/2019/05/1.png)

`which phpcs`可以拿到`phpcs`路径，如果有配`composer``bin`路径的话

然后填入`phpcs`路径，选完了之后点`validate`检测下
![图片1](https://raw.githubusercontent.com/lightWey/notebook/master/imageHost/2019/05/2.png)

然后去到`Code Style > Inspections`，然后选择展开右侧的`PHP`，选择`Quality tools`，然后按照下图所示操作
![图片1](https://raw.githubusercontent.com/lightWey/notebook/master/imageHost/2019/05/3.png)

## 完成
效果如下图所示
![图片1](https://raw.githubusercontent.com/lightWey/notebook/master/imageHost/2019/05/4.png)






