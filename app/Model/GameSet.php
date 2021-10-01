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

        public function getScore(): Score
        {
            return $this->score;
        }

        public function isWinner(): bool
        {
            if(
                $this->getScore()->getPoints(0) < Game::MIN_POINTS_FOR_WINNING 
                && $this->getScore()->getPoints(1) < Game::MIN_POINTS_FOR_WINNING
            ){
                return false;
            }

            if(abs($this->getScore()->getPoints(0) - $this->getScore()->getPoints(1)) < Game::GAP_POINTS -1){
                return false;
            }
            
            return true;
        }
        
        public function getWinner(): ?Player
        {
            if ($this->isWinner()) {
                return $this->getScore()->getPoints(0) > $this->getScore()->getPoints(1) ? $this->players[0] : $this->players[1];
            }
            return null;
        }
    }