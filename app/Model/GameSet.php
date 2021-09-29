<?php

    namespace App\Model;

    class GameSet
    {
        private array $scores = array();
        private string $id;

        public function __construct(private string $GameId)
        {
            $this->id = uniqid("set-");    
        }
     
        public function getId(): string
        {
            return $this->id;
        }

        public function addPoint(){

        }
    }