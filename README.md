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
# SQL テーブル
```
CREATE TABLE users (
    id int(11) not null primary key auto_increment,
    fullname varchar(256) not null,
    email varchar(256) not null,
    username varchar(256) not null,
    password varchar(256) not null
);
```
- Users テーブルです。loginするために必要な情報はいてます。

```
CREATE TABLE profiles (
    id int(11) not null primary key auto_increment,
    u_id int(11) not null,
    bio varchar(256),
    profilePic varchar(256),
    foreign key (u_id) references users(id)
);
```
- Profiles テーブルです。LoginできたらUserが作るProfileはここに存在します。
```
CREATE TABLE posts (
    id int(11) not null primary key auto_increment,
    u_id int(11) not null,
    post varchar(256) not null,
    image varchar(256),
    foreign key (u_id) REFERENCES users(id)
);
```
- Posts テーブルです。Userが作ったPostここに存在します。
```
CREATE TABLE followers (
    id int(11) not null primary key auto_increment,
    follower int not null,
    following int not null
);
```
- Followers テーブルです。UserがFollowしているProfileの情報はここに存在します。

```
CREATE TABLE likedPost (
    id int(11) not null primary key auto_increment,
    post_id int(11) not null,
    liker int(11) not null
);
```
- Like テーブルです。様々なUserが他のUserのPostにいいねしたらその情報はここに存在します。
```
CREATE TABLE comments (
  id int(11) NOT NULL AUTO_INCREMENT,
  post_id int(11) NOT NULL,
  comment varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  poster int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY post_id (post_id),
  CONSTRAINT comments_ibfk_1 FOREIGN KEY (post_id) REFERENCES posts (id)
```
- Comments テーブルです.様々なUserが他のUserのPostにCommentたらその情報はここに存在します。

```
ALTER TABLE users ADD birthday DATE NOT NULL;
ALTER TABLE likedPost ADD FOREIGN KEY (post_id) REFERENCES posts(id);
```
- 忘れった物の追加
