<?php

namespace phpSolutions\pairs;

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