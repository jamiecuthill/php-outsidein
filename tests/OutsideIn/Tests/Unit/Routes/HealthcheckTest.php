<?php

namespace OutsideIn\Tests\Unit\Routes;

use Slim\Http\Response;

class HealthcheckTest extends RouteTest
{
  public function test_root()
  {
    $request = $this->newRequest('GET', '/');

    $response = $this->app->process($request, new Response());

    assertThat($response->getStatusCode(), is(200));
  }

  public function test_healthcheck()
  {
    $request = $this->newRequest('GET', '/health');

    $response = $this->app->process($request, new Response());

    assertThat($response->getStatusCode(), is(200));
    assertThat($response->getHeader('Content-Type'), hasItem(containsString('application/json')));

    $rawBody = (string)$response->getBody();
    $this->assertJson($rawBody);

    $body = json_decode($rawBody, true);
    assertThat($body, hasKeyValuePair('status', 'OK'));
  }
}
