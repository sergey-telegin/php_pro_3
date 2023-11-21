<?php

namespace src;

class Cub extends Square
{
    public function __construct(float $x)
    {
        parent::__construct($x);
    }

    public function CalculateVolume(): float
    {
        return $this->x * $this->x * $this->x;
    }
}