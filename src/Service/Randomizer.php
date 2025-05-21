<?php

namespace App\Service;

class Randomizer
{
    public const MISS_CHANCE_PERCENT = 20;

    public function chanceToMiss(): bool
    {
        return rand(1, 100) <= self::MISS_CHANCE_PERCENT;
    }

    public function pickRandom(array $items): mixed
    {
        return $items[array_rand($items)];
    }
}