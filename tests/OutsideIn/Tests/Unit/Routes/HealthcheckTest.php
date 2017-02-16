<?php

namespace OutsideIn\Tests\Unit\Routes;

use GuzzleHttp\Psr7\BufferStream;
use Slim\App;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Uri;

class HealthcheckTest extends \PHPUnit_Framework_TestCase
{
  /** @var App */
  private $app;

  protected function setUp()
  {
    parent::setUp();

    $app = new App();
    $this->app = $app;

    require __DIR__ . '/../../../../../src/routes.php';
  }

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

  /**
   * @param string $method
   * @param string $path
   * @param null|string $body
   *
   * @return Request
   */
  private function newRequest($method, $path, $body = null)
  {
    $bufferStream = new BufferStream();
    $bufferStream->write($body);

    return new Request($method, new Uri('http', 'localhost', null, $path), new Headers([]), [], [], $bufferStream);
  }
}
