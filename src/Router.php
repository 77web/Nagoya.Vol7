<?php


namespace Nagoya\Vol7;

use Nagoya\Vol7\Entity\Point;

class Router
{
    /**
     * @param Point[] $points
     * @param array $startIds
     * @param array $goalIds
     * @return array
     */
    public function run(array $points, array $startIds, array $goalIds)
    {
        foreach ($goalIds as $goalId) {
            $points[$goalId]->setGoal(true);
        }

        $routes = [];
        foreach ($startIds as $startId) {
            $cursor = $points[$startId];
            $routes = array_merge($routes, $this->generateRoute($cursor, []));
        }

        return $routes;
    }

    private function generateRoute(Point $current, array $route)
    {
        if ($current->isDisabled()) {
            throw new \RuntimeException;
        }

        $route[] = $current->getId();
        if ($current->isGoal()) {
            $routes[] = $route;

            return $routes;
        }

        $routes = [];
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
