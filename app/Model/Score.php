<?php

namespace App\Model;

class Score
{

    private array $points = array(0, 0);

    public function __construct(private array $players)
    {
    }

    public function addPoint(int $playerNumber)
    {
        $this->points[$playerNumber]++;
    }

    public function getPoints(int $playerNumber): int
    {
        return $this->points[$playerNumber];
    }

}
