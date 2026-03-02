<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
ini_set('display_errors', 1);

$yii = dirname(__FILE__) . '/../yii-master/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
