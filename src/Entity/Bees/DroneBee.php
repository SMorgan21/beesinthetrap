<?php

namespace App\Entity\Bees;

class DroneBee extends Bee
{
    protected string $type = 'Drone';

    public function __construct()
    {
        parent::__construct(60, 30, 1);
    }
}