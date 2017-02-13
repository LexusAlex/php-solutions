<?php
// наибольший общий делитель
/**
 * @param $a
 * @param $b
 * @return mixed
 */
function gcd ($a, $b){
    if($b == 0){
        return $a;
    } else{
        return gcd($b, $a % $b);
    }
};

//var_dump(gcd(4, 16));