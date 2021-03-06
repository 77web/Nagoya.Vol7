<?php


namespace Nagoya\Vol7;


class OutputFormatter
{
    public function format($routes)
    {
        // TODO refactor
        $startAndGoal = [];
        foreach ($routes as $route) {
            $startAndGoal[] = reset($route).end($route);
        }

        sort($startAndGoal);
        $startAndGoal = array_unique($startAndGoal);

        return count($startAndGoal) > 0 ? implode(',', $startAndGoal) : '-';
    }
}
