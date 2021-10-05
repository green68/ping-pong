<?php

namespace App\Model;

class Player {

    private string $gameId = "";

    public function __construct(private string $name)
    {
        $this->id = uniqid("player-");
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function getGameId(): string 
    {
        return $this->gameId;
    }

}