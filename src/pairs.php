<?php

namespace pairs;

/**
 * @param $x mixed first value
 * @param $y mixed second value
 * @return \Closure
 */
function cons($x, $y)
{
    return function (callable $z) use ($x, $y) {
        return $z($x, $y);
    };
}

/**
 * return first value pair
 * @param callable $pair
 * @return mixed
 */
function car(callable $pair)
{
    return $pair(function () {
        return func_get_arg(0);
    });
}

/**
 * return second value pair
 * @param callable $pair
 * @return mixed
 */
function cdr(callable $pair)
{
    return $pair(function () {
        return func_get_arg(1);
    });
}

/**
 * pairs to string
 * @param $list
 * @return string
 */
function toString($list)
{
    if (!is_callable($list)) {
        return $list;
    }

    $iter = function ($items, array $acc = []) use (&$iter) {
        if (is_null($items)) {
            return $acc;
        }

        if (is_scalar($items)) {
            $acc[] = $items;
            return $acc;
        }
        $first = car($items);
        $last = cdr($items);

        return $iter($last, array_merge($acc, [toString($first)]));
    };

    $arr = $iter($list);

    return "(" . implode(", ", $arr) . ")";
}