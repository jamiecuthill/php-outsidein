<?php

namespace OutsideIn\Burger;

class Burger implements \JsonSerializable
{
  /**
   * @var string
   */
  private $name;

  /**
   * Burger constructor.
   *
   * @param $name
   */
  public function __construct($name)
  {
    $this->name = $name;
  }

  /**
   * Specify data which should be serialized to JSON
   *
   * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
   * @return mixed data which can be serialized by <b>json_encode</b>,
   * which is a value of any type other than a resource.
   * @since 5.4.0
   */
  function jsonSerialize()
  {
    return [
      'name' => $this->name,
    ];
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
}
