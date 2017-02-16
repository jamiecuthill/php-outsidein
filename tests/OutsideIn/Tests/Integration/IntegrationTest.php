<?php

namespace OutsideIn\Tests\Integration;

use GuzzleHttp\Client;

abstract class IntegrationTest extends \PHPUnit_Framework_TestCase
{
  /** @var Client */
  protected $api;

  protected function setUp()
  {
    parent::setUp();

    $this->api = new Client(['base_uri' => ContainerTestListener::getApiHost()]);
  }

}
