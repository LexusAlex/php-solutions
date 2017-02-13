<?php
// Процедуры высшего порядка в php - это функции

// куб
$cube = function ($x){
    return $x * $x * $x;
};

// сумма целых чисел от a до b
$sumInt = function ($a, $b) use(&$sumInt){
    if ($a > $b ){
        return 0;
    }else{
        return $a + $sumInt($a + 1, $b);
    }
};

// сумма кубов целых чисел в заданном диапазоне
$sumCubes = function ($a, $b) use(&$sumCubes, $cube){
    if ($a > $b ){
        return 0;
    }else{
        return $cube($a) + $sumCubes($a + 1, $b);
    }
};

// сумма последовательности термов
$piSum = function ($a, $b) use(&$piSum){
    if ($a > $b ){
        return 0;
    }else{
        return (1 / ($a * ($a + 2))) + $piSum($a + 4, $b);
    }
};

// абстракция суммирования последовательности
