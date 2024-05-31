<?php

use App\SubstringsBetweenExample;
use PHPUnit\Framework\TestCase;

class SubstringsBetweenExampleTest extends TestCase
{
    public function testSimpleCase()
    {
        $this->assertEquals(["bc"], SubstringsBetweenExample::substringsBetween("abcd", "a", "d"));
    }
    public function testManySubstrings()
    {
        $this->assertEquals(["bc", "bc"], SubstringsBetweenExample::substringsBetween("abcdabcdab", "a", "d"));
    }
    public function testOpenAndCloseTagsThatAreLongerThan1Char()
    {
        $this->assertEquals(["bc", "bf"], SubstringsBetweenExample::substringsBetween("aabcddaabfddaab", "aa", "dd"));
    }
}
