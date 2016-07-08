<?php

chdir(dirname(__FILE__) . '/../');
require('vendor/autoload.php');

defined('YII_DEBUG') or define('YII_DEBUG', true);
require('vendor/yiisoft/yii/framework/yii.php');

$config = require('protected/config/main.php');

Yii::createWebApplication($config)->run();
