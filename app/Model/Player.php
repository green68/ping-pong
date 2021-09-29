<?php

namespace App\Model;

class Player {

    private string $gameId = "";
    private bool $playing = false;

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

    public function isPlaying(): bool
    {
        return $this->getGameId() !== "" ;
    }

    public function setPlaying(string $gameId){
        $this->playing = true;
        $this->gameId = $gameId;
    }
    public function unsetPlaying(){
        $this->playing = false;
    }

}