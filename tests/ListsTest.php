<?php

namespace tests;

use lists;
use pairs;

class ListsTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateLists()
    {
        $this->assertEquals(pairs\toString(lists\createList()), pairs\toString(lists\createList()));
        $list = pairs\cons(1, pairs\cons((pairs\cons(3, pairs\cons(4, null))), pairs\cons(5, null)));
        $this->assertEquals(pairs\toString($list), pairs\toString(lists\createList(1, lists\createList(3, 4), 5)));
    }

    public function testEqual()
    {
        $this->assertTrue(lists\isEqual(lists\createList(), lists\createList()));
        $this->assertTrue(lists\isEqual(lists\createList(2, 6), lists\createList(2, 6)));
        $this->assertFalse(lists\isEqual(lists\createList(5, 2, 1), lists\createList(5, 2, 7)));
    }

    public function testLength()
    {
        $this->assertEquals(0, lists\length(lists\createList()));
        $list = lists\createList(1, 2, 3);
        $this->assertEquals(3, lists\length($list));
    }

    public function testAppend()
    {
        $this->assertEquals(6, lists\length(lists\append(lists\createList(), lists\createList(1, 2, 3, 4, 5, 6))));
        $this->assertEquals(10, lists\length(lists\append(lists\createList(1, 2, 3, 4, 5), lists\createList(6, 7, 8, 9, 10))));
    }

    public function testReverse()
    {
        $this->assertEquals("(3, 2, 1)", \pairs\toString(lists\reverse(lists\createList(1, 2, 3))));
    }

    public function testHas()
    {
        $this->assertTrue(lists\has(lists\createList(55, 6), 55));
        $this->assertFalse(lists\has(lists\createList(55, 6), 7));
    }

    public function testListReference()
    {
        $this->assertEquals(8, lists\listReference(lists\createList(2, 7, 8, 9, 0), 2));
        $this->assertTrue(lists\has(lists\createList(4, 6, 7), lists\listReference(lists\createList(8, 4, 6), 1)));
    }

    public function testMap()
    {

        $map = lists\map(function ($x) {
            return $x + 3;
        }, lists\createList(1, 2, 3));
        $this->assertEquals(pairs\toString(lists\createList(4, 5, 6)), pairs\toString($map));

        $map = lists\map(function ($x) {
            return $x * 2;
        }, lists\createList());
        $this->assertEquals(pairs\toString(lists\createList()), pairs\toString($map));
    }


   public function testFilter()
   {

       $filter = lists\filter(function ($x) {
           return $x % 2 == 0;
       }, lists\createList(2, 3, 4));
       $this->assertEquals(2, lists\length($filter));
       $this->assertEquals(pairs\toString(lists\createList(2, 4)), pairs\toString($filter));

   }

   public function testReduce()
   {

       $reduced = lists\reduce(function ($x, $acc) {
           return $x + $acc;
       }, lists\createList(1, 2, 3), 0);
       $this->assertEquals(6, $reduced);
   }
}
