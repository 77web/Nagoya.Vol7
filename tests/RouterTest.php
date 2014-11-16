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
        $point4->setGoal(true); // 4地点はゴール

        $startPoints = [$point1];

        $router = new Router();
        $routes = $router->run($startPoints);

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
        $point4->setGoal(true); // 4地点はゴール
        $point5->setGoal(true); // 5地点はゴール

        $startPoints = [$point1];

        $router = new Router();
        $routes = $router->run($startPoints);

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
        $point4->setGoal(true); // 4地点はゴール
        $point5->setGoal(true); // 5地点はゴール

        $startPoints = [$point1];

        $router = new Router();
        $routes = $router->run($startPoints);

        $this->assertEquals([
            [1, 'a', 4],
        ], $routes);
    }
}
