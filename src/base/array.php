<?php

// Итерация массива
$iterArr = function ($a){
    $iter = function ($acc,$max,$sum) use(&$iter,$a){
        if($acc == $max){
            return $sum;
        }
        var_dump($a[$acc]);
        return $iter($acc + 1,$max,$sum + $a[$acc]);
    };

    return $iter(0,count($a),0);
};

// специальная функция для массивов , код в разы короче но принцип тот же

$arr = [ [1,2], [3,4], [5,6] ];
$arr2 = [ ['id'=>1,'p'=>3], ['id'=>2,'p'=>3], ['id'=>3,'p'=>3]];
$map = array_map(function ($e){
    $new = [];
    if(is_array($e)){
        return $new[] = $e;
    }
},$arr);
// вернуть id элемента по значению
//var_dump($map);
$hasArr = function ($a,$element){
    $iter = function ($acc) use(&$iter,$a, $element){

        if($a[$acc] === $element){
            return $acc;
        }

        if($acc >= count($a) - 1){
            return false;
        }

        return $iter($acc + 1);
    };

    return $iter(0);
};

// первый элемент массива
function head(array $array)
{
    if (empty($array)) {
        return false;
    }
    return array_values(array_slice($array, 0, 1))[0];
}

// хвост в виде массива
function tail(array $array)
{
    return array_slice($array, 1);
}

function i ($a){
    if(!$a) {
        return false;
    }

    return i(tail($a));
}

// удобно манипулировать массивом
array_walk_recursive($arr2,function ($e, $k){
    if($k == 'id' && $e == 2){return false;}
    //echo '['.$k.'=>'.$e.']';

});

// количество элементов включая вложенный массив

function countLeaves($a)
{
    if(empty($a)){
        return 0;
    } elseif (!is_array($a)){
        return 1;
    } else{
        return countLeaves(head($a)) + countLeaves(tail($a));
    }
}

$arr3 = [ ['id'=>1, 'comments'=>[2,5]],];
var_dump(countLeaves($arr3));
//$iterArr([2]);
//var_dump($hasArr([4,3,2,1],27));