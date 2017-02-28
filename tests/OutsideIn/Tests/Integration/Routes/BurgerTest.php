<?php

namespace OutsideIn\Tests\Integration\Routes;

use OutsideIn\Tests\Integration\IntegrationTest;

class BurgerTest extends IntegrationTest
{
  public function test_burger()
  {
    $resp = $this->api->get('/burger');

    assertThat($resp->getStatusCode(), is(200));
  }

  public function test_burger_returnsBurger()
  {
    $resp = $this->api->get('/burger');

    $rawBody = (string)$resp->getBody();
    $body = json_decode($rawBody, true);

    assertThat($body, is(not(null)));
    assertThat($body, hasKey('burger'));
    assertThat($body['burger'], hasKeyValuePair('name', 'Hamburger'));
    assertThat($body['burger'], hasKeyValuePair('toppings', allOf(
      hasItem('Mayo'),
      hasItem('Lettuce')
    )));
  }
}
