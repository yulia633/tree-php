<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function App\Node\makeNode;
use function App\Node\getNumber;
use function App\Node\getLeft;
use function App\Node\getRight;
use function App\Node\getCount;
use function App\Node\getSum;
use function App\Node\printTree;
use function App\Node\printNode;
use function App\Node\sringify;
use function App\Node\hasNumber;
use function App\Node\search;
use function App\Node\flatten;
use function App\Node\getNumbersTree;
use function App\Node\getNode;

class NodeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->tree = makeNode(
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
    }
    public function testMakeNode()
    {
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

        $this->assertEquals($expected, $this->tree);
    }

    public function testGetters()
    {
        $this->assertEquals(9, getNumber($this->tree));
        $this->assertEquals(4, getNumber(getLeft($this->tree)));
        $this->assertEquals(17, getNumber(getRight($this->tree)));
    }

    public function testMethods()
    {
        $this->assertEquals(9, getCount($this->tree));
        $this->assertEquals(96, getSum($this->tree));
        $this->assertEquals('(9, 4, 3, 6, 5, 7, 17, 22, 23)', printTree($this->tree));
        $this->assertEquals('3 4 5 6 7 9 17 22 23', printNode($this->tree));
        $this->assertEquals('[6]', sringify($this->tree, 6));
        $this->assertEquals('[17]', sringify($this->tree, 17));
        $this->assertEquals('Нет такого числа 168 в ноде', sringify($this->tree, 168));
        $this->assertEquals(7, search($this->tree, 7));
        $this->assertEquals(null, search($this->tree, 79));
        $this->assertEquals(['0' => 9, '1' => 4, '2' => 3, '3' => null, '4' => null, '5' => 6,
        '6' => 5, '7' => null, '8' => null, '9' => 7, '10' => null, '11' => null, '12' => 17,
        '13' => null, '14' => 22, '15' => null, '16' => 23, '17' => null, '18' => null], flatten($this->tree));
        $this->assertEquals(['0' => 9, '1' => 4, '2' => 3, '3' => 6, '4' => 5, '5' => 7, '6' => 17,
        '7' => 22, '8' => 23], getNumbersTree($this->tree));
        $this->assertEquals(true, hasNumber($this->tree, 7));
        $this->assertEquals(false, hasNumber($this->tree, 20));
        //getNode
    }
}
