<?php

namespace OutsideIn\Tests;

class ContainerTestListener extends \PHPUnit_Framework_BaseTestListener
{
  const INTEGRATION_SUITE = 'Integration';

  const DATABASE_NAME = "outsidein";
  const DATABASE_PASSWORD = "password";

  private static $first = true;

  public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
  {
    if (self::$first && strpos($suite->getName(), self::INTEGRATION_SUITE) !== false) {
      $this->startContainers();
      self::$first = false;
      register_shutdown_function(function () {
        $this->stopContainers();
      });
    }
  }

  private function stopContainers()
  {
    exec('docker-compose -p outsidein stop 2>&1');
  }

  private function startContainers()
  {
    $dockerComposeOut = [];
    $result = null;
    exec('docker-compose -p outsidein up -d 2>&1', $dockerComposeOut, $result);
    if ($result !== 0) {
      throw new \RuntimeException('Docker compose failed: ' . join("\n", $dockerComposeOut));
    }
  }
}
