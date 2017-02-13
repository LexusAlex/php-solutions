<?php

// вычисление факториала рекурсивно
$factorialRecursion = function ($n) use (&$factorialRecursion) {
    if ($n === 1) { // проверка когда нужно остановится
        return 1;
    }

    return $n * $factorialRecursion($n - 1); // рекурентная формула то что меняется каждый шаг пока n не станет 1
};

// вычисление факториала итеративно
$factorialIter = function ($n) {
    // состояние процесса
    // $max - максимальное число
    // $product - результат то есть аккомулятор он и будет изменятся копить результат
    // $counter -счетчик шагов
    $factIter = function ($product, $counter, $max) use ($n, &$factIter) {
        if ($counter > $max) { // завершение процесса
            return $product;
        } else {

            return $factIter($product * $counter, $counter + 1, $max);
        }
    };

    return $factIter(1, 1, $n);

};