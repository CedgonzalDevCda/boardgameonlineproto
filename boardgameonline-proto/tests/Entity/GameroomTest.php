<?php

namespace App\Tests\Entity;

use App\Entity\Gameroom;
use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Kernel;

class GameroomTest extends KernelTestCase{
    public function testValidEntity(){
        $gameroom = (new Gameroom())
            ->setHashInvit('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
            ->setLeader('unitaryTest')
            ->setNbPlayer(2);
        self::bootKernel();
        $container = static::getContainer();
        $error = $container->get('validator')->validate($gameroom);
        $this->assertCount(0, $error);

    }
    public function testInvalidEntity(){
        $gameroom = (new Gameroom())
            ->setHashInvit('$^¨//!§%')
            ->setLeader('unitaryTest');
        self::bootKernel();
        $container = static::getContainer();
        $error = $container->get('validator')->validate($gameroom);
        $this->assertCount(1, $error);

    }
}