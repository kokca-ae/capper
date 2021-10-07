<?php

header("Content-Type: text/html; charset=utf-8");
error_reporting(0);
session_start();
ini_set('display_errors', 'Off'); // теперь сообщений НЕ будет

define('ROOT', dirname(__FILE__));

require_once(ROOT . '/config/defines.php');
require_once(ROOT . '/vendor/autoload.php');

$router = new \app\base\Router();
$router->run();
