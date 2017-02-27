<?php

namespace OutsideIn\Tests\Unit\Burger;

use OutsideIn\Burger\BurgerGetter;

class BurgerGetterTest extends \PHPUnit_Framework_TestCase
{
  public function test_getBurger_returnsBurger()
  {
    $burgerGetter = new BurgerGetter();
    $burger = $burgerGetter->getBurger();
    assertThat($burger, is(anInstanceOf($burger)));
    assertThat($burger->getName(), is('Hamburger'));
  }
}
