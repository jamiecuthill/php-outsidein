<?php

namespace OutsideIn\Tests\Integration;

use Mockery\Exception\RuntimeException;

class ContainerTestListener extends \PHPUnit_Framework_BaseTestListener
{
  const INTEGRATION_SUITE = 'Integration';

  const DATABASE_NAME = 'outsidein';
  const DATABASE_PASSWORD = 'password';
  const DOCKER_PROJECT_NAME = 'outsidein';

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

  /**
   * @return string
   */
  public static function getApiHost()
  {
    return sprintf('%s:%d', self::getDockerHost(), self::getApiPort());
  }

  /**
   * @return string
   */
  private static function getDockerHost()
  {
    if (!empty(getenv("DOCKER_HOST"))) {
      $host = parse_url(getenv("DOCKER_HOST"), PHP_URL_HOST);
      return $host;
    } else {
      $host = "127.0.0.1";
      return $host;
    }
  }

  /**
   * @return int
   * @throws RuntimeException
   */
  private static function getApiPort()
  {
    $out = [];
    $result = null;
    $cmd = sprintf('docker-compose -p %s port api 80 2>&1', self::DOCKER_PROJECT_NAME);
    exec($cmd, $out, $result);
    if ($result !== 0) {
      throw new RuntimeException('Unable to discover port of API');
    }
    return (int)parse_url(join($out), PHP_URL_PORT);
  }

  private function stopContainers()
  {
    exec(sprintf('docker-compose -p %s stop 2>&1', self::DOCKER_PROJECT_NAME));
  }

  private function startContainers()
  {
    $dockerComposeOut = [];
    $result = null;
    exec(sprintf('docker-compose -p %s up -d 2>&1', self::DOCKER_PROJECT_NAME), $dockerComposeOut, $result);
    if ($result !== 0) {
      throw new \RuntimeException('Docker compose failed: ' . join("\n", $dockerComposeOut));
    }
  }
}
