<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\App;

define('APP_PATH', __DIR__);

$app = new App();
$app->run();
