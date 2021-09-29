<?php

namespace App\Model;

class Players {

    private array $players = array();

    public function __construct(array $arrayNames)
    {
        foreach($arrayNames as $name) {
            $this->players[] = new Player($name);
        }
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getFreePlayer(): Player|null
    {
        foreach ($this->players as $player) {
            if(!$player->isPlaying()) return $player;
        }
        return null;
    }
}