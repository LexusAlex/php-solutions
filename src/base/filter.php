<?php

// фильтрация последовательности

function filter(callable $func, $list)
{
    $map = function ($func, $items) use (&$map) {
        if ($items === null) {
            return null;
        } else {
            $curr = head($items);
            $rest = $map($func, tail($items));
            // filter
            return $func($curr) ? cons($curr, $rest) : $rest;
        }
    };
    return $map($func, $list);
}