<?php
// Что такое данные
// Для любых объектов x y если z есть cons(x y) то car(z) x а cdr(z) y
// Строим структуры данных без структур данных

/**
 * @param $x
 * @param $y
 * @return Closure
 */
function cons($x, $y)
{
    return function (callable $func) use ($x, $y) {
        return $func($x, $y);
    };
}

/**
 * @param callable $pair
 * @return mixed
 */
function car(callable $pair)
{
    return $pair(function ($one, $two) {
        return $one;
    });
}

/**
 * @param callable $pair
 * @return mixed
 */
function cdr(callable $pair)
{
    return $pair(function ($one, $two) {
        return $two;
    });
}

/*
 Подстановочная модель как работают такое представление данных
car(cons(3,4))
car(function($f){return $f(3, 4)})
$f(3, 4){ return 3}
3

В общем виде
car(cons(x, y))
car(function(callable $func){return $func(x, y)})
function(function(callable $func){return $func(x, y)}){ return $func(x, y){return x}}

1. Существует функция g которая принимает другую функцию f
2. Функция g возвращает функцию f с аргументами x и y
3. Вызываем функцию g() куда передаем эту функцию f(x, y) которая вернут нужный агрумент
*/

// Пример работы функции
$f = function ($x, $y, $car = true) {
    $g = function ($f) use ($x, $y) {
        return $f($x, $y);
    };
    if($car){
        return $g(function ($one, $two) {
            return $one;
        });
    }else{
        return $g(function ($one, $two) {
            return $two;
        });
    }

};

//var_dump($f(6, 3, false));
