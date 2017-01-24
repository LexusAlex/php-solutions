<?php

namespace phpSolutions\tests;

use phpSolutions\pairs;

class PairsTest extends \PHPUnit_Framework_TestCase
{

    public function testIsClosure()
    {
        $this->assertTrue(is_callable(pairs\cons(2, 5)),'not is callable pair');
    }

    public function testPairs()
    {
        $pair = pairs\cons(1, 2);
        $this->assertEquals(1, pairs\car($pair));
        $this->assertEquals(2, pairs\cdr($pair));
    }
}
