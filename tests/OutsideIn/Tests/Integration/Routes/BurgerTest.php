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
}
