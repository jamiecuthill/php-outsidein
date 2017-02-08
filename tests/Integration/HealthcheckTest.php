<?php

namespace OutsideIn\Tests\Integration;

use GuzzleHttp\Client;
use OutsideIn\Tests\ContainerTestListener;

class HealthcheckTest extends \PHPUnit_Framework_TestCase
{
  public function test_apiServer_isAvailable()
  {
    $client = new Client(['base_uri' => ContainerTestListener::getApiHost()]);
    $resp = $client->get('/');

    assertThat($resp->getStatusCode(), is(200));
  }

  public function test_healthcheck()
  {
    $client = new Client(['base_uri' => ContainerTestListener::getApiHost()]);
    $resp = $client->get('/health');

    assertThat($resp->getStatusCode(), is(200));
  }
}
