<?php

class FirstTest extends PHPUnit_Framework_TestCase
{
  public function test_helloWorld()
  {
    $client = new \GuzzleHttp\Client(['base_uri' => '192.168.99.101:8080']);
    $resp = $client->get('/');
  }
}
