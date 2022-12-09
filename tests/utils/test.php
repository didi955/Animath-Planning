<?php

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Nonstandard\Uuid;
require __DIR__ . '/../../src/Utils/Role.php';
require __DIR__ . '/../../src/User.php';
require __DIR__ . '/../../src/Utils/functions.php';

class testUtils extends TestCase
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

    /**
     * @test
     */
    public function testUserSerialization(){
        $user = new User();
        $user->setUUID("39378c18-01e0-410a-95c7-4c0822a6fd21");
        $user->setEmail("didi955@rushcubeland.fr");
        $user->setFirstName("Dylan");
        $user->setLastName("Lannuzel");
        $user->setRole(Role::SUPERVISOR);
        $serialized = serialize($user);
        $unserialized = unserialize($serialized);
        self::assertEquals($user, $unserialized);
        self::assertEquals($user->getUUID(), $unserialized->getUUID());
        self::assertEquals($user->getRole(), $unserialized->getRole());

    }




}
