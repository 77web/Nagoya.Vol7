<?php


namespace Nagoya\Vol7;


class OutputFormatterTest extends \PHPUnit_Framework_TestCase 
{
    public function test_format()
    {
        $routes = [
            [1, 'a', 4],
            [2, 'b', 5],
        ];
        $expect = '14,25';

        $formatter = new OutputFormatter();
        $this->assertEquals($expect, $formatter->format($routes));
    }
}
