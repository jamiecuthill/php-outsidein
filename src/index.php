<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

$di = $app->getContainer();

include 'routes.php';

$app->run();
