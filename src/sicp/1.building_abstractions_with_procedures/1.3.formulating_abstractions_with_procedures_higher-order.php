<?php
//Формулирование абстракций с помощью процедур высших порядков

$cube = function ($x){
    return $x * $x * $x;
};

$cube(3); // но можно писать и так 3 * 3 * 3 ,что тоже самое

// Процедура манипулирующая другими процедурами называется функцией высшего порядка

// сумма целых чисел
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

$piSum = function ($a, $b) use(&$piSum){
    if ($a > $b ){
        return 0;
    }else{
        return (1 / ($a * ($a + 2))) + $piSum($a + 4, $b);
    }
};
//var_dump($sumCubes(2,3)); // 35
//var_dump($piSum(2,3)); // 35

// Шаблон всех процедур такого типа
/*
     функция = function ($a, $b) use(&функция){
    if ($a > $b ){
      return 0;
    }else{
        return (терм $a) + функция(следующий $a, $b);
    }
};
*/

// что должно происходить с a
$term = function ($a){ return $a;};
// изменение a
$next = function ($b) {return $b + 1;};

/*$sum = function (callable $term,callable $next) use(&$sum,$a, $b){
    if ($a > $b){
        return 0;
    }else{
        return $term($a) + $sum($term($next($a)), $next($b));
    }
};

$sum($term(2),$next(3));*/
/*

$inc = function ($x){ return $x + 1;};

$sumCubes2 = function ($a, $b) use($sum, $cube, $inc){
    return $sum($cube($a), $inc($b));
};*/

// анонимная процедура можно создать процедуру на лету в любом месте программы
function($x){ return $x + 4;}; // это удобно

// Локальные переменные функции