<?php

namespace App\Entity;

class Player
{
    private int $hp = 100;

    public function sting(int $damage): void
    {
        $this->hp -= $damage;
    }

    public function isAlive(): bool
    {
        return $this->hp > 0;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function setHp(int $int)
    {
        $this->hp = $int;
    }
}