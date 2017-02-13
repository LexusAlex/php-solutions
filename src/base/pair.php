<?php

// данные со списковой структурой или передача сообщения
// конструктор
function cons($x, $y)
{
    return function ($method) use ($x, $y) {

        if ($method === 'car') {
            return $x;
        } elseif ($method === 'cdr') {
            return $y;
        } else {
            throw new \InvalidArgumentException("Invalid method $method.");
        }
    };
}
// селекторы
// первый элемент пары
function car(callable $pair)
{
    return $pair("car");
}
// второй элемент пары
function cdr(callable $pair)
{
    return $pair("cdr");
}
