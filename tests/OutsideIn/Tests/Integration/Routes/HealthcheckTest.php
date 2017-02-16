<?php

namespace OutsideIn\Tests\Integration\Routes;

use OutsideIn\Tests\Integration\IntegrationTest;

class HealthcheckTest extends IntegrationTest
{
  public function test_apiServer_isAvailable()
  {
    $resp = $this->api->get('/');

    assertThat($resp->getStatusCode(), is(200));
  }

  public function test_healthcheck()
  {
    $resp = $this->api->get('/health');

    assertThat($resp->getStatusCode(), is(200));

    assertThat((string)$resp->getBody(), is('{"status":"OK"}'));
  }
}
