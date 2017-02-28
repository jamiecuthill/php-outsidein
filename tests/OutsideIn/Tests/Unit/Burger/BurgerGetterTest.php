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
    assertThat($burger->getToppings(), anyOf(
      hasItem('Mayo'),
      hasItem('Lettuce'),
      hasItem('Pickles'),
      hasItem('Tomatoes'),
      hasItem('Grilled Onions'),
      hasItem('Grilled Mushrooms'),
      hasItem('Ketchup'),
      hasItem('Mustard'),
      hasItem('Relish'),
      hasItem('Onions'),
      hasItem('Jalapeño Peppers'),
      hasItem('Green Peppers'),
      hasItem('Bar-B-Que Sauce'),
      hasItem('Hot Sauce'),
      hasItem('A1 Sauce')
    ));
  }

  public function test_getBurger_hasRandomToppings()
  {
    $burgerGetter = new BurgerGetter();
    $burger1 = $burgerGetter->getBurger();
    $burger2 = $burgerGetter->getBurger();

    assertThat($burger1->getToppings(), is(not(equalTo($burger2->getToppings()))));
  }

  public function test_getBurger_hasRandomNumberOfToppings()
  {
    $burgerGetter = new BurgerGetter();
    $burger1 = $burgerGetter->getBurger();
    $burger2 = $burgerGetter->getBurger();

    assertThat(count($burger1->getToppings()), is(not(equalTo(count($burger2->getToppings())))));
  }
}
