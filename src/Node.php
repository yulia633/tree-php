<?php

namespace App\Node;

//конструктор
function makeNode($number = null, $left = null, $right = null)
{
    return [
        'number' => $number,
        'left' => $left,
        'right' => $right
    ];
}

function getNumber($node)
{
    return $node['number'];
}

function getLeft($node)
{
    return $node['left'];
}

function getRight($node)
{
    return $node['right'];
}

//получить ноду
function getNode($node, $acc = [])
{
    if (getNumber($node) !== null) {
        $acc[] = getNumber($node);
    }

    $array = [$node];
    return array_reduce($array, function ($newAcc, $item) use ($acc) {
        if (getLeft($item) !== null) {
            $acc[] = getNode(getLeft($item), $newAcc);
        }
        if (getRight($item) !== null) {
              $acc[] = getNode(getRight($item), $newAcc);
        }
        return $acc;
    }, $acc);
}

//распечатать дерево
function printTree($node)
{
    $string = implode(", ", getNumbersTree($node));
        return "($string)";
}

//распечатать ноды по порядку
function printNode($node)
{
    if ($node === null) {
        return '';
    }

    return trim(printNode(getLeft($node)) . ' ' . getNumber($node) .
    ' ' . printNode(getRight($node)));
}

// написать функцию, которая которая печатает число из ноды В виде ["$number"]
function printNumberNode($node, $numberPrint)
{
    $numbersNode = getNumbersTree($node);

    $result = "";
    foreach ($numbersNode as $number) {
        if (!in_array($numberPrint, $numbersNode)) {
            return 'Нет такого числа в ноде'; //todo сделать Exception
        } elseif ($numberPrint === $number) {
            $result = "[$number]";
        }
    }
    return $result;
}

//функция, которая суммирует числа в дереве
function getSumNumbersTree($tree)
{
    $numbers = getNumbersTree($tree);
    return array_sum($numbers);
}

// функция, которая считает кол-во нод в дереве
function getCountNode($tree)
{
    $numbers = getNumbersTree($tree);
    return count($numbers);
}

// функция, которая проверяет есть ли число в дереве
function hasNumber($tree, $number)
{
    $result = search($tree, $number);
    return $result !== null;
}

//функция поиска  элемента в дереве
function search($tree, $number)
{
    if (empty($tree)) {
        return null;
    }
    if ($number === getNumber($tree)) {
        return getNumber($tree);
    } elseif ($number < getNumber($tree)) {
        return search(getLeft($tree), $number);
    } else {
        return search(getRight($tree), $number);
    }
}

//получить все числа в дереве
function getNumbersTree($tree)
{
    $nodes = getNode($tree, []);
    $flatten = flatten($nodes);
    $numbers = array_unique($flatten);
    return $numbers;
}

// сделать плоским массив
function flatten($items)
{
    if (!is_array($items)) {
        return [$items];
    }

    return array_reduce($items, function ($carry, $item) {
        return array_merge($carry, flatten($item));
    }, []);
}
