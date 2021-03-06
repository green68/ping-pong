<?php

namespace App\Model;

use Exception;

class Game
{
    const MIN_POINTS_FOR_WINNING = 11; //11
    const GAP_POINTS = 2; //2
    const MIN_SET_FOR_WIN = 3; //3

    private array $players = array();
    private array $gameSets = array();
    private bool $started = false;
    
    public function __construct(
        private int $numberOfPlayers = 2
    ) 
    {}
        
    public function start()
    {
        if(count($this->gameSets) !== 0){
            throw new Exception("Jeu déjà en cours");
        }
        if(!$this->isNumberOfPlayers()) {
            throw new Exception("démarrage impossible, nombre de joueurs incorrect");
        }
        $this->started = true;
    }

    public function addGameSet() : void
    {
        // todo : 
        // check if match start? (boolean value)
        if(!$this->started) {
            throw new Exception("Ajout de set impossible, Match non démarré");
        }
        if($this->getWinner()) {
            throw new Exception("Ajout set impossible, Match terminé!");
        };

        $this->gameSets[] = new GameSet($this->getPlayers());
    }

    public function addPlayer(Player $player) : void
    {
        if($this->isNumberOfPlayers()) {
            throw new Exception("Ajout d'un nouveau joueur impossible");
        }

        $this->players[] = $player;
    }

    public function isNumberOfPlayers(): bool 
    {
        return $this->numberOfPlayers === count($this->players);
    }


    public function getCurrentSet(): GameSet|false
    {
        return end($this->gameSets);
    }

    public function getSets(): array
    {
        return $this->gameSets;
    }

    public function getWinner(): ?Player
    {
        if(count($this->gameSets) < Game::MIN_SET_FOR_WIN) return null;
        
        $setsWin = array();
        foreach($this->gameSets as $set) {
            if($set->getWinner() !== null){
                $setsWin[] = $set->getWinner()->getName();
            } 
        }

        foreach($this->players as $player) {
            if(
                in_array($player->getName(), $setsWin) 
                && array_count_values($setsWin)[$player->getName()] === Game::MIN_SET_FOR_WIN
            ) {
                return $player;
            }

        }
        
        return null;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

}