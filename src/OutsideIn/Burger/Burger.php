<?php

namespace OutsideIn\Burger;

class Burger implements \JsonSerializable
{
  /**
   * @var string
   */
  private $name;

  /**
   * @var string[]
   */
  private $toppings;

  /**
   * Burger constructor.
   *
   * @param string $name
   * @param string[] $toppings
   */
  public function __construct($name, $toppings)
  {
    $this->name = $name;
    $this->toppings = $toppings;
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
      'toppings' => $this->toppings,
    ];
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @return array
   */
  public function getToppings()
  {
    return $this->toppings;
  }
}
