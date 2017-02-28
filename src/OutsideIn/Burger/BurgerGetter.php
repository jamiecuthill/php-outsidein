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
    $topping = mt_rand(0, count(self::$toppings)-1);

    return new Burger('Hamburger', [self::$toppings[$topping]]);
  }
}
