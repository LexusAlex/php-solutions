<?php

// Итерация массива
$iterArr = function ($a) {
    $iter = function ($acc, $max, $sum) use (&$iter, $a) {
        if ($acc == $max) {
            return $sum;
        }
        var_dump($a[$acc]);
        return $iter($acc + 1, $max, $sum + $a[$acc]);
    };

    return $iter(0, count($a), 0);
};

// специальная функция для массивов , код в разы короче но принцип тот же

$arr = [[1, 2], [3, 4], [5, 6]];
$arr2 = [['id' => 1, 'p' => 3], ['id' => 2, 'p' => 3], ['id' => 3, 'p' => 3]];

$map = array_map(function ($e) {

    if (is_array($e)) {
        return $new[] = $e;
    }
}, $arr);
//var_dump($new);
// вернуть id элемента по значению
//var_dump($map);
$hasArr = function ($a, $element) {
    $iter = function ($acc) use (&$iter, $a, $element) {

        if ($a[$acc] === $element) {
            return $acc;
        }

        if ($acc >= count($a) - 1) {
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

function i($a)
{
    if (!$a) {
        return false;
    }

    return i(tail($a));
}

// удобно манипулировать массивом
array_walk_recursive($arr2, function ($e, $k) {
    if ($k == 'id' && $e == 2) {
        return false;
    }
    //echo '['.$k.'=>'.$e.']';

});

// количество элементов включая вложенный массив

function countLeaves($a)
{
    if (empty($a)) {
        return 0;
    } elseif (!is_array($a)) {
        return 1;
    } else {
        return countLeaves(head($a)) + countLeaves(tail($a));
    }
}

// перевернуть массив рекурсивно
function reverseRec($arr)
{
    return array_reverse(array_map(function ($v) {
        if (is_array($v)) {
            return array_reverse(reverseRec(array_reverse($v, true)), true);
        } else {
            return $v;
        }
    }, $arr), true);
}


function makeNestedList($array)
{

    foreach ($array as $key => $value) {

        echo "[" . $key . "]";

        if (is_array($value)) {
            echo "\n\t";
            makeNestedList($value);
        } else {

            echo ' => ' . $value . "\n";
        }
        //$output .= ']';
    }

    //$output .= "\n";

    //return $output;
}

// Интервал дат
$from = new \DateTime('2014-01-01');
$to = new \DateTime('2014-12-30');

$period = new \DatePeriod($from, new \DateInterval('P1D'), $to);

$arrayOfDates = array_map(
    function ($item) {
        return $item->format('Y-m-d');
    },
    iterator_to_array($period)
);

$newarr = [
    ['id' => 9, 'comments' => ['theme1' => [9, 8, 7, 6, 5], 'theme2' => [9, 8, 7, 6, 5], 'theme3' => [9, 8, 7, 6, 5]]],
    ['id' => 7, 'comments' => ['theme1' => [9, 8, 7, 6, 5], 'theme2' => [9, 8, 7, 6, 5], 'theme3' => [9, 8, 7, 6, 5]]],
    ['id' => 5, 'comments' => ['theme1' => [9, 8, 7, 6, 5], 'theme2' => [9, 8, 7, 6, 5], 'theme3' => [9, 8, 7, 6, 5]]],
];
$arr3 = [['id' => 1, 'comments' => 6,]];
$arr4 = array_map(null, range(0, 10), range(10, 20), range(20, 30), range(30, 40), range(40, 50), range(50, 60));
$arr5 = [[9, 8, 7], [6, 5, 4], [3, [2, 1]]];

function test($a)
{
    $a = array_map(function ($e) {
        if (is_array($e)) {
            array_walk_recursive($e, function ($v, $k) {
                echo '[' . $k . '] => ' . $v . "\n";
            });
        }

    }, $a);
}

// Задание 1
$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

print_r(array_reduce($x, function ($acc, $item) {
    return ($item == 'a') ? [$item => false] : [$item => $acc];
}, []));

// Задание 2
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];
/**
 * @param array $d
 * @return array
 */
function reveal(array $d)
{
    $data = [];
    foreach ($d as $key => $val) {
        $ptr = &$data;
        foreach (explode('.', $key) as $index) {
            if (!array_key_exists($index, $ptr)) {
                $ptr[$index] = array();
            }
            $ptr = &$ptr[$index];
        }
        $ptr = $val;
    }
    return $data;
}

/**
 * @param array $d
 * @return array
 */
function collapse(array $d)
{
    $data = [];
    foreach ($d as $index => $val) {
        if (is_array($val)) {
            foreach (collapse($val) as $k => $v) {
                $data[$k = $index . '.' . $k] = $v;
            }
        } else {
            $data[$index] = $val;
        }
    }
    return $data;
}


print_r(reveal($data1));
print_r(collapse(reveal($data1)));

//var_dump($r);
//var_dump(makeNestedList($arr5));
//var_dump(head(tail(tail(head($arr5)))));

//var_dump(viewArray($arr5));
//print_r(reverseRec($arr5));
//var_dump(countLeaves($arr3));
//$iterArr([2]);
//var_dump($hasArr([4,3,2,1],27));