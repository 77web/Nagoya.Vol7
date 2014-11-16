<?php


namespace Nagoya\Vol7;


class InputParserTest extends \PHPUnit_Framework_TestCase 
{
    public function test_parseInput()
    {
        $input = 'abc';
        $expect = ['a', 'b', 'c'];

        $inputParser = new InputParser();
        $this->assertEquals($expect, $inputParser->parse($input));
    }
}
