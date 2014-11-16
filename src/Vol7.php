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

        $points = $this->loadPoints($disabledPoints);

        $routes = $this->router->run($points, [1,2,3], [4,5,6]);

        return $this->outputFormatter->format($routes);
    }

    private function loadPoints(array $disabledPointIds)
    {
        $points = $this->pointLoader->load($this->configPath);

        foreach ($disabledPointIds as $disabledPointId) {
            $points[$disabledPointId]->disable();
        }

        return $points;
    }
}
