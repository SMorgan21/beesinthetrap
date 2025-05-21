<?php

namespace App\Entity\Bees;

abstract class Bee
{
    protected int $hp;
    protected string $type;
    protected int $hitDamage;
    protected int $stingDamage;

    public function __construct(int $maxHp, int $hitDamage, int $stingDamage)
    {
        $this->hp = $maxHp;
        $this->hitDamage = $hitDamage;
        $this->stingDamage = $stingDamage;
    }

    public function hit(int $override = 0): int
    {
        $damage = $override ?: $this->hitDamage;
        $this->hp = max(0, $this->hp - $damage);
        return $damage;
    }

    public function sting(): int
    {
        return $this->stingDamage;
    }

    public function isAlive(): bool
    {
        return $this->hp > 0;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getType(): string
    {
        return $this->type;
    }
}