# docker-mycakeapp2

- CakePHP 超入門のオークションアプリの docker 環境

## docker 起動前の準備

- docker/php/Dockerfile の DOCKER_UID をホストと合わせる

  ```
  # ホストのuidを調べる
  id -u

  # docker/php/Dockerfile の ARG DOCKER_UID=1000 の右辺を↑で調べた値にする
  vim docker/php/Dockerfile
  ```

  - Linux ではこれをやらないとゲスト側で作成したファイルをホスト側で編集できなくなる
  - Mac ではこの手順は不要との説もある
  - Windows の人は WSL (Windows Subsystem for Linux) を使おう

## docker の起動方法

- docker-compose.yml がある場所で下記のコマンドを実行する。初回起動には時間がかかる

  ```
  docker-compose up -d
  ```

## docker の終了方法

- docker-compose.yml がある場所で下記のコマンドを実行する

  ```
  docker-compose down
  ```

## 起動中のコンテナの bash を実行する方法(重要)

- php コンテナの場合

  ```
  docker-compose exec php bash
  ```

  - php コンテナの bash では composer コマンドや ./bin/cake ファイルが実行可能です！

- msyql コンテナの場合

  ```
  docker-compose exec mysql bash
  ```

  - mysql コマンドラインの起動方法

    ```
    # mysql コンテナの bash で
    mysql -u root -p # パスワードは"root"
    ```

## 起動中のコンテナの bash を終了する方法

- コンテナの bash で下記のショートカットキーを入力する

  ```
  ctrl + p + q
  ```

  - コンテナの bash で exit コマンドを打つとコンテナ自体が終了してしまう恐れがある

## php コンテナに cakephp をインストールする方法

- php コンテナの bash で /var/www/html/mycakeapp に移動して

  ```
  composer install
  ```

  - 時間がかかる。質問プロンプトが出たら Y と回答する

    ```
    Set Folder Permissions ? (Default to Y) [Y,n]? Y
    ```

## migration

- php コンテナの bash で /var/www/html/mycakeapp に移動して

  ```
  ./bin/cake migrations migrate
  ```

## ブラウザで テキストに記載されている url にアクセスする方法

- 下記のように読みかえてアクセスする。nginx コンテナ の port とドキュメントルートを設定しているため
  - http://localhost/mycakeapp/hello.html ⇒ http://localhost:10080/hello.html
  - http://localhost/mycakeapp/auction/add ⇒ http://localhost:10080/auction/add

## ブラウザで phpMyAdmin を表示する方法

- http://localhost:10081 にアクセスする
  - root 権限で操作可能

## ブラウザで オークションアプリを表示する方法(課題用のブランチにおいて)

- http://localhost:10080/auction にアクセスする
  - http://localhost:10080/users/add からユーザを作成できる
  - サンプルコードが入っている課題用のブランチでないとアクセスできません

## nginx のドキュメントルートを変更する方法

- docker/nginx/default.conf を編集することで nginx のドキュメントルートを変更可能

  ```diff
  server {
  - root  /var/www/html/mycakeapp/webroot;
  + root  /var/www/html/mylaravelapp/public;
    index index.php index.html;
    ...
  ```

## docker network 上での DB 接続情報

- docker-compose.yml を参照
  - DB ホスト: mysql
  - mysql の port: 3306
  - MYSQL_DATABASE: docker_db
  - MYSQL_ROOT_PASSWORD: root
  - MYSQL_USER: docker_db_user
  - MYSQL_PASSWORD: docker_db_user_pass

-vagrant localhost 上での DB 接続情報
 - DB ホスト: localhost
 - MYSQL_DATABASE: auction
 - MYSQL_ROOT_PASSWORD: shika
 - MYSQL_USER: root
 - MYSQL_PASSWORD: shika
