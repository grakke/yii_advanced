## [Yii 2](http://www.yiiframework.com/)

* The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.
* The template is designed to work in a team development environment. It supports
deploying the application in different environments.
* [Documentation](docs/guide/README.md).

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

## 分支

* origin为开发分支
* source为框架分支，创建本地source分支，更新后，合并到origin分支

## 数据库

* 用户
* 数据库

```sql
CREATE USER 'yii'@'localhost' IDENTIFIED BY 'yii1234';
CREATE DATABASE `yii2advanced` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci

GRANT ALL PRIVILEGES ON yii2advanced.* TO 'yii'@'localhost';

CREATE TABLE `country` (
  `code` CHAR(2) NOT NULL PRIMARY KEY,
  `name` CHAR(52) NOT NULL,
  `population` INT(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `country` VALUES ('AU','Australia',18886000);
INSERT INTO `country` VALUES ('BR','Brazil',170115000);
INSERT INTO `country` VALUES ('CA','Canada',1147000);
INSERT INTO `country` VALUES ('CN','China',1277558000);
INSERT INTO `country` VALUES ('DE','Germany',82164700);
INSERT INTO `country` VALUES ('FR','France',59225700);
INSERT INTO `country` VALUES ('GB','United Kingdom',59623400);
INSERT INTO `country` VALUES ('IN','India',1013662000);
INSERT INTO `country` VALUES ('RU','Russia',146934000);
INSERT INTO `country` VALUES ('US','United States',278357000);

create table homeland select * from country
```

## Compontent

* 属性（Property）
* 事件（Event）
* 行为（Behavior）

## URI

* r=site/say
* r=gii
* r=homeland

## 配置

* `catchAll`:存在的话，开启维护模式
* Url: 解析与生成

```
php yii serve
php requirement.php
```

## 信息

* Yii::$app：应用实例，它是一个全局可访问的单例。也是一个服务定位器， 能提供 request，response，db 等等特定功能的组件
* rules: yii\widgets\ActiveForm 足够智能到把你在 EntryForm 模型中声明的验证规则转化成客户端 JavaScript 脚本去执行验证.服务端验证则都是必须的

## 模块 modules

## 组件 compontent

* ActiveForm
* ActiveRecord
* Pagination
* Gii
* widget
	- LinkerPager
* AssetBundle
* Query Builder
* Active Record:模型，继承一下就能用，使用频次低的 不建议用模型
	* 关联关系
* yii\base\Behavior
* yii\web\identifyInterface

## Helper

* ArrayHelper
* Console
* FileHelper
* FormatConverter
* Html
* HtmlPurifier
* Imagine (provided by yii2-imagine extension)
* Inflector
* Json
* Markdown
* StringHelper
* Url
* VarDumper

## 问题

* session开启与类型设置


## 前台

## 后台

## REST API

GET /users: 逐页列出所有用户
HEAD /users: 显示用户列表的概要信息
POST /users: 创建一个新用户
GET /users/123: 返回用户 123 的详细信息
HEAD /users/123: 显示用户 123 的概述信息
PATCH /users/123: and PUT /users/123: 更新用户123
DELETE /users/123: 删除用户123
OPTIONS /users: 显示关于末端 /users 支持的动词
OPTIONS /users/123: 显示有关末端 /users/123 支持的动词

* curl -i -H "Accept:application/json" "http://local.yii.com:8080/api/web/?user"

URL rule class must implement UrlRuleInterface

Response content must not be an array. in /Users/henry/Workspace/ShareFolder/yii_advanced/vendor/yiisoft/yii2/web/Response.php:1057

http://youdomain/articles?access-token=y3XWtwWaxqCEBDoE-qzZk0bCp3UKO920
传递 header头信息
Authorization:Bearer y3XWtwWaxqCEBDoE-qzZk0bCp3UKO920

## console

* `./yii test/index 'Hello henry34'`
* `./yii test/input-alias -m Arsenal`
* `./yii test/input-args 3 4 5`
* `./yii test/input-array hello,world`
* `./yii test/output-table`


## 事物

```php

$db = Yii::$app->db;
$transaction = $db->beginTransaction();
$i = 0;
try {
    $db->createCommand()->truncateTable('xnews_users')->execute();

    $transaction->commit();
} catch (\Exception $e) {
    $transaction->rollBack();
    throw $e;
} catch (\Throwable $e) {
    $transaction->rollBack();
    throw $e;
}
```
