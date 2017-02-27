<?php

use Slim\Http\Request;
use Slim\Http\Response;

/** @var \Slim\App $app */

$app->get('/', function (Request $request, Response $response) {
});

$app->get('/health', function (Request $request, Response $response) {
  $response = $response->withJson(['status' => 'OK']);
  return $response;
});

$app->get('/burger', function (Request $request, Response $response) use ($app) {
  /** @var \OutsideIn\Burger\IBurgerGetter $burgerGetter */
  $burgerGetter = $app->getContainer()['burgerGetter'];
  $burger = $burgerGetter->getBurger();

  return $response->withJson(['burger' => $burger]);
});
