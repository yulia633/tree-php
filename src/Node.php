<?php

namespace App\Node;

/**
 * Make node
 * @param  int $number
 * @param  int $left
 * @param  int $right
 * @return array
 */
function makeNode($number = null, $left = null, $right = null)
{
    return [
        'number' => $number,
        'left' => $left,
        'right' => $right
    ];
}

/**
 * Return number
 * @param array $node
 * @return  int
 * @example
 * getNumber(makeNode(9, makeNode(1, null, null), makeNode(6, null, null))); // 9
 * getNumber(tree); // 9
 */
function getNumber($node)
{
    return $node['number'];
}

/**
 * Return left part
 * @param array $node
 * @return  int|array
 * @example
 * getLeft(makeNode(1, 2, 3)); // 2
 * getLeft(makeNode(9, makeNode(1, null, null), makeNode(6, null, null)));
 * // [["number"]=> 1, ["left"] => NULL, ["right"] => NULL]
 */
function getLeft($node)
{
    return $node['left'];
}

/**
 * Return right part
 * @param array $node
 * @return  int|array
 * @example
 * getRight(makeNode(1, 2, 3)); // 3
 * getRight(makeNode(9, makeNode(1, null, null), makeNode(6, null, null)));
 * // [["number"]=> 6, ["left"] => NULL, ["right"] => NULL]
 */
function getRight($node)
{
    return $node['right'];
}

/**
 * Getter node
 * @param  array $node
 * @param  array $acc
 * @return array
 */
function getNode($node, $acc = [])
{
    $array = [$node];
    return array_reduce($array, function ($newAcc, $item) use ($acc) {
        if (getNumber($item) !== null) {
            $acc[] = getNumber($item);
        }
        if (getLeft($item) !== null) {
            $acc[] = getNode(getLeft($item), $newAcc);
        }
        if (getRight($item) !== null) {
            $acc[] = getNode(getRight($item), $newAcc);
        }
        return $acc;
    }, $acc);
}

/**
 * Print the tree
 * @param  array $node
 * @return string
 */
function printTree($node)
{
    $string = implode(", ", getNumbersTree($node));
        return "($string)";
}

/**
 * Print the node number in order
 * @param  array $node
 * @return string
 */
function printNode($node)
{
    if ($node === null) {
        return '';
    }

    return trim(printNode(getLeft($node)) . ' ' . getNumber($node) .
    ' ' . printNode(getRight($node)));
}

/**
 * Print number ["$number"] from node
 * @param  array $node
 * @param  int $numberPrint
 * @return string
 */
function sringify($node, $number)
{
    $numbersNode = getNumbersTree($node);

    $result = "";
    foreach ($numbersNode as $num) {
        if (!in_array($number, $numbersNode)) {
            return "Нет такого числа {$number} в ноде";
        } elseif ($number === $num) {
            $result = "[$num]";
        }
    }
    return $result;
}

/**
 * Sum numbers in the tree
 * @param  array $tree
 * @return int
 */
function getSum($tree)
{
    $numbers = getNumbersTree($tree);
    return array_sum($numbers);
}

/**
 * Count numbers of node in the tree
 * @param  array $tree
 * @return int
 */
function getCount($tree)
{
    $numbers = getNumbersTree($tree);
    return count($numbers);
}

/**
 * Check number in the tree
 * @param  array $tree
 * @param  int $number
 * @return boolean
 */
function hasNumber($tree, $number)
{
    $result = search($tree, $number);
    return $result !== null;
}

/**
 * Search number in the tree
 * @param  array $tree
 * @param  int $number
 * @return int|null
 */
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

/**
 * Get all numbers in the tree
 * @param  array $tree
 * @return array
 */
function getNumbersTree($tree)
{
    $nodes = getNode($tree, []);
    $flatten = flatten($nodes);
    $numbers = array_unique($flatten);
    return $numbers;
}

/**
 * Recursively flatten array
 * @param array $tree
 * @return array
 * @example
 * flatten([1]); // [1];
 * flatten([1, 2, [3, 4]]); // [1, 2, 3, 4];
 */
function flatten($tree)
{
    if (!is_array($tree)) {
        return [$tree];
    }

    return array_reduce($tree, function ($acc, $item) {
        return array_merge($acc, flatten($item));
    }, []);
}

/**
 * Method that checks the tree for balance.
 * @param array $tree
 * @return boolean
 * @example
 * isBalanced([1, [2, [3]]); // true
 * isBalanced([1, [2, [3, [1, 4, [6]]]]); // false
 */
function isBalanced($tree)
{
    $leftNodeCount = getLeft($tree) ? getCount(getLeft($tree)) : 0;
    $rightNodeCount = getRight($tree) ? getCount(getRight($tree)) : 0;
    $leftIsBalanced = getLeft($tree) ? isBalanced(getLeft($tree)) : true;
    $rightIsBalanced = getRight($tree) ? isBalanced(getRight($tree)) : true;
    return abs($leftNodeCount - $rightNodeCount) <= 2 && $rightIsBalanced && $leftIsBalanced;
}
