<?php

namespace App\Entity\Bees;

class QueenBee extends Bee
{
    protected string $type = 'Queen';

    public function __construct()
    {
        parent::__construct(100, 10, 10);
    }
}