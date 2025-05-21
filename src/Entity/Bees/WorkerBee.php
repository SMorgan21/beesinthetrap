<?php

namespace App\Entity\Bees;

class WorkerBee extends Bee
{
    protected string $type = 'Worker';

    public function __construct()
    {
        parent::__construct(75, 25, 5);
    }
}