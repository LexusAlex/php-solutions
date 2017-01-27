<?php

namespace tests;

use pairs;

class PairsTest extends \PHPUnit_Framework_TestCase
{

    public function testIsClosure()
    {
        $this->assertTrue(is_callable(pairs\cons(2, 5)), 'not is callable pair');
    }

    public function testPairs()
    {
        $pair = pairs\cons(1, 2);
        $this->assertEquals(1, pairs\car($pair));
        $this->assertEquals(2, pairs\cdr($pair));
    }

    public function testToString()
    {
        $pairs1 = pairs\cons(23, 'str');
        $pairs2 = pairs\cons(1, pairs\cons(2, pairs\cons(3, pairs\cons(4, pairs\cons(5, pairs\cons('last', null))))));
        $pairs3 = pairs\cons(1, pairs\cons(2, 3));
        $pairs4 = pairs\cons(1, pairs\cons(1.1, pairs\cons(1.2, pairs\cons(1.3, 1.4))));
        $this->assertEquals(pairs\toString($pairs1), '(23, str)');
        $this->assertEquals(pairs\toString($pairs2), '(1, 2, 3, 4, 5, last)');
        $this->assertEquals(pairs\toString($pairs3), '(1, 2, 3)');
        $this->assertEquals(pairs\toString($pairs4), '(1, 1.1, 1.2, 1.3, 1.4)');
    }
}
