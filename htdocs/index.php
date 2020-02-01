<?php
error_reporting(E_ALL);

require '../vendor/autoload.php';

$serviceLocator = new \Application\Framework\ServiceLocator();

$app = new \Application\Framework\Application($serviceLocator);
$app->run();
