<?php

use App\StringUtils;
use PHPUnit\Framework\TestCase;

class StringUtilsExploratoryTest extends TestCase
{
    public function testExampleCase()
    {
        $this->assertEquals(["x", "y", "z"], StringUtils::substringsBetween("axcaycazc", "a", "c"));
    }
    public function testSimpleCase()
    {
        $this->assertEquals(["bc"], StringUtils::substringsBetween("abcd", "a", "d"));
    }
    public function testManySubstrings()
    {
        $this->assertEquals(["bc", "bc"], StringUtils::substringsBetween("abcdabcdab", "a", "d"));
    }
    public function testOpenAndCloseTagsThatAreLongerThan1Char()
    {
        $this->assertEquals(["bc", "bf"], StringUtils::substringsBetween("aabcddaabfddaab", "aa", "dd"));
    }
}
