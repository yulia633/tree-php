<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Node;

use function App\Node\makeNode;
use function App\Node\getNumber;
use function App\Node\getLeft;
use function App\Node\getRight;
use function App\Node\getCountNode;
use function App\Node\getSumNumbersTree;
use function App\Node\printTree;
use function App\Node\printNode;
use function App\Node\printNumberNode;
use function App\Node\hasNumber;
use function App\Node\search;
use function App\Node\flatten;
use function App\Node\getNumbersTree;
use function App\Node\getNode;

class NodeTest extends TestCase
{
    public function testMakeNode()
    {
        $tree = makeNode(
            9,
            makeNode(
                4,
                makeNode(3),
                makeNode(
                    6,
                    makeNode(5),
                    makeNode(7)
                )
            ),
            makeNode(
                17,
                null,
                makeNode(
                    22,
                    null,
                    makeNode(23)
                )
            )
        );
        $expected = [
            'number' => 9,
            'left' => [
                    'number' => 4,
                    'left' => [
                        'number' => 3,
                        'left' => null,
                        'right' => null,
                    ],
                    'right' => [
                        'number' => 6,
                            'left' => [
                                'number' => 5,
                                'left' => null,
                                'right' => null,
                            ],
                            'right' => [
                                'number' => 7,
                                'left' => null,
                                'right' => null,
                            ],
                        ],
                    ],
                'right' => [
                    'number' => 17,
                        'left' => null,
                        'right' => [
                            'number' => 22,
                                'left' => null,
                                'right' => [
                                    'number' => 23,
                                    'left' => null,
                                    'right' => null,
                                ],
                            ],
                        ],
        ];

        $this->assertEquals($expected, $tree);
    }

    public function testGetters()
    {
        $tree = makeNode(
            9,
            makeNode(
                4,
                makeNode(3),
                makeNode(
                    6,
                    makeNode(5),
                    makeNode(7)
                )
            ),
            makeNode(
                17,
                null,
                makeNode(
                    22,
                    null,
                    makeNode(23)
                )
            )
        );
        $this->assertEquals(9, getNumber($tree));
        $this->assertEquals(4, getNumber(getLeft($tree)));
        $this->assertEquals(17, getNumber(getRight($tree)));
    }

    public function testMethods()
    {
        $tree = $tree = makeNode(
            9,
            makeNode(
                4,
                makeNode(3),
                makeNode(
                    6,
                    makeNode(5),
                    makeNode(7)
                )
            ),
            makeNode(
                17,
                null,
                makeNode(
                    22,
                    null,
                    makeNode(23)
                )
            )
        );
        $this->assertEquals(9, getCountNode($tree));
        $this->assertEquals(96, getSumNumbersTree($tree));
        $this->assertEquals('(9, 4, 3, 6, 5, 7, 17, 22, 23)', printTree($tree));
        $this->assertEquals('3 4 5 6 7 9 17 22 23', printNode($tree));
        $this->assertEquals('[6]', printNumberNode($tree, 6));
        $this->assertEquals('[17]', printNumberNode($tree, 17));
        $this->assertEquals('Нет такого числа 168 в ноде', printNumberNode($tree, 168));
        $this->assertEquals(7, search($tree, 7));
        $this->assertEquals(null, search($tree, 79));
        $this->assertEquals(['0' => 9, '1' => 4, '2' => 3, '3' => null, '4' => null, '5' => 6,
        '6' => 5, '7' => null, '8' => null, '9' => 7, '10' => null, '11' => null, '12' => 17,
        '13' => null, '14' => 22, '15' => null, '16' => 23, '17' => null, '18' => null], flatten($tree));
        $this->assertEquals(['0' => 9, '1' => 4, '2' => 3, '3' => 6, '4' => 5, '5' => 7, '6' => 17,
        '7' => 22, '8' => 23], getNumbersTree($tree));
        $this->assertEquals(true, hasNumber($tree, 7));
        $this->assertEquals(false, hasNumber($tree, 20));
        //getNode
    }
}
