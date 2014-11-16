<?php


namespace Nagoya\Vol7;


class PointLoaderTest extends \PHPUnit_Framework_TestCase 
{
    public function test_load()
    {
        //$path = __DIR__.'/data/dummy.yml';
        $path = __DIR__.'/../src/Resources/config/points.yml';
        $loader = new PointLoader();
        $points = $loader->load($path);

        $this->assertEquals(2, count($points[1]->getNextPoints()));
    }
}
