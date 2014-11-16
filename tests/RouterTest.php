<?php


namespace Nagoya\Vol7;

use Nagoya\Vol7\Entity\Point;


class RouterTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function 分岐無し()
    {
        $point1 = new Point(1);
        $pointA = new Point('a');
        $point4 = new Point(4);
        $point1->setNextPoints([$pointA]);
        $pointA->setNextPoints([$point4]);

        $points = [1 => $point1, 'a' => $pointA, 4 => $point4];

        $router = new Router();
        $routes = $router->run($points, [1], [4]);

        $this->assertEquals([[1, 'a', 4]], $routes);
    }

    /**
     * @test
     */
    public function 分岐あり()
    {
        $point1 = new Point(1);
        $pointA = new Point('a');
        $pointB = new Point('b');
        $point4 = new Point(4);
        $point5 = new Point(5);
        $point1->setNextPoints([$pointA, $pointB]);
        $pointA->setNextPoints([$point4]);
        $pointB->setNextPoints([$point5]);

        $points = [
            1 => $point1,
            'a' => $pointA,
            'b' => $pointB,
            4 => $point4,
            5 => $point5,
        ];

        $router = new Router();
        $routes = $router->run($points, [1], [4, 5]);

        $this->assertEquals([
            [1, 'a', 4],
            [1, 'b', 5],
        ], $routes);
    }

    /**
     * @test
     */
    public function 分岐あり_通行止めあり()
    {
        $point1 = new Point(1);
        $pointA = new Point('a');
        $pointB = new Point('b');
        $point4 = new Point(4);
        $point5 = new Point(5);
        $point1->setNextPoints([$pointA, $pointB]);
        $pointA->setNextPoints([$point4]);
        $pointB->setNextPoints([$point5]);
        $pointB->disable(); // B地点を通行止め

        $points = [
            1 => $point1,
            'a' => $pointA,
            'b' => $pointB,
            4 => $point4,
            5 => $point5,
        ];

        $router = new Router();
        $routes = $router->run($points, [1], [4, 5]);

        $this->assertEquals([
            [1, 'a', 4],
        ], $routes);
    }
}
