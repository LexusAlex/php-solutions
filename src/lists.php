<?php

namespace lists;

require_once 'pairs.php';

/**
 * creates list shortcut
 * \pairs\toString(createList(1,2,3)) // (1, 2, 3)
 * \pairs\toString(\pairs\cons(1, \pairs\cons(2, \pairs\cons(3, null)))) // (1, 2, 3)
 * @return mixed
 */
function createList()
{

    return array_reduce(array_reverse(func_get_args()), function ($acc, $item) {
        return \pairs\cons($item, $acc);
    });
}

/**
 * head value
 * @param $list
 * @return mixed
 */
function head($list)
{
    return \pairs\car($list);
}

/**
 * tail values
 * @param $list
 * @return mixed
 */
function tail($list)
{
    return \pairs\cdr($list);
}

/**
 * length list, key list = length - 1
 * @param $list
 * @return int
 */

function length($list)
{
    if ($list === null || !is_callable($list)) {
        return 0;
    } else {
        return 1 + length(tail($list));
    }
}

/**
 * equal two lists
 * @param $list1
 * @param $list2
 * @return bool
 */
function isEqual($list1, $list2)
{

    if (empty($list1) && empty($list2)) {
        return true;
    } elseif (empty($list1) || empty($list2)) {
        return false;
    }

    if (head($list1) !== head($list2)) {
        return false;
    }

    return isEqual(tail($list1), tail($list2));

}

/**
 * add $list2 to $list3
 * @param $list1
 * @param $list2
 * @return \Closure
 */
function append($list1, $list2)
{
    if ($list1 === null) {
        return $list2;
    } else {
        return \pairs\cons(head($list1), append(tail($list1), $list2));
    }
}

/**
 * reverse list
 * @param $list
 * @return mixed
 */
function reverse($list)
{
    $iter = function ($items, $acc) use (&$iter) {

        return is_null($items) ? $acc : $iter(\pairs\cdr($items), \pairs\cons(\pairs\car($items), $acc));
    };
    return $iter($list, null);
}

/**
 * is element into list
 * @param $list
 * @param $element
 * @return bool
 */
function has($list, $element)
{
    if (empty($list)) return false;

    if (head($list) === $element) return true;

    return has(tail($list), $element);
}

/**
 * return the element based on position
 * @param $list
 * @param $position
 * @return mixed
 */
function listReference($list, $position)
{
    if ($position === 0) {
        return head($list);
    } elseif ($position > length($list) - 1) {
        return false;
    }

    return listReference(tail($list), $position - 1);
}

/**
 * @param callable $func
 * @param $list
 * @return mixed
 */
function map(callable $func, $list)
{
    $map = function ($items, $acc) use (&$map, $func) {
        if (is_null($items)) {
            return reverse($acc);
        }
        return $map(tail($items), \pairs\cons($func(head($items)), $acc));
    };
    return $map($list, null);
}

/**
 * @param callable $func
 * @param $list
 * @return mixed
 */
function filter(callable $func, $list)
{
    $map = function ($func, $items) use (&$map) {
        if ($items === null) {
            return null;
        } else {
            $curr = head($items);
            $rest = $map($func, tail($items));
            // filter
            return $func($curr) ? \pairs\cons($curr, $rest) : $rest;
        }
    };
    return $map($func, $list);
}

/**
 * @param callable $func
 * @param $list
 * @param null $acc
 * @return mixed
 */
function reduce(callable $func, $list, $acc = null)
{
    $iter = function ($items, $acc) use (&$iter, $func) {
        return is_null($items) ? $acc : $iter(tail($items), $func(head($items), $acc));
    };
    return $iter($list, $acc);
}