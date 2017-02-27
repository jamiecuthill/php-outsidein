<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

$di = $app->getContainer();

$di['burgerGetter'] = new \OutsideIn\Burger\BurgerGetter();

include 'routes.php';

$app->run();
