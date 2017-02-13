<?php

// Процедуры и порождаемые ими процессы

// линейно рекурсивный процесс
// шагов столько какова размереность n

$factorial1 = function ($n) use (&$factorial1) {
    if ($n === 1) { // проверка когда нужно остановится
        return 1;
    }

    return $n * $factorial1($n - 1); // рекурентная формула
};

// цепочка отложенных операций
// интерпретатор все помнит, размеррастет вместе с n
/*
 * $factorial(6)
 * 6 * $factorial1(5)
 * 6 * 5 * $factorial1(4)
 * 6 * 5 * 4 * $factorial1(3)
 * 6 * 5 * 4 * 3 * $factorial1(2)
 * 6 * 5 * 4 * 3 * 2 $factorial1(1) // срарабывает условие выхода
 *
 * // сжатие и выполнение отложенных операций
 * 6 * 5 * 4 * 3 * 2 * 1
 * 6 * 5 * 4 * 3 * 2
 * 6 * 5 * 4 * 6
 * 6 * 120
 * 720
 **/

// линейно итеративный процесс
// хранение состояния на каждом шаге
// произведение = счетчик * произведение
// счетчик = счетчик + 1

$factorial2 = function ($n) {

    $iter = function ($product, $counter) use ($n, &$iter) {
        if ($counter > $n) {
            return $product;
        } else {

            return $iter($counter * $product, $counter + 1);
        }
    };
    return $iter(1, 1);
};


$factorial3 = function ($n) {

    $factIter = function ($product, $conter, $max) use ($n, &$factIter) {
        if ($conter > $max) { // завершение процесса
            return $product;
        } else {

            return $factIter($product * $conter, $conter + 1, $max);
        }
    };

    return $factIter(1, 1, $n);

};

/* помним значения трех переменных на каждом шаге
   число шагов растет с ростом n
   в каждый момент времени переменные программы дают полное описание состояния процесса
   для выполнния процесса интерпретатору достаточно знать только 3 переменные состояния в рекурсивном процессе это не так
 * $factorial(6)
 * $factIter(1, 1, 6) (результат * шаг, шаг, факториал чего нужно найти)
 *
 * $factIter(1 * 1 = 1, 1 + 1 = 2, 6)
 * $factIter(2, 3, 6)
 * $factIter(6, 4, 6)
 * $factIter(24, 5, 6)
 * $factIter(120, 6, 6) $conter > $max
 * $factIter(720, 7, 6) // 720
 *
 * В итоге мы продумываем правила как переменные состояния работают между собой, число шагов зависит от n
  */

//var_dump($factorial1(6));
//var_dump($factorial2(6));
//var_dump($factorial3(6));

// Но при большом числе не хватит памяти, в итеративном процессе мы знаем состояние на каждом шаге и можем его прервать

// Упражения

// +
$inc = function ($x) {
    return $x + 1;
};

// -
$dec = function ($x) {
    return $x - 1;
};

$a = 4;
$b = 5;
$c = $a + $b;

$process1 = ($inc($dec($a) + $b));
$process2 = ($dec($a) + $inc($b));

//var_dump($dec($a) + $inc($b));


/* process1 - рекурсивный
   (4 + 5)
   $inc(3 + 5)
   $inc($inc(2 + 5))
   $inc($inc($inc(1 + 5)))
   $inc($inc($inc($inc(0 + 5))))
   $inc($inc($inc($inc(5))))
   $inc($inc($inc(6)))
   $inc($inc(7))
   $inc(8)
   9

   process2 - итеративный
   (4 + 5)
   $dec(4) + $inc(5)
   3 + 6
   2 + 7
   1 + 8
   0 + 9
   9

 * */

$ak = function ($x, $y) use (&$ak) {
    if ($y == 0) {
        return 0;
    } elseif ($x == 0) {
        return $y * 2;
    } elseif ($y == 1) {
        return 2;
    } else {
        return $ak($x - 1, $ak($x, $y - 1));
    }
};

/**
 *
 * @param $n
 * @return mixed 2 * $n
 */
$f = function ($n) use ($ak) {
    return $ak(0, $n);
};
/**
 * @param $n
 * @return mixed 2^$n
 */
$g = function ($n) use ($ak) {
    return $ak(1, $n);
};
/**
 * @param $n
 * @return mixed 2^n*(n-1)
 */
$h = function ($n) use ($ak) {
    return $ak(2, $n);
};

$ak(1, 10); // 1024
$ak(2, 4); //65536
$ak(3, 3); //65536

// Древовидная рекурсия
// число фибоначчи каждое последующее число - это сумма двух предыдущих

$fib = function ($n) use (&$fib) {
    if ($n == 0) {
        return 0;
    } elseif ($n == 1) {
        return 1;
    } else {
        return ($fib($n - 1) + $fib($n - 2));
    }
};

//var_dump($fib(5));

/*
                      fib(5)
               fib(4)                   fib(3)
        fib(3)          fib(2)      fib(2)  fib(1)
   fib(2)   fib(1) fib(1) fib(0)  fib(1) fib(0) 1
fib(1) fib(0)  1     1      0       1       0
   1    0


В этом решение много лишних операций неэффективный и медленный
 * */
$fib2 = function ($n) use (&$fib2) {
    // a b два последних числа
    $iter = function ($a, $b, $count) use (&$iter) {
        if ($count == 0) {
            return $b;
        }
        return $iter($a + $b, $a, $count - 1);
    };
    return $iter(1, 0, $n);
};
// это решение более эффективно
//var_dump($fib2(5));


//рекурсивный процесс

$func = function ($n) use (&$func) {
    if ($n < 3) {
        return $n;
    } elseif ($n >= 3) {
        return $func($n - 1) + $func($n - 2) + $func($n - 3);
    }
};

// итеративный процесс

$func2 = function ($n) {
    $iter = function ($a, $b, $c, $count) use (&$iter) {
        if ($count == 0) {
            return $c;
        }
        return $iter($a + $b + $c, $a, $b, $count - 1);
    };

    return $iter(2, 1, 0, $n);
};

//var_dump($func(6));
//var_dump($func2(6));

// треугольник паскаля

$pascal = function ($i, $j) use (&$pascal) {
    if (($j == 1) || ($j == $i)) {
        return 1;
    };
    return ($pascal($i - 1, $j - 1) + $pascal($i - 1, $j));
};

//var_dump($pascal(1,2));

// размен монет
// номинал, определяем по номеру
$firstDenomination = function ($coins) {
    if ($coins == 1) {
        return 1;
    } elseif ($coins == 2) {
        return 5;
    } elseif ($coins == 3) {
        return 10;
    } elseif ($coins == 4) {
        return 25;
    } elseif ($coins == 5) {
        return 50;
    }
};

$cc = function ($amount, $coins) use (&$cc, $firstDenomination) {
    if ($amount == 0) {
        return 1;
    } elseif (($amount < 0) || $coins == 0) {
        return 0;
    } else {
        return ($cc($amount, $coins - 1) + $cc($amount - $firstDenomination($coins), $coins));
    }
};

//$countChange = function ($amount){};

//var_dump($cc(11, 5)); // 4
//var_dump($cc(41, 5)); // 31
//var_dump($cc(104, 5)); // 292

// синус угла в радианах
$cube = function ($x) {
    return ($x * $x * $x);
};

$p = function ($x) use ($cube) {
    return (($x * 3) - (4 * $cube($x)));
};

$sine = function ($angle) use ($p, &$sine) {
    if (!abs($angle) > 0.1) {
        return $angle;
    } else {
        return $p($sine($angle / 3.0));
    }
};

/*
 * b^n
 * b^n = b * b^-1
 * b^0 = 0
 *
 * Тетта(n) шагов
 * Тетта(n) памяти
 * */
// возведение числа в степень n - число e - степень

$exp = function ($n, $e) use (&$exp) {
    if ($e == 0) {
        return 1;
    }

    return $n * $exp($n, $e - 1);
};

/*
 * $n = 2 $e = 2 $n * $exp($n,$e - 1) = 2
 * $n = 2 $e = 1 $n * $exp($n,$e - 1) = 4
 * $n = 4 $e = 4 $n * $exp($n,$e - 1) = 2
 *
 * $exp(2, 2)
 * 2 * exp(2, 1)
 * 2 * exp(2, 1) * exp(2, 0) // условие выхода
 * 2 * 2 * 1
 * 4
 * */

$exp2 = function ($b, $n) {
    /*
     * b - число
     * counter - счетчик
     * product - решение
     *
     * Тетта(n) шагов
     * Тетта(1) памяти независит от n
     * */
    $expIter = function ($b, $counter, $product) use (&$expIter) {
        if ($counter == 0) { // прекращаем процесс когда
            return $product;
        }
        // b - не меняется counter это степень числа, за шаг вычитаем 1, результат * число
        return $expIter($b, $counter - 1, $product * $b);
    };

    return $expIter($b, $n, 1);
};


//var_dump($exp(2, 2));
//var_dump($exp2(2, 2));

// Но есть более эффективное решение
// Здесь мы не умножаем каждый раз
/**/
//var_dump($exp2(2, 8));
$e = 2 * 2 * 2 * 2 * 2 * 2 * 2 * 2;
$e2 = 2 * 2;
$e4 = (2 * 2) * (2 * 2);
$e8 = ((2 * 2) * (2 * 2)) * ((2 * 2) * (2 * 2));


//var_dump($e8);
/**
 * Колличество шагов здесь Тетта(log(n)) - медленный рост колличества шагов
 * На самом деле это очень эффективный алгоритм
 * @param $b
 * @param $n
 * @return int
 */
// рекурсивный процесс
$fastExp = function ($b, $n) use (&$fastExp) {
    // проверка числа на четность
    $even = function ($n) {
        if ($n % 2 == 0) {
            return true;
        }
        return false;
    };

    $square = function ($n) {
        return $n * $n;
    };
    // b число n степень
    /*

    (b, n)
    n всегда будет уменьшаться
    когда n == 0         то  1
    когда n делится на 2 то (b, n / 2) * (b, n / 2)
    когда n !== 0        то b * (b, n - 1) // это обычное действие которое производилось выше

    */
    if ($n == 0) {
        return 1;
    } elseif ($even($n)) {
        return $square($fastExp($b, $n / 2));
    } else {
        return $b * $fastExp($b, $n - 1);
    }
};

// итеративный процесс за логарифмические число шагов
$fastExpIter = function ($b, $n) {
    $even = function ($n) {
        if ($n % 2 == 0) {
            return true;
        }
        return false;
    };

    $square = function ($n) {
        return $n * $n;
    };
    // b число n степень
    // b число $counter - счетчик итераций то есть сама степень куда возводить a - результат
    // когда n == 0 то вернем результат a который будет накоплен там
    // когда n делится на 2 то вызовем (число * число, степень / 2, 1)
    // когда n не делиться на 2 то (число, степень - 1, 1 * число)
    $iter = function ($b, $counter, $a) use (&$iter, $even, $square) {
        if ($counter == 0) {
            return $a;
        } elseif ($even($counter)) {
            return $iter($b * $b, $counter / 2, $a);
        } else {
            return $iter($b, $counter - 1, $a * $b);
        }
    };
    return $iter($b, $n, 1);
};

//var_dump($fastExp(2, 8));
//var_dump($fastExpIter(2, 8));

// Наибольший общий делитель
/* НОД
    (16, 28) = 4
*/

$gcd = function ($a, $b) use(&$gcd){
    if($b == 0){
        return $a;
    } else{
        return $gcd($b, $a % $b);
    }
};

//var_dump($gcd(16, 28));