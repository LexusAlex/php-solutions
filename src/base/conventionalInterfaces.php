<?php

// Стандартные интерфейсы
require 'map.php';
require 'filter.php';
require 'accumulate.php';

/*
  1. Перечислитель (enumerator) - порождает дерево
  2. Фильтр (filter) - фильтрует дерево, оставляя только нужные элементы
  3. Отображение (map) - преобразует каждый элемент во что-то
  4. Накопитель (accomulator) - считает результат
*/

// операции над каждым элементом
var_dump(toString(map(function ($e){
    return $e * 5;
},l(1,2,3,4,5))));

// фильтрация коллекции - вернем только то что нужно
var_dump(toString(filter(function ($e){
    return ($e > 4 && $e <= 8) ? true : false;
},l(2,3,6,8,9))));

// накопление
var_dump(toString(accumulate(l(1,2,3,4,5), function($item, $acc){
    return $item + $acc;
},0)));