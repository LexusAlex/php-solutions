<?php

// композиция - это применение одной функции к результату другой
function compose($f1, $f2) // результат f1 к f2
{
    return function ($value) use ($f1, $f2) {
        return $f2($f1($value));
    };
}

$f = compose(function ($num) {
    return $num / 2;
}, function ($num) {
    return $num * $num;
});

// Как тренировочный пример, массив в строку и наоборот
$f2 = compose(function ($array){
    return implode(' ',$array);
}, function ($stringFromArray){
    return explode(' ',$stringFromArray);
});
//var_dump($f2([1,2,3,4]));
