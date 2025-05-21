<?php

use App\Entity\Bees\DroneBee;
use PHPUnit\Framework\TestCase;
use App\Game\Game;
use App\Game\BeeFactory;
use App\Game\TurnManager;
use App\Entity\Player;
use App\Entity\Bees\QueenBee;
use App\Service\Randomizer;

class GameIntegrationTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testHiveCanBeDestroyed(): void
    {
        $player = new Player();
        $queen = new QueenBee();
        $bees = [$queen];

        $mockRandomizer = $this->createMock(Randomizer::class);
        $mockRandomizer->method('chanceToMiss')->willReturn(false);
        $mockRandomizer->method('pickRandom')->willReturn($queen);

        $turnManager = new TurnManager($player, $bees, $mockRandomizer);

        while (!$turnManager->hiveIsDead() && $player->isAlive()) {
            $turnManager->executeTurn();
        }

        $this->assertTrue($turnManager->hiveIsDead(), "Hive should be dead.");
        $this->assertTrue($player->isAlive(), "Player should survive if never hit.");
        $this->assertStringContainsString(
            'destroyed the hive',
            $turnManager->getGameSummary()
        );
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testPlayerCanBeKilled(): void
    {
        $player = new Player();
        $attacker = new DroneBee();
        $bees = [$attacker];

        $mockRandomizer = $this->createMock(Randomizer::class);


        $mockRandomizer->method('chanceToMiss')->willReturnOnConsecutiveCalls(
            true,
            false,
            true,
            false,
            true,
            false
        );

        $mockRandomizer->method('pickRandom')->willReturn($attacker);

        $manager = new TurnManager($player, $bees, $mockRandomizer);

        $ref = new \ReflectionProperty(Player::class, 'hp');
        $ref->setAccessible(true);
        $ref->setValue($player, 2);

        for ($i = 0; $i < 3; $i++) {
            $manager->executeTurn();
            if (!$player->isAlive()) {
                break;
            }
        }

        $this->assertFalse($player->isAlive(), 'Player should be dead.');
        $this->assertStringContainsString('stung to death', $manager->getGameSummary());
    }
}