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
    $numberOfAvailableToppings = count(self::$toppings);

    $toppings = [];
    for ($i = $numberOfAvailableToppings - mt_rand(0, $numberOfAvailableToppings-1); $i > 0; $i--) {
      $toppings[] = self::$toppings[mt_rand(0, $numberOfAvailableToppings - 1)];
    }

    return new Burger('Hamburger', $toppings);
  }
}
