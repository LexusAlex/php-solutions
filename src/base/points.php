<?php

require 'points.php';

/**
 * @param $x
 * @param $y
 * @return \Closure
 */
function makePoint($x, $y)
{
    return cons($x, $y);
}

/**
 * @param callable $pair
 * @return mixed
 */
function getX(callable $pair)
{
    return car($pair);
}

/**
 * @param callable $pair
 * @return mixed
 */
function getY(callable $pair)
{
    return cdr($pair);
}

/**
 * @param callable $pair
 * @return int
 */
function quadrant(callable $pair)
{
    $x = getX($pair);
    $y = getY($pair);

    if ($x > 0 && $y > 0) {
        return 1;
    } elseif ($x < 0 && $y > 0) {
        return 2;
    } elseif ($x < 0 && $y < 0) {
        return 3;
    } else {
        return 4;
    }

}

/**
 * Меняем знак у точек
 * @param callable $pair
 * @return \Closure
 */
function symmetricalPoint(callable $pair)
{
    return makePoint(-getX($pair), -getY($pair));
}

/**
 * @param callable $point1
 * @param callable $point2
 * @return float
 */
function distance(callable $point1, callable $point2)
{
    $x1 = getX($point1);
    $x2 = getX($point2);
    $y1 = getY($point1);
    $y2 = getY($point2);

    return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
}

// отрезок - сегмент, определяется двумя точками
/**
 * @param $point1
 * @param $point2
 * @return Closure
 */
function makeSegment($point1, $point2)
{

    return cons($point1, $point2);
}

/**
 * @param $segment
 * @return mixed
 */
function startSegment($segment)
{
    return car($segment);
}

/**
 * @param $segment
 * @return mixed
 */
function endSegment($segment)
{
    return cdr($segment);
}

/**
 * @param $segment
 * @return Closure
 */
function midpointSegment($segment)
{
    // x = (x1 + x2) / 2
    // y = (y1 + y2) / 2
    // определение каждой точки сегмента
    $x1 = getX(startSegment($segment));
    $x2 = getX(endSegment($segment));
    $y1 = getY(startSegment($segment));
    $y2 = getY(endSegment($segment));

    return makePoint(($x1 + $x2) / 2, ($y1 + $y2) / 2);

}

// Прямоугольник
/**
 * @param $point
 * @param $width
 * @param $height
 * @return Closure
 */
function makeRectangle($point, $width, $height)
{
    // низкий уровень
    return cons($point, cons($width, $height));
}

/**
 * @param callable $rectangle
 * @return mixed
 */
function square(callable $rectangle)
{
    // низкий уровень
    return car(cdr($rectangle)) * cdr(cdr($rectangle));
}

/**
 * @param callable $rectangle
 * @return int
 */
function perimetr(callable $rectangle)
{
    //(2 * (a + b)).
    return 2 * (car(cdr($rectangle)) + cdr(cdr($rectangle)));

}

/**
 * Точка по середине
 * @param callable $rectangle
 * @return bool
 */
function containsTheOrigin(callable $rectangle)
{
    $width = car(cdr($rectangle));
    $height = cdr(cdr($rectangle));

    $point1 = car($rectangle);
    $point2 = makePoint(getX($point1) + $width, getY($point1));
    $point3 = makePoint(getX($point1) + $width, getY($point1) - $height);
    $point4 = makePoint(getX($point1), getY($point1) - $height);

    return quadrant($point1) === 2 &&
    quadrant($point2) === 1 &&
    quadrant($point3) === 4 &&
    quadrant($point4) === 3;
}