<?php
// Нахождение наибольшего общего делителя
function smallestDivisor ($num) {
    $iter = function ($acc) use ($num, &$iter){
        if ($acc > $num / 2) {
            return $num;
        }
        if ($num % $acc === 0) {
            return $acc;
        }
        return $iter($acc + 1);
    };

    return $iter(2);
};
