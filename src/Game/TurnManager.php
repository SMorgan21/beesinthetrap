<?php

namespace App\Game;

use App\Entity\Player;
use App\Entity\Bees\Bee;
use App\Entity\Bees\QueenBee;
use App\Service\Randomizer;

class TurnManager
{
    private int $turnCount = 0;
    private string $lastReport = '';

    public function __construct(
        private Player $player,
        private array $bees,
        private Randomizer $randomizer
    ) {}

    public function executeTurn(): void
    {
        $this->turnCount++;
        $report = "-- Turn {$this->turnCount} --\n";

        $report .= $this->playerTurn();
        if ($this->hiveIsDead()) {
            $this->lastReport = $report;
            return;
        }

        $report .= $this->beeTurn();
        $report .= "Player HP: {$this->player->getHp()}\n";

        $this->lastReport = $report;
    }

    private function playerTurn(): string
    {
        $aliveBees = array_filter($this->bees, fn($b) => $b->isAlive());
        if (empty($aliveBees)) return "No bees left to hit.\n";

        $target = $this->randomizer->pickRandom($aliveBees);

        if ($this->randomizer->chanceToMiss()) {
            return "Miss! You missed the hive.\n";
        }

        $damage = $target->hit();
        $line = "Direct Hit! You took {$damage} HP from a {$target->getType()} Bee.\n";

        if (!$target->isAlive() && $target instanceof QueenBee) {
            foreach ($this->bees as $bee) {
                if ($bee->isAlive()) {
                    $bee->hit(999); // ensure all die
                }
            }
            $line .= "The Queen is dead! All bees fall from the sky.\n";
        }

        return $line;
    }

    private function beeTurn(): string
    {
        $aliveBees = array_filter($this->bees, fn($b) => $b->isAlive());
        if (empty($aliveBees)) return "No bees left to sting you.\n";

        $attacker = $this->randomizer->pickRandom($aliveBees);

        if ($this->randomizer->chanceToMiss()) {
            return "Buzz! The {$attacker->getType()} Bee just missed you.\n";
        }

        $damage = $attacker->sting();
        $this->player->sting($damage);

        return "Sting! The {$attacker->getType()} Bee hit you for {$damage} HP.\n";
    }

    public function hiveIsDead(): bool
    {
        return count(array_filter($this->bees, fn($b) => $b->isAlive())) === 0;
    }

    public function getLastTurnReport(): string
    {
        return $this->lastReport;
    }

    public function getGameSummary(): string
    {
        if (!$this->player->isAlive()) {
            return "You were stung to death after {$this->turnCount} turns.\n";
        }

        return "You destroyed the hive in {$this->turnCount} turns!\n";
    }
}