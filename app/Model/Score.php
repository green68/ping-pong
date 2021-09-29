<?php
namespace App\Model;

class Score {

    private array $points = array(0,0);

    public function __construct(
        // private int $points = 0
    ){}

    public function addPointToPlayer(int $playerNumber) {
        $this->points[$playerNumber]++;
        echo "{$this->points[0]} - {$this->points[1]} / ";
    }

    public function checkPoints(): bool
    {
        if($this->points[0] >= 11 || $this->points[1] >= 11){
            if(abs($this->points[0] - $this->points[1]) > 1){
                return true;
            }
        }

        return false;
    }
}