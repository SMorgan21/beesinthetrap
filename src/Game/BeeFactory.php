<?php

namespace App\Game;

use App\Entity\Bees\QueenBee;
use App\Entity\Bees\WorkerBee;
use App\Entity\Bees\DroneBee;
use App\Entity\Bees\Bee;

class BeeFactory
{
    public const NUM_WORKERS = 5;
    public const NUM_DRONES = 25;

    /**
     * @return Bee[]
     */
    public function createHive(): array
    {
        $hive = [new QueenBee()];

        for ($i = 0; $i < self::NUM_WORKERS; $i++) {
            $hive[] = new WorkerBee();
        }

        for ($i = 0; $i < self::NUM_DRONES; $i++) {
            $hive[] = new DroneBee();
        }

        return $hive;
    }
}