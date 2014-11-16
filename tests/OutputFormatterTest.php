<?php


namespace Nagoya\Vol7;


class OutputFormatterTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @param array $routes
     * @param string $expect
     * @dataProvider provideData
     */
    public function test_format($routes, $expect)
    {
        $formatter = new OutputFormatter();
        $this->assertEquals($expect, $formatter->format($routes));
    }

    public function provideData()
    {
        $routes = [
            [2, 'b', 5],
            [1, 'a', 4],
        ];

        return [
            [$routes, '14,25'],
            [[], '-'],
        ];
    }
}
