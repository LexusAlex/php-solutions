<?php

// накопление

function accumulate($list, $func, $acc){
    $iter = function($list, $acc) use (&$iter, $func){
        if ($list == null){
            return $acc;
        }

        return $iter(cdr($list), $func(car($list), $acc));
    };

    return $iter($list, $acc);
}

/*var_dump(toString(accumulate(l(1,2,3,4,5), function($item, $acc){
    return $item + $acc;
},0)));*/