<?php
// Состовные данные, абстракция данных

$linearCombination = function($a, $b ,$x ,$y){
    return ($a * $x) + ($b * $y);
};

// но, увидьте разницу

$linearCombination = function($a, $b ,$x ,$y){
    return add( (mul($a , $x)) , (mul($b , $y)) );
};

// введение в абтракцию данных

// пара cons - конструктор car - первое число cdr - второе число - селекторы
// cons(1, (cons (2, cons (3, null))))
function cons($x, $y)
{   // z(x, y)
    return function (callable $z) use ($x, $y) { // возвращаем определяем новую функцию
        return $z($x, $y);// здесь мы просто должны использовать то есть вызвать функцию
    };
}

// первый элемент
function car(callable $pair)
{
    return $pair(function () {
        return func_get_arg(0);
    });
}

// второй элемент
function cdr(callable $pair)
{
    return $pair(function () {
        return func_get_arg(1);
    });
}

//var_dump(cons(2, cons(5, null))); // замыкание
// пробуем проделать для массива
function consArray(array $x)
{   // z(x, y)
    return function (callable $z) use ($x) {
        return $z($x);
    };
}

// вернем первый элемент массива
function carArray(callable $pair)
{
    return $pair(function () {
        return array_values(array_slice(func_get_arg(0), 0, 1))[0];
    });
}

// остаток массива
function cdrArray(callable $pair)
{
    return $pair(function () {
        return array_slice(func_get_arg(0), 1);
    });
}

// сделаем список из аргументов
function consList()
{
    return array_reduce(array_reverse(func_get_args()),function ($acc, $item){
        return cons($item, $acc);
    },null);
}


// первый элемент списка
function carList($pair){
    return car($pair);
}

// хвост списка
function cdrList($pair){
    return cdr($pair);
}

// список из массива
function arrayToList($array){
    return array_reduce(array_reverse($array),function ($acc, $item){
        return cons($item, $acc);
    },null);
}

// массив из списка
function listToArray($list)
{
    $arr = [];
    $iter = function ($items) use (&$arr, &$iter) {
        if (!is_null($items)) {
            $arr[] = carList($items);
            $iter(cdrList($items));
        }
    };
    $iter($list);
    return $arr;
}
//var_dump(listToArray(consList(1,['c'],3,4,5)));
// список из массива

function myPrint($pair){
    echo '<pre>';
    print_r($pair);
    echo '</pre>';
}
$array = [
    ['id' => 1, 'name' => 'language', 'parentId' => null, 'depth' => 0],
    ['id' => 5, 'name' => 'food', 'parentId' => null, 'depth' => 0],
    ['id' => 2, 'name' => 'php', 'parentId' => 1, 'depth' => 1],
    ['id' => 3, 'name' => 'javascript', 'parentId' => 1, 'depth' => 1],
    ['id' => 4, 'name' => 'ruby', 'parentId' => 1, 'depth' => 1],
    ['id' => 9, 'name' => 'sql', 'parentId' => 1, 'depth' => 1],
    ['id' => 6, 'name' => 'apple', 'parentId' => 5, 'depth' => 1],
    ['id' => 7, 'name' => 'rice', 'parentId' => 5, 'depth' => 1],
    ['id' => 8, 'name' => 'ice-cream', 'parentId' => 5, 'depth' => 1],
    ['id' => 10, 'name' => 'mySql', 'parentId' => 9, 'depth' => 2],
    ['id' => 11, 'name' => 'postgreSql', 'parentId' => 9, 'depth' => 2],
    ['id' => 12, 'name' => 'MsSql', 'parentId' => 9, 'depth' => 2],
    ['id' => 13, 'name' => 'version 5.5', 'parentId' => 10, 'depth' => 3],
];

/*
  1. Взять массив сделать из него список
  2. Работать с массивом в терминах списка
  3. Вернуть результат в виде массива
 * */
var_dump(arrayToList($array));
//var_dump(carArray(consArray([9,3,7,8,9])));
//var_dump(cdrArray(consArray([9,3,7,8,9])));
//var_dump(cdrArray(consArray([9,3,7,8,9])));

// Барьеры абстракций

// пары
// рациональные числа как пары       / точки
// числа как числители и знаменатели / отрезок
//                                   /прямоугольник
// программа использующие предметную область