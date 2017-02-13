<?php

require 'list.php';

$list1 = cons( cons(1, cons(2, null)), cons(3, cons(4, null)));
// cons ( ( (1, (2, null)) ) ) = (1, 2)
$list2 = cons(l(1, 2), l(3, 4)); // ((1, 2), 3, 4)

// количество элементов списка
function countLeaves($list)
{
    if(is_null($list)){
        return 0;
    } elseif (!is_callable($list)){
        return 1;
    } else{
        return countLeaves(head($list)) + countLeaves(tail($list));
    }
}

//var_dump(countLeaves($list2));

$l = l(1, l(2, l(3, 4)));
// Как покажет интерпретатор такой код

/* 1
   2
 3  4
*/

var_dump(toString($l));
//var_dump(toString($list2));