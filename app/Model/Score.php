<?php
namespace App\Model;

class Score {

    public function __construct(
        private int $points = 0
    ){}

    public function addPoint() {
        $this->points++;
    }

}