<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Bees\WorkerBee;

class WorkerBeeTest extends TestCase
{
    public function testInitialHp(): void
    {
        $bee = new WorkerBee();
        $this->assertEquals(75, $bee->getHp());
    }

    public function testHitReducesHpBy25(): void
    {
        $bee = new WorkerBee();
        $bee->hit();
        $this->assertEquals(50, $bee->getHp());
    }

    public function testDiesAfterThreeHits(): void
    {
        $bee = new WorkerBee();
        $bee->hit();
        $bee->hit();
        $bee->hit();
        $this->assertFalse($bee->isAlive());
        $this->assertEquals(0, $bee->getHp());
    }

    public function testStingReturns5(): void
    {
        $bee = new WorkerBee();
        $this->assertEquals(5, $bee->sting());
    }

    public function testTypeIsWorker(): void
    {
        $bee = new WorkerBee();
        $this->assertEquals('Worker', $bee->getType());
    }
}