<?php

namespace src;

class Square implements CalculateAreaInterface
{
    protected $x;

    public function __construct(float $x)
    {
        return $this->x * $this->x;
    }

    public function CalculateArea(): float
    {
         return $this->x * $this->x;
    }
}