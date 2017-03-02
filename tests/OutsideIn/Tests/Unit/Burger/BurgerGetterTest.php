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

    $collisions = 0;

    for ($i = 1000; $i > 0; $i--) {
      $burger1 = $burgerGetter->getBurger();
      $burger2 = $burgerGetter->getBurger();

      if (count($burger1->getToppings()) == count($burger2->getToppings())) {
        $collisions++;
      }
    }
    assertThat('toppings are mostly random', $collisions, is(lessThan(100)));
  }

  public function test_getBurger_containsUniqueToppings()
  {
    $burgerGetter = new BurgerGetter();

    for ($i = 100; $i > 0; $i--) {
      $burger = $burgerGetter->getBurger();

      $uniqueToppings = array_flip($burger->getToppings());

      assertThat($uniqueToppings, is(arrayWithSize(count($burger->getToppings()))));
    }
  }
}
