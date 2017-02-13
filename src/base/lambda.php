<?php

$e1 = function (){}; // сохранить в переменной
$e2 = [function(){},function(){},function(){}]; // сохранить в любой структуре данных
$e3 = function (callable $a){return $a();}; // передать как аргумент
$e4 = function (){return function (){};};// возвратить из функции как результат

function($x){ return $x + 4;};

/*$f = function (callable $x){
    return $x(function($x){ return $x + 4;});
};*/