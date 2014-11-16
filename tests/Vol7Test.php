<?php

namespace Nagoya\Vol7;

class Vol7Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Vol7
     */
    protected $skeleton;

    protected function setUp()
    {
        $this->skeleton = new Vol7;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\Nagoya\Vol7\Vol7', $actual);
    }

    /**
     * @expectedException \Nagoya\Vol7\Exception\LogicException
     */
    public function testException()
    {
        throw new Exception\LogicException;
    }
}
