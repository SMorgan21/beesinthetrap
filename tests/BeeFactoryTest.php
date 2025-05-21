<?php

use PHPUnit\Framework\TestCase;
use App\Game\BeeFactory;
use App\Entity\Bees\QueenBee;
use App\Entity\Bees\WorkerBee;
use App\Entity\Bees\DroneBee;

class BeeFactoryTest extends TestCase
{
    public function testCreatesCorrectBeeCounts(): void
    {
        $factory = new BeeFactory();
        $bees = $factory->createHive();

        $queenCount = 0;
        $workerCount = 0;
        $droneCount = 0;

        foreach ($bees as $bee) {
            match ($bee->getType()) {
                'Queen'  => $queenCount++,
                'Worker' => $workerCount++,
                'Drone'  => $droneCount++,
            };
        }

        $this->assertEquals(1, $queenCount);
        $this->assertEquals(BeeFactory::NUM_WORKERS, $workerCount);
        $this->assertEquals(BeeFactory::NUM_DRONES, $droneCount);
        $this->assertCount(1 + BeeFactory::NUM_WORKERS + BeeFactory::NUM_DRONES, $bees);
    }
}