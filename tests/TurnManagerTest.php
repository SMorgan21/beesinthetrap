<?php

use App\Entity\Bees\DroneBee;
use PHPUnit\Framework\TestCase;
use App\Game\TurnManager;
use App\Entity\Player;
use App\Entity\Bees\QueenBee;
use App\Service\Randomizer;

class TurnManagerTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testQueenDeathTriggersHiveCollapse(): void
    {
        $queen = new QueenBee();
        $drone = new DroneBee();
        $bees = [$queen, $drone];
        $player = new Player();

        $mockRandomizer = $this->createMock(Randomizer::class);
        $mockRandomizer->method('chanceToMiss')->willReturn(false);
        $mockRandomizer->method('pickRandom')->willReturn($queen);

        $manager = new TurnManager($player, $bees, $mockRandomizer);
        for ($i = 0; $i < 10; $i++) {
            $manager->executeTurn();
        }

        $this->assertFalse($queen->isAlive(), 'Queen should be dead.');
        $this->assertFalse($drone->isAlive(), 'Drone should die when Queen dies.');
        $this->assertTrue($manager->hiveIsDead(), 'All bees should be dead after Queen dies.');
    }
}