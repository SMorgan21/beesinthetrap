<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Bees\QueenBee;

class QueenBeeTest extends TestCase
{
    public function testInitialHealth(): void
    {
        $queen = new QueenBee();
        $this->assertEquals(100, $queen->getHp());
    }

    public function testHitReducesBy10(): void
    {
        $queen = new QueenBee();
        $queen->hit();
        $this->assertEquals(90, $queen->getHp());
    }

    public function testStingDoes10Damage(): void
    {
        $queen = new QueenBee();
        $this->assertEquals(10, $queen->sting());
    }
}