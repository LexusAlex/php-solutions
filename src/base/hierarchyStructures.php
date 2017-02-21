<?php

require 'map.php';

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

//$l = l(1, l(2, l(3, 4)));
// Как покажет интерпретатор такой код

/* 1
   2
 3  4
*/

// Нужно извлечь 7 из списков
$l2 = l(1, 3, l(5, 7), 9);
$l3 = l(l(7));
$l4 = l(1, l(2, l(3, l( 4, l(5 , l(6, 7))))));
/*
 (1
  2 (
  3 (
  4 (
  5 (
  6, 7
)
)
 * */
toString(tail(head(tail(tail($l2)))));
toString(head($l3));
toString(head (tail (head (tail (head (tail (head (tail (head (tail (head (tail ($l4)))))))))))));



toString(append(l(1, 2, 3), l(4, 5, 6)));
toString(cons(l(1, 2, 3), l(4, 5, 6)));
toString(l(l(1, 2, 3), l(4, 5, 6)));

$l = l(
        l (1, 2, 3),
        l (4, 5, 6),
        l (7, 8, 9)
      );

// Как это раскладывается
/*
    ( (1, 2, 3, null), (4, 5, 6, null) ,(7, 8, 9, null) , null)
cons( (1, 2, 3, null), (4, 5, 6, null) ,(7, 8, 9, null) , null)
cons( cons( (1, 2, 3, null), (4, 5, 6, null) ) ,cons( (7, 8, 9, null) , null))
cons( cons( cons(1, cons(2, cons(3, null))), (4, 5, 6, null) ) ,cons( (7, 8, 9, null) , null))

 */
$m = cons( cons( cons(1, cons(2, cons(3, null))), cons(4, cons(5, cons(6, null))) ) ,cons( cons(7, cons(8, cons(9, null))) , null));

function deepReverse($list){

    if(is_null($list)){
        return null;
    } elseif (!is_callable($list)){
        return $list;
    } else {
        return append(deepReverse(tail($list)), l( deepReverse(head($list))));
    }
}

// делает дерево плоским элементы в одну строку
function fringe($list){
    if(is_null($list)){
        return null;
    } elseif (!is_callable($list)){
        return l($list);
    } else{
        return append( fringe(head($list)), fringe(tail($list)));
    }
}

// Умножить каждое значение в дереве на число
function scaleTree($tree, $factor){
    if(is_null($tree)){
        return null;
    } elseif (!is_callable($tree)){
        return $tree * $factor;
    } else{
        return cons(scaleTree(head($tree), $factor), scaleTree(tail($tree), $factor));
    }
}
// Умножить каждое значение в дереве на число
function scaleTree2($tree, $factor){
    return map(function ($subTree) use($factor){
        if(is_callable($subTree)){
            return scaleTree2($subTree, $factor);
        } else{
            return $subTree * $factor;
        }
    },$tree);
}
var_dump(toString(scaleTree(l(l(2,3),3,4,5),5)));
var_dump(toString(scaleTree2(l(l(2,3),3,4,5),2)));
//var_dump(toString(fringe($l)));
//var_dump(toString(fringe(l($l,$l,$l))));
//var_dump(toString($l));
//toString(deepReverse($l));
//var_dump(toString(deepReverse($l)));
//var_dump(toString(reverseRec($l)));