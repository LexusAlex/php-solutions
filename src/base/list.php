<?php

// последовательности и списки
require 'data.php';

$list = cons(1, cons(2, cons(3, cons(4, null))));

// создать список
function l()
{
    return array_reduce(array_reverse(func_get_args()), function ($acc, $item) {
        return cons($item, $acc);
    });
}

// голова
function head($l)
{
    return car($l);
}

// хвост
function tail($l)
{
    return cdr($l);
}

// вернуть элемент по номеру
function listRef($list, $n)
{
    $iter = function ($list, $max) use (&$iter) {
        if ($max == 0) {
            return head($list);
        } elseif ($max > length($list) - 1) {
            return false;
        }
        //var_dump(head($list));
        return $iter(tail($list), $max - 1);
    };
    return $iter($list, $n);
}

// длина списка
function length($list)
{
    if (is_null($list) || !is_callable($list)) {
        return 0;
    } else {
        return 1 + length(tail($list));
    }
}

function lengthIter($list)
{
    $iter = function ($items, $count) use(&$iter){
        if(is_null($items)){
            return $count;
        }

        return $iter(tail($items), $count + 1);
    };
    return $iter($list, 0);
}
// список в строку
function listToString($list)
{
    $array = [];
    $iter = function ($items) use (&$array, &$iter) {
        if (!is_null($items)) {
            $array[] = head($items);
            $iter(tail($items));
        }
    };
    $iter($list);
    return "(" . implode(", ", $array) . ")";
}

// список в массив
function listToArray($list)
{
    $array = [];
    $iter = function ($items) use (&$array, &$iter) {
        if (!is_null($items)) {
            $array[] = head($items);
            $iter(tail($items));
        }
    };
    $iter($list);
    return $array;
}

// массив в список
function arrayToList($arr)
{
    return array_reduce(array_reverse($arr), function ($acc, $item) {
        return cons($item, $acc);
    });
}

function reverse($list){
    $rev = function($items, $acc) use (&$rev){
        if(is_null($items)){
            return $acc;
        }
        return $rev(tail($items), cons(head($items), $acc));
    };
    return $rev($list, null);
}

function reverseI($list)
{
    $iter = function ($items, $acc) use (&$iter) {

        return is_null($items) ? $acc : $iter(tail($items), cons(head($items), $acc));
    };
    return $iter($list, null);
}

function reverseRec($list)
{
    // BEGIN (write your solution here)
    $iter = function ($list, $acc) use (&$iter) {
        if ($list === null) {
            return $acc;
        } else {
            $element = head($list);
            if (is_callable($element)) {
                $newAcc = reverseRec($element);
            } else {
                $newAcc = $element;
            }
            return $iter(tail($list), cons($newAcc, $acc));
        }
    };
    return $iter($list, null);
    // END
}

function append($list1, $list2)
{
    if (is_null($list1)) {
        return $list2;
    } else {
        return cons(head($list1), append(tail($list1), $list2));
    }
}

// последний элемент списка
function lastPair($list){
    if(length($list) == 1){
        return head($list);
    }
    //var_dump(length($list));
    return lastPair(tail($list));
}

function toString($list)
{
    if (!is_callable($list)) {
        return $list;
    }

    $iter = function ($items, array $acc = []) use (&$iter) {
        if (is_null($items)) {
            return $acc;
        }

        if (is_scalar($items)) {
            $acc[] = $items;
            return $acc;
        }
        $first = car($items);
        $last = cdr($items);

        return $iter($last, array_merge($acc, [toString($first)]));
    };

    $arr = $iter($list);

    return "(" . implode(", ", $arr) . ")";
}

//print_r(lastPair(l(2,3,4,5)));
//print_r($list); // идентично

//var_dump(car(l(1,2,3,4))); // 1
//var_dump(cdr(l(1,2,3,4))); // 2 3 4
//var_dump(car(cdr(l(1,2,3,4)))); // 2
//var_dump(head(tail(tail(tail(l(1,2,3,4)))))); // 4 - в терминах списка
//var_dump(listRef(l(2,5,6,9),0));
/*var_dump(length(l(1,7,8,9)));
var_dump(lengthIter(l(1,7,8,9)));
var_dump(length(l()));
var_dump(lengthIter(l()));*/
//var_dump(listToString(l(1, 7, 8, 9)));
//var_dump(listToArray(l(1, 7, 8, 9)));
//var_dump(listToString(arrayToList(listToArray(arrayToList([1, 7, 8, 9])))));
$arr = [ [2,3], [5,6], [7,8] ];
$arr2 = [ [55,66], [8,77], [99,101] ];
//var_dump(listToString(l(7, 4, 5, 6)));
//var_dump(listToString(reverse(l(7, 4, 5, 6))));
//var_dump(listToArray(reverseI(arrayToList($arr))));
//var_dump(listToArray(append(arrayToList($arr),arrayToList($arr2)))); // склеили два массива с помощью пар
//var_dump(toString(reverseRec(l(2,3,4,5, l(8,7,6)))));

// попробуем выразить массив в терминах пар
//var_dump(arrayToList($arr));