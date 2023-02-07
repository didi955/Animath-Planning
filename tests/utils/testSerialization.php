<?php

use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../src/Utils/Role.php';
require __DIR__ . '/../../src/User.php';
require __DIR__ . '/../../src/Utils/functions.php';

class testSerialization extends TestCase
{

    /**
     * @test Test if the user's serialization is working
     */
    public function testUserSerialization()
    {
        $user = new User();
        $user->setID(1);
        $user->setRole(Role::PROFESSOR);
        $user->setConnexionID("faofaa@gmail.com");
        $serialized = serialize($user);
        $unserialized = unserialize($serialized);
        self::assertEquals($user, $unserialized);
        self::assertEquals($user->getID(), $unserialized->getID());
        self::assertEquals($user->getRole(), $unserialized->getRole());
        self::assertEquals($user->getConnexionID(), $unserialized->getConnexionID());
    }

}
