<?php

namespace OutsideIn\Tests\Unit\Routes;


use Slim\Http\Response;

class BurgerTest extends RouteTest
{
  public function test_burger_returnsOK() {
    $response = $this->app->process($this->newRequest('GET', '/burger'), new Response());

    assertThat($response->getStatusCode(), is(200));
  }
}
