<?php
// модуль числа
function myAbs ($x)
{
    if ($x < 0) {
        return -$x;
    } elseif ($x === 0) {
        return 0;
    } else{
        return $x;
    }

};