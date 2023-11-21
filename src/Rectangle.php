<?php

namespace src;

class Rectangle implements CalculateAreaInterface
{
    protected $x;
    protected $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function CalculateArea(): float
    {
        return $this->x * $this->y;
    }
}