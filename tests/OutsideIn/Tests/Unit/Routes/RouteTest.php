<?php

namespace OutsideIn\Tests\Unit\Routes;

use GuzzleHttp\Psr7\BufferStream;
use Slim\App;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Uri;

abstract class RouteTest extends \PHPUnit_Framework_TestCase
{
  /** @var App */
  protected $app;

  protected function setUp()
  {
    parent::setUp();

    $app = new App();
    $this->app = $app;

    require __DIR__ . '/../../../../../src/routes.php';
  }

  /**
   * @param string $method
   * @param string $path
   * @param array $headers
   * @param null|string $body
   *
   * @return Request
   */
  protected function newRequest($method, $path, $headers = [], $body = null)
  {
    $bufferStream = new BufferStream();
    $bufferStream->write($body);

    return new Request($method, new Uri('http', 'localhost', null, $path), new Headers($headers), [], [], $bufferStream);
  }
}
