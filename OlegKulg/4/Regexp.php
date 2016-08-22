<?php

class Regexp
{
    /**
     *
     * @param string $text
     * @return array
     */
    public function firstAndLastName($text)
    {
        preg_match('~([A-Z]{1}[a-z]* ){2}~g', $text, $result);

        return $result;
    }
}
