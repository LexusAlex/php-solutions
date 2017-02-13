<?php
// Building abstractions with procedures
// Построение абстракций с помощью процедур
// Элементы программирования

/*
 prefix (+ 1 1 )
 infix (1 + 1)
 postfix (1++)
 */
$e = (1 + 1);
$e = (1 + 1 - 1);
$e = (2 == 1 + 1); // сначала сложение потом сравнение
$e = (2 * 2 * 2);
$e = ((1 + 1) * (1 + 1));
$e = ((3 * ((2 * 4) + (3 + 5))) + ((10 - 7) + 6)); // 57

// (define radius 10)
$var = 2; // переменная присвоение по значению
$var2 = &$var; // присвоение по ссылке
$var2 = 8; // меняет также значение в var
$radius = 10; // просто связь значения и имени но это не комбинация
$quatro = ($radius * $radius);
$var3 = (2 + 2 - 1);
define("C", "something"); // константа, ее нельзя менять но можно использовать
//var_dump($quatro);

//вычисление комбинаций
// 1. Вычислить подвыражения комбинации
// 2. Применить процедуру левого подвыражния к аргументам остальных подвыражний
// процесс вычисления
$comb = ((1 + 1) * (2 + (1 + 1 * (2 * 3))));
(2 * (2 + (1 + 1 * 6)));
(2 * (2 + 7));
(2 * 9);
(18);
// Накопления по дереву (tree accomulation)
//var_dump($comb);

// composite procedures - составные процедуры
$square = function ($x) {
    return $x * $x;
};
// Чтобы возвести число в квадрат нужно число умноржить само на себя
$procedure = $square(4); // 16
$procedure = $square(2 + 2); // 16
$procedure = $square($square(2)); // 16
$procedure = $square(4) + $square(4); // 32 - сумма квадратов

$sumOfSquares = function ($x, $y) use ($square) { // сумма квадратов
    return $square($x) + $square($y);
};

$sumOfSquares(4, 4); // 32

$f = function ($a) use ($sumOfSquares) { // можно комбинировать как угодно
    return $sumOfSquares($a, $a);
};

$f(4, 4); // 32

// разложим как будет происходить Подстановочная модель применения процедуры
$f(4, 4);
$sumOfSquares(4, 4);
($square(4) + $square(4));
((4 * 4) + (4 * 4));
((16) + (16));
(32);

// другой способ вычисления называется апликативный когда сначала определяют все элементарные выражения а потом все вычисляют по очереди

// condition
function module($x)
{
    if ($x < 0) { // предикат
        return -$x; // ветка
    } else {
        return $x;
    }

}

// можно так что аналогично
$x = 19;
($x < 0) ? $x = -$x : $x;

(true && true) ? $res = true : $res = false; //  true если а и b true
(true && false) ? $res = true : $res = false; // false
(false && true) ? $res = true : $res = false; // false
(false && false) ? $res = true : $res = false; // false

(true || true) ? $res = true : $res = false; // true если или $a, или $b true.
(true || false) ? $res = true : $res = false; // true
(false || true) ? $res = true : $res = false; // true
(false || false) ? $res = true : $res = false; // false

!true ? $res = true : $res = false; // false
!false ? $res = true : $res = false; //true

$a = 1;
$cond = (($a > 5) && ($a < 10));
// 7 true
// 10 false
// 1 false
//var_dump($cond);

$x = 3;
$y = 3;

$result = ($x > $y || $x == $y); // одно число больше либо равно другому числу

//var_dump($result);

// Упражнения
// 1
$r = (5 + 3 + 4); // 12
$r = (9 - 1); // 8
$r = (6 / 2); // 3
$r = ((2 * 4) + (4 - 6)); // 8 + (-2) = 6
$a = 3;
$b = $a + 1; //4
$r = ($a + $b + ($a * $b)); // 3 + 4 + 12 = 19
$r = ($a == $b); //false

if (($b > $a) && ($b < ($a * $b))) { // (true) && (4 < 12) = true && true = true = 4
    $r = $b;
}

if (($a == 4)) {
    $r = 6;
} elseif ($b == 4) {
    $r = $a + 6 + 7; // 3 + 6 + 7 = 16
} else {
    $r = 25;
}

$r = (2 + (($b > $a) ? $b : $a)); // (2 + (true) ? 4 : 3) = (2 + 4) = 6

if ($a > $b) {
    $r = $a;
} elseif ($a < $b) {
    $r = $b;
} else {
    $r = -1;
}
$r = ($r * ($a + 1)); //16
//var_dump($r);

//Определите процедуру, которая принимает в качестве аргументов три числа и возвращает сумму квадратов двух больших из них.
$sumOfSquaresOfTopTwo = function ($a, $b, $c) use ($sumOfSquares) {

    if ($a == max([$a, $b])) { // 4, 2, 3   4 == max (4, 2)
        return $sumOfSquares($a, max([$b, $c])); // 4 max (2, 3) = 16 9 = 25
    } else {
        return $sumOfSquares($b, max([$a, $c])); // 1 2 3   2 max(1, 3) 4 9 = 13
    }
};


//var_dump($sumOfSquaresOfTopTwo(1,2,3));

/*$p = function() use(&$p){
    return $p();
};

$test = function ($x, $y){
    if($x == 0){
        return 0;
    }else{
        return $y;
    }
};

$test(0, $p());*/ // произойдет ошибка разберем подробнее

// Апликативный порядок вычислений
//$test(0, function p(){return p()}); // интерпретатор вычисляет агрументы (0, бесконечная функция, здесь ошибка)

// Нормальный порядок вычислений
//$test(0, function p(){return p()});
0; // так как до вычисления второго аргумента вычисления не дойдут

// Метод приближений

/*(define (square x) (* x x))

(define (average x y)
(/ (+ x y) 2))

(define (sqrt x)
(define (good-enough? guess)
(< (abs (- (square guess) x)) 0.001))
(define (improve guess)
(average guess (/ x guess)))


(define (sqrt-iter guess)
  (if (good-enough? guess)
    guess
    (sqrt-iter (improve guess))
  )
)

(sqrt-iter 1.0))

(sqrt 16)*/

// автономная работа всех частей программы
$sqrt = function ($x) {

    // квадрат числа
    $square = function ($x) {
        return $x * $x;
    };

    // среднее значение числа
    $average = function ($x, $y) {
        return ($x + $y) / 2;
    };

    // модуль числа
    $abs = function ($x)
    {
        if ($x < 0) {
            return -$x;
        } elseif ($x === 0) {
            return 0;
        } else{
            return $x;
        }

    };

    // достаточное приближение?
    $goodEnough = function ($guess) use ($square, $x, $abs) {
        // abs($square(1.0) - 16)) = 15 < 0.001 // false;

        return $abs($square($guess) - $x) < 0.001;
    };

    // улучшение
    $improve = function ($guess) use ($average, $x) {
        //$average(1, 16 / 1) = 17 / 2 = 8.5
        return $average($guess, $x / $guess);
    };

    // рекурсивная функция
    $sqrtIter = function ($guess) use ($goodEnough, $improve, &$sqrtIter) {
        if ($goodEnough($guess)) {
            return $guess;
        }
        return $sqrtIter($improve($guess));
    };

    // начнем
    return $sqrtIter(1.0);
};


//var_dump($sqrt(16));
// Для наглядности можно составлять процедурную декомпозицию
// Вопросы: как понять что процесс завершен
// Определение процедуры должно быть способным скрывать детали

/*От пользователя не должно требоваться знания, как
работает процедура, чтобы ее использовать*/

// формальные параметры процедуры называют связанными
// определенение множества процедур не есть хорошо

// блочная структура нужна для разбития большой программы на мелкие куски