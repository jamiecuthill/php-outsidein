<?php

namespace OutsideIn\Burger;

use OutsideIn\Burger\Burger;

interface IBurgerGetter
{
  /**
   * @return Burger
   */
  public function getBurger();
}
