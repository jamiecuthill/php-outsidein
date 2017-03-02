<?php

namespace OutsideIn\Burger;

class BurgerGetter implements IBurgerGetter
{
  private static $toppings = [
    'Mayo',
    'Lettuce',
    'Pickles',
    'Tomatoes',
    'Grilled Onions',
    'Grilled Mushrooms',
    'Ketchup',
    'Mustard',
    'Relish',
    'Onions',
    'Jalapeño Peppers',
    'Green Peppers',
    'Bar-B-Que Sauce',
    'Hot Sauce',
    'A1 Sauce',
  ];

  /**
   * @return Burger
   */
  public function getBurger()
  {
    $toppingsAvailable = self::$toppings;
    $randNumToppings = mt_rand(0, count($toppingsAvailable));

    for ($i = $randNumToppings; $i > 0; $i--) {
      $toppingToRemove = mt_rand(0, count($toppingsAvailable) - 1);
      unset($toppingsAvailable[$toppingToRemove]);
      $toppingsAvailable = array_values($toppingsAvailable);
    }

    return new Burger('Hamburger', $toppingsAvailable);
  }
}
