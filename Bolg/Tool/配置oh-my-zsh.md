#mac 配置oh-my-zsh

## 查看是否安装过
``` bash
localhost% cat /etc/shells
# List of acceptable shells for chpass(1).
# Ftpd will not allow users to connect who are not using
# one of these shells.

/bin/bash
/bin/csh
/bin/ksh
/bin/sh
/bin/tcsh
/bin/zsh
localhost%
```
如果没有zsh，那么就去安装


## 查看当前用的shell
``` bash
localhost% echo $SHELL
/bin/bash
```

## 切换zsh

``` bash
localhost:~ bocai$ chsh -s /bin/zsh
Changing shell for bocai.
Password for bocai:
```
## 安装	`oh-my-zsh`

运行`sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"`;

```zsh
localhost% sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
Cloning Oh My Zsh...
Cloning into '/Users/bocai/.oh-my-zsh'...
remote: Enumerating objects: 1038, done.
remote: Counting objects: 100% (1038/1038), done.
remote: Compressing objects: 100% (954/954), done.
remote: Total 1038 (delta 23), reused 845 (delta 20), pack-reused 0
Receiving objects: 100% (1038/1038), 685.01 KiB | 83.00 KiB/s, done.
Resolving deltas: 100% (23/23), done.
Looking for an existing zsh config...
Using the Oh My Zsh template file and adding it to ~/.zshrc
         __                                     __
  ____  / /_     ____ ___  __  __   ____  _____/ /_
 / __ \/ __ \   / __ `__ \/ / / /  /_  / / ___/ __ \
/ /_/ / / / /  / / / / / / /_/ /    / /_(__  ) / / /
\____/_/ /_/  /_/ /_/ /_/\__, /    /___/____/_/ /_/
                        /____/                       ....is now installed!


Please look over the ~/.zshrc file to select plugins, themes, and options.

p.s. Follow us at https://twitter.com/ohmyzsh

p.p.s. Get stickers, shirts, and coffee mugs at https://shop.planetargon.com/collections/oh-my-zsh

```

## 自动补全
``` zsh
➜  ~ git clone git://github.com/zsh-users/zsh-autosuggestions $ZSH_CUSTOM/plugins/zsh-autosuggestions
Cloning into '/Users/bocai/.oh-my-zsh/custom/plugins/zsh-autosuggestions'...
remote: Enumerating objects: 56, done.
remote: Counting objects: 100% (56/56), done.
remote: Compressing objects: 100% (30/30), done.
remote: Total 2075 (delta 32), reused 42 (delta 26), pack-reused 2019
Receiving objects: 100% (2075/2075), 470.13 KiB | 151.00 KiB/s, done.
Resolving deltas: 100% (1318/1318), done.
```

然后编辑`~/.zshrc`

找到这一行`plugins=(git)`
修改成这一行`plugins=(git zsh-autosuggestions)`