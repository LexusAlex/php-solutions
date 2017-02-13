<?php

// Базовые элементы программирования
// Процессы

// Вывести число 10 на экран 10 раз разными способами
// Рекурсивный процесс
$ten = function ($num,$acc,$n = 1) use (&$ten){
    if($acc == 0){
        return false;
    }else{
        //print_r($n." - ".$num."\n");
        return $ten($num,$acc - 1,$n + 1);
    }
};
//$ten(10, 10);
// Итеративный процесс
$tenI = function ($num){
    $tenIter = function ($acc) use(&$tenIter, $num){
        if ($acc !== 10){
            //print_r($acc." - ".$num."\n");
            return $tenIter($acc + 1);
        }
    };
    return $tenIter(1);
};

$tenI(10);
for ($i = 1; $i <= 10; $i++){
    //print_r($i." - 10\n");
}

$i = 1;
while ($i <= 10){
    //print_r($i." - 10\n");
    $i++;
}

foreach (range(1,10) as $v){
    //print_r($v." - 10\n");
}

$i = 1;
do {
    //print_r($i." - 10\n");
    $i++;
} while ($i <= 10);