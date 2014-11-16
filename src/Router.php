<?php


namespace Nagoya\Vol7;

use Nagoya\Vol7\Entity\Point;

class Router
{
    /**
     * @param Point[] $startPoints
     * @return array
     */
    public function run(array $startPoints)
    {
        $routes = [];
        foreach ($startPoints as $start) {
            $routes = array_merge($routes, $this->generateRoute($start, []));
        }

        return $routes;
    }

    /**
     * @param Point $current 現在地
     * @param array $route 現在地まで通って来た地点IDが入っている配列
     * @return array
     */
    private function generateRoute(Point $current, array $route)
    {
        if ($current->isDisabled()) {
            throw new \RuntimeException;
        }

        $routes = [];

        $route[] = $current->getId();
        if ($current->isGoal()) {
            $routes[] = $route;

            return $routes;
        }

        foreach ($current->getNextPoints() as $next) {
            if ($next->isDisabled()) {
                continue;
            }

            try {
                $routes = array_merge($routes, $this->generateRoute($next, $route));
            } catch (\RuntimeException $e) {
                continue;
            }
        }

        return $routes;
    }
}
