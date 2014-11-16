<?php


namespace Nagoya\Vol7;

use Nagoya\Vol7\Entity\Point;
use Symfony\Component\Yaml\Yaml;

class PointLoader
{
    /**
     * @param string $yamlPath
     * @return Entity\Point[]
     */
    public function load($yamlPath)
    {
        $config = Yaml::parse(file_get_contents($yamlPath));

        /** @var Point[] $points */
        $points = [];
        foreach ($config as $id => $pointConfig) {
            $points[$id] = new Point($id);
        }

        foreach ($config as $id => $pointConfig) {
            if (isset($pointConfig['next'])) {
                $nextPoints = [];
                foreach ($pointConfig['next'] as $nextId) {
                    $nextPoints[] = $points[$nextId];
                }
                $points[$id]->setNextPoints($nextPoints);
            }
        }

        return $points;
    }
}
