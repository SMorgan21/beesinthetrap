<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Player;

class PlayerTest extends TestCase
{
    public function testInitialHealth(): void
    {
        $player = new Player();
        $this->assertEquals(100, $player->getHp());
    }

    public function testHealthReducesOnSting(): void
    {
        $player = new Player();
        $player->sting(10);
        $this->assertEquals(90, $player->getHp());
    }

    public function testDiesWhenHealthZero(): void
    {
        $player = new Player();
        $player->sting(100);
        $this->assertFalse($player->isAlive());
    }
}