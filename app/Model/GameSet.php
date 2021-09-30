<?php

    namespace App\Model;

    class GameSet
    {
        private Score $score;
        private string $id;

        public function __construct(private array $players)
        {

            $this->id = uniqid("set-");
            $this->score = new Score($this->players);    
        }
     
        public function getId(): string
        {
            return $this->id;
        }

        public function addPointToPlayerNum(int $playerNumber)
        {
            $this->score->addPointToPlayer($playerNumber);

        }

        public function getScore() {
            return $this->score;
        }
    }