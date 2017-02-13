<?php
// древовидная рекурсия
// 0, 1, 1, 2, 3, 5, 8, 13, 21
// рекурсивный процесс
$fib = function ($n) use (&$fib) {
    if ($n == 0) {
        return 0;
    } elseif ($n == 1) {
        return 1;
    } else {

        return ($fib($n - 1) + $fib($n - 2));
    }
};

// итеративный процесс
$fib2 = function ($n) use (&$fib2) {
    // a b два последних числа $count - число итераций
    $iter = function ($a, $b, $count) use (&$iter) {
        if ($count == 0) {
            return $b;
        }
        return $iter($a + $b, $a, $count - 1);
    };

    return $iter(1, 0, $n);
};