<?php
declare(strict_types=1);

session_start();

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/app/core/App.php';
require BASE_PATH . '/app/core/Router.php';
require BASE_PATH . '/app/core/Controller.php';
require BASE_PATH . '/app/core/View.php';
require BASE_PATH . '/app/core/Auth.php';

$app = new App();
$app->run();
