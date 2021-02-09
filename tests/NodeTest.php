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
    }
}
