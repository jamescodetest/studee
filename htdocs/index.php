<?php
use Application/Framework/Application;
use Application/Framework/ServiceLocator;

$serviceLocator = new ServiceLocator();

$app = new Application($serviceLocator);
$app->run();
