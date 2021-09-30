<?php
namespace App\Model;

class Score {

    private array $points = array(0,0);

    public function __construct(private array $players){

    }

    public function addPointToPlayer(int $playerNumber) {
        if($this->isWinner()) return;
        $this->points[$playerNumber]++;
        echo "{$this->points[0]} - {$this->points[1]} / ";
    }

    public function isWinner(): bool
    {
        if($this->points[0] >= 11 || $this->points[1] >= 11){
            if(abs($this->points[0] - $this->points[1]) > 1){
                return true;
            }
        }

        return false;
    }
    
    public function getWinner(): ?Player
    {
        if ($this->isWinner()) {
            return $this->points[0] > $this->points[1] ? $this->players[0] : $this->players[1];
        }
        return null;
    }
}