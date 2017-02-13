<?php

// рациональные числа
require 'pair.php';
require 'gcd.php';

// создать рациональное число
/**
 * @param $numer integer числитель
 * @param $denom integer знаменатель
 * @return Closure
 */
function makeRat($numer, $denom)
{
    $g = gcd($numer,$denom); // Изменили конструктор для специфичных вещей для абстракции
    return cons($numer / $g, $denom / $g);
}

function numer(callable $num) {
    return car($num);
}

function denom(callable $num) {
    return cdr($num);
}

function printRat(callable $num){
    return numer($num) . '/' . denom($num);
}

//+
function add($x, $y)
{
    //a/b + c/d = (a * d + b * c) / b * d
    return makeRat(numer($x) * denom($y) + denom($x) * numer($y), denom($x) * denom($y));
}
//-
function sub($x, $y)
{
    //a/b - c/d = (a * d - b * c) / b * d
    return makeRat(numer($x) * denom($y) - denom($x) * numer($y), denom($x) * denom($y));
}

// *
function mul($x, $y)
{
    //a/b * c/d = a * c / b * d
    return makeRat(numer($x) *  numer($y), denom($x) * denom($y));
}
// /
function div($x, $y)
{
    //a/b / c/d = a * d / b * c
    return makeRat(numer($x) *  denom($y), denom($x) * numer($y));
}
// eq
function isEqual($num1, $num2)
{
    //a/b = c/d, если a * d = c * b*/
    return numer($num1) * denom($num2) === numer($num2) * denom($num1);
}
//var_dump(printRat(makeRat(3,4)));
//var_dump(printRat(makeRat(1,2)));
/*$rat = makeRat(2, 3);

var_dump(printRat(add($rat, $rat)));
var_dump(printRat(sub($rat, $rat)));
var_dump(printRat(mul($rat, $rat)));
var_dump(printRat(div($rat, $rat)));*/
