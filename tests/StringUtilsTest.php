<?php

use App\StringUtils;
use PHPUnit\Framework\TestCase;

/**
 * (open length = 1, close length = 1)
 * (open length > 1, close length > 1)
 *
 * "In the following list, I've marked with an [x] particions we will not test multiple times:
 * - str: Null string [x], empty string [x], length = 1 [x], length > 1
 * - open: Null string [x], empty string [x], length = 1, length > 1
 * - close: Null string [x], empty string [x], length = 1, length > 1
 * - close: Null string [x], empty string [x], length = 1, length > 1
 * - (str, open, clse):
 * String does not contain either the open or the clse tag,
 * string contains the open tag but does not contain the close tag,
 * string contains both the open and close tags,
 * string contains both the open and close tags multiple times
 *
 * First, the exceptional cases:
 * - T1: str is null.
 * - T2: str is empty.
 * - T3: open is null.
 * - T4: open is empty.
 * - T5: close is null.
 * - T6: close is empty.
 *
 * Then, str length = 1:
 * - T7: The single character in str matches the open tag.
 * - T8: The single character in str matches the close tag.
 * - T9: The single character in str does not match either the open or the close tag.
 * - T10: The single character in str matches both the open and close tags.
 *
 * Now, str length > 1, open length = 1, close = 1:
 * - T11: str does not contain either the open or the close tag.
 * - T12: str contains the open tag but does not contain the close tag.
 * - T13: str contains the close tag but does not contain the open tag.
 * - T14: str contains both the open and close tags.
 * - T15: str contains both the open and close tags multiple times.
 *
 * Now, str length > 1, open length > 1, close > 1:
 * - T16: str does not contain either the open or the close tag.
 * - T17: str contains the open tag but does not contain the close tag.
 * - T18: str contains the close tag but does not contain the open tag.
 * - T19: str contains both the open and close tags.
 * - T20: str contains both the open and close tags multiple times.
 *
 * Finally, here is the test for the boundary:
 * - T21: str contains both the open and close tags with no characters between them.
 */
class StringUtilsTest extends TestCase
{
    public function testStrIsNullOrEmpty(): void
    {
        $this->assertNull(StringUtils::substringsBetween(null, "a", "b")); // T1
        $this->assertEmpty(StringUtils::substringsBetween("", "a", "b")); // T2
    }

    public function testOpenIsNullOrEmpty(): void
    {
        $this->assertNull(StringUtils::substringsBetween("abc", null, "b")); // T3
        $this->assertEmpty(StringUtils::substringsBetween("abc", "", "b")); // T4
    }

    public function testCloseIsNullOrEmpty(): void
    {
        $this->assertNull(StringUtils::substringsBetween("abc", "a", null)); // T5
        $this->assertEmpty(StringUtils::substringsBetween("abc", "a", "")); // T6
    }

    public function testStrOfLength1(): void
    {
        $this->assertNull(StringUtils::substringsBetween("a", "a", "b")); // T7
        $this->assertNull(StringUtils::substringsBetween("a", "b", "a")); // T8
        $this->assertNull(StringUtils::substringsBetween("a", "b", "b")); // T9
        $this->assertNull(StringUtils::substringsBetween("a", "a", "a")); // T10
    }

    public function testOpenAndCloseOfLength1(): void
    {
        $this->assertNull(StringUtils::substringsBetween("abc", "x", "y")); // T11
        $this->assertNull(StringUtils::substringsBetween("abc", "a", "y")); // T12
        $this->assertNull(StringUtils::substringsBetween("abc", "x", "c")); // T13
        $this->assertEquals(["b"], StringUtils::substringsBetween("abc", "a", "c")); // T14
        $this->assertEquals(["b", "b"], StringUtils::substringsBetween("abcabc", "a", "c")); // T15
    }

    public function testOpenAndCloseTagsOfDifferentSizes(): void
    {
        $this->assertNull(StringUtils::substringsBetween("aabcc", "xx", "yy")); // T16
        $this->assertNull(StringUtils::substringsBetween("aabcc", "aa", "yy")); // T17
        $this->assertNull(StringUtils::substringsBetween("aabcc", "xx", "cc")); // T18
        $this->assertEquals(["bb"], StringUtils::substringsBetween("aabbcc", "aa", "cc")); // T19
        $this->assertEquals(["bb", "ee"], StringUtils::substringsBetween("aabbccaaeecc", "aa", "cc")); // T20
    }

    public function testNoSubstringBetweenOpenAndCloseTags(): void
    {
        $this->assertEquals([""], StringUtils::substringsBetween("aabb", "aa", "bb")); // T21
    }
}
