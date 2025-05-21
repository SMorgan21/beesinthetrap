<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Bees\DroneBee;

class DroneBeeTest extends TestCase
{
    public function testInitialHp(): void
    {
        $bee = new DroneBee();
        $this->assertEquals(60, $bee->getHp());
    }

    public function testHitReducesHpBy30(): void
    {
        $bee = new DroneBee();
        $bee->hit(); // should reduce by 30
        $this->assertEquals(30, $bee->getHp());
    }

    public function testDiesAfterTwoHits(): void
    {
        $bee = new DroneBee();
        $bee->hit();
        $bee->hit();
        $this->assertFalse($bee->isAlive());
        $this->assertEquals(0, $bee->getHp());
    }

    public function testStingReturns1(): void
    {
        $bee = new DroneBee();
        $this->assertEquals(1, $bee->sting());
    }

    public function testTypeIsDrone(): void
    {
        $bee = new DroneBee();
        $this->assertEquals('Drone', $bee->getType());
    }
}