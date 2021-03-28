# Abstract
- Laravel Framework 7.30.4
- PHP 7.2.33


```
$ git clone https://github.com/keiyonekawa0614/twitter_clone.git
$ cd twitter_clone
$ docker-compose up -d

#
# テーブル作成
# twitter_webコンテナに入り、マイグレーションを実行する
#
$ docker-compose exec twitter_web bash
root@02821805a493:/var/www/html# php artisan migrate

```
