<?php

namespace OutsideIn\Tests\Unit\Routes;

use Mockery\Mock;
use OutsideIn\Burger\Burger;
use OutsideIn\Burger\IBurgerGetter;
use Slim\Http\Response;

class BurgerTest extends RouteTest
{
  /** @var IBurgerGetter|Mock */
  private $burgerGetter;

  protected function setUp()
  {
    parent::setUp();

    $container = $this->app->getContainer();
    $this->burgerGetter = \Mockery::spy(IBurgerGetter::class);
    $container['burgerGetter'] = $this->burgerGetter;
  }

  public function test_burger_returnsOK()
  {
    $response = $this->app->process($this->newRequest('GET', '/burger'), new Response());

    assertThat($response->getStatusCode(), is(200));
  }

  public function test_burger_getsBurger()
  {
    $this->burgerGetter->shouldReceive('getBurger')
      ->once()
      ->andReturn(new Burger('Cheese Burger', []));

    $this->app->process($this->newRequest('GET', '/burger'), new Response());
  }

  public function test_burger_returnsBurger()
  {
    $this->burgerGetter->shouldReceive('getBurger')
      ->once()
      ->andReturn(new Burger('Hamburger', ['Tomato']));

    $response = $this->app->process($this->newRequest('GET', '/burger'), new Response());

    $rawBody = (string)$response->getBody();
    $body = json_decode($rawBody, true);

    assertThat($body, is(not(null)));
    assertThat($body, hasKey('burger'));
    assertThat($body['burger'], hasKeyValuePair('name', 'Hamburger'));
    assertThat($body['burger'], hasKeyValuePair('toppings', ['Tomato']));
  }
}
