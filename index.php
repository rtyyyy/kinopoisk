<?php

define('APP_PATH', __DIR__);//переопределяем константу для удобной работы с маршрутами//
require_once APP_PATH.'/vendor/autoload.php';
use App\App;
$app = new App();

$app->run();

