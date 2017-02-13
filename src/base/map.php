<?php

require 'list.php';
// Отображение списков, операции над каждым элементом списка и возврат нового результата

// повышение уровня абстракции при работе со списками
function map(callable $func, $list)
{
    $map = function ($items, $acc) use (&$map, $func) {
        if (is_null($items)) {
            return reverse($acc);
        }
        return $map(tail($items), cons($func(head($items)), $acc));
    };
    return $map($list, null);
}

/* Функция map
   (items, acc)

    return (tail(items), cons(f(head(items)), $acc))
*/

/*var_dump(listToString(map(function ($e) {
    if ($e % 2 == 1) {
        return $e * 2;
    }
}, l(2, 3, 4))));*/