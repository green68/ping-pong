<?php

    namespace App\Model;

    class GameSet
    {
        private Score $score;
        private string $id;

        public function __construct(private string $GameId)
        {

            $this->id = uniqid("set-");
            $this->score = new Score();    
        }
     
        public function getId(): string
        {
            return $this->id;
        }

        public function addPointToPlayerNum(int $playerNumber)
        {
            $this->score->addPointToPlayer($playerNumber);

        }

    }