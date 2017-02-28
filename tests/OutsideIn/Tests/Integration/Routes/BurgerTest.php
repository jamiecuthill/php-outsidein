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
    $body = $this->requestBurger();

    assertThat($body, is(not(null)));
    assertThat($body, hasKey('burger'));
    assertThat($body['burger'], hasKeyValuePair('name', 'Hamburger'));
    assertThat($body['burger'], hasKeyValuePair('toppings', anyOf(
      hasItem('Mayo'),
      hasItem('Lettuce'),
      hasItem('Pickles'),
      hasItem('Tomatoes'),
      hasItem('Grilled Onions'),
      hasItem('Grilled Mushrooms'),
      hasItem('Ketchup'),
      hasItem('Mustard'),
      hasItem('Relish'),
      hasItem('Onions'),
      hasItem('Jalapeño Peppers'),
      hasItem('Green Peppers'),
      hasItem('Bar-B-Que Sauce'),
      hasItem('Hot Sauce'),
      hasItem('A1 Sauce')
    )));
  }

  public function test_burger_hasRandomToppings()
  {
    $burger1 = $this->requestBurger();
    $burger2 = $this->requestBurger();

    assertThat($burger1['burger']['toppings'], is(not(equalTo($burger2['burger']['toppings']))));
  }

  /**
   * @return mixed
   */
  private function requestBurger()
  {
    $resp = $this->api->get('/burger');

    $rawBody = (string)$resp->getBody();
    $body = json_decode($rawBody, true);
    return $body;
  }
}
