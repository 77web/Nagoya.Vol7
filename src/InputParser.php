<?php


namespace Nagoya\Vol7;


class InputParser
{
    /**
     * @param array $input
     * @return array
     */
    public function parse($input)
    {
        return str_split($input);
    }
}
