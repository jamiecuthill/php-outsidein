<?php

namespace OutsideIn\Burger;

class BurgerGetter implements IBurgerGetter
{

  /**
   * @return Burger
   */
  public function getBurger()
  {
    return new Burger('Hamburger');
  }
}
