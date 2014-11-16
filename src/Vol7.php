<?php

namespace Nagoya\Vol7;

class Vol7
{
    public function __construct($configPath)
    {
        $this->configPath = $configPath;
        $this->inputParser = new InputParser();
        $this->router = new Router();
        $this->outputFormatter = new OutputFormatter();
        $this->pointLoader = new PointLoader();
    }

    /**
     * @param string $input
     * @return string
     */
    public function run($input)
    {
        $disabledPoints = $this->inputParser->parse($input);

        $points = $this->loadPoints([4,5,6], $disabledPoints);
        $startPoints = [
            $points[1],
            $points[2],
            $points[3],
        ];

        $routes = $this->router->run($startPoints);

        return $this->outputFormatter->format($routes);
    }

    private function loadPoints(array $goalPointIds, array $disabledPointIds)
    {
        $points = $this->pointLoader->load($this->configPath);

        foreach ($disabledPointIds as $disabledPointId) {
            $points[$disabledPointId]->disable();
        }

        foreach ($goalPointIds as $goalId) {
            $points[$goalId]->setGoal(true);
        }

        return $points;
    }
}
