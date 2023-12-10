# dev-cakephp
CakePHP検証用

### 実行環境

```
php -v
PHP 8.1.25 (cli) (built: Nov  1 2023 12:51:36) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.25, Copyright (c) Zend Technologies
    with Xdebug v3.2.2, Copyright (c) 2002-2023, by Derick Rethans

mysql -V
mysql  Ver 8.0.33 for Linux on aarch64 (MySQL Community Server - GPL)
```

## 初期セットアップ

```
# ビルド
docker-compose build

# コンテナ立ち上げ
docker-compose up -d

# webコンテナに入って
docker-compose exec web bash
composer install

# envコピー
cp config/.env.example config/.env
```

## 基本コマンド
```
# webコンテナに入って
docker-compose exec web bash

# テスト実行
composer test

# .envを更新した場合
rm -rf app_local.php
composer install

# キャッシュ全クリア
bin/cake cache clear_all
```

### モデル・ファクトリー・シード作成
```
# migrationファイル作成
bin/cake bake migration CreateUsers name:string created modified

# migrate実行
bin/cake migrations migrate

# rollback実行（一つ前に戻る）
bin/cake migrations rollback

# model作成
bin/cake bake model Users

# factory作成
bin/cake bake fixture_factory Users

# seedファイル作成
bin/cake bake seed Users

# seed実行
bin/cake migrations seed 

# 特定のseedを実行
bin/cake migrations seed --seed UsersSeed
```

### コントローラー作成
```
# model, controller, template, testファイルをまとめて作成
bin/cake bake all Users

# controller作成
bin/cake bake controller Users

# ディレクトリを区切ってcontroller作成
bin/cake bake controller --prefix api Users
```