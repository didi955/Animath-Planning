<?php

namespace utils;

use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../src/Utils/functions.php';

class testRegex extends TestCase
{

    /**
     * @test Test if the mail regex is working
     */
    public function testEmail()
    {
        $mail = "monmail@gmail.com";
        self::assertTrue(is_valid_email($mail));

        $mail = "monmail@gmail";
        self::assertFalse(is_valid_email($mail));

        $mail = "CASSIOPEABESTCHAMP@LOL.COM";
        self::assertTrue(is_valid_email($mail));
    }

    /**
     * @test Test if the name regex is working
     */
    public function testName()
    {
        $name = "Dylan";
        self::assertTrue(is_valid_name($name));

        $name = "Samir";
        self::assertTrue(is_valid_name($name));

        $name = "didi955";
        self::assertFalse(is_valid_name($name));
    }

    /**
     * @test Test if the phone regex is working
     */
    public function testPhone()
    {
        $phone = "0648789145";
        self::assertTrue(is_valid_phone($phone));

        $phone = "+33648789145";
        self::assertTrue(is_valid_phone($phone));

        $phone = "0098745123";
        self::assertFalse(is_valid_phone($phone));
    }


}
