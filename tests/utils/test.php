<?php

namespace utils;

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../src/Utils/functions.php';

class test extends TestCase
{

    /**
     * @test
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


}
