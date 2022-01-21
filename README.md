# systemk2021

# インストール

- まずリポのClone

`git clone git@github.com:sabi1125/systemk2021.git`

それでcloneしたリポの中に入って。

`source aliases.sh`

"aliases.sh"の中にはdocker立ち上げるaliasを書いてますので最初にsourceでloadして行きましょう

"aliases.sh"によると下記のようなコマンド打つと

`build: dockerコンテイナをbuildされる`

`start: dockerコンテイナを立ち上げる`

`install: このプロジェクトに必要なdependenciesをインストールされる`

`down: dockerコンテイナを落とす`

# 立ち上げる順番

`source aliases.sh`した後`build`コマンド
打てそれで`start`コマンドを打つ。このコマンド打ち終わったらサーバはdetachedで動きます。でも必要なdependenciesインストールしなければならないので`install`コマンドを打ちます。

これで準備は完了。

# 使っている技術

- Docker
- Docker-compose 
- shell script
- PHP
- Javascript
- Twig
- nginx
- Awsのec2
- Mysql
- Redis

