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
    
    public function __construct(
        private int $numberOfGameSets, 
        private int $numberOfPlayers
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
        $this->addGameSet();
    }

    public function addGameSet() {
        if($this->isGameWin()) {
            throw new Exception("Ajout set impossible, Match terminé!");
        };

        $this->gameSets[] = new GameSet($this->getPlayers());
    }

    public function addPlayer($player) {
        if(count($this->players) == $this->numberOfPlayers) {
            throw new Exception("Ajout d'un nouveau joueur impossible");
        }

        $this->players[] = $player;
    }

    public function isNumberOfPlayers(): bool 
    {
        return $this->numberOfPlayers === count($this->players);
    }


    public function getCurrentSet(): GameSet
    {
        return end($this->gameSets);
    }

    public function getSets(): array
    {
        return $this->gameSets;
    }

    public function isGameWin():bool
    {
        if(count($this->gameSets) < Game::MIN_SET_FOR_WIN) return false;
        return $this->getWinner() ? true: false;
    }

    public function getWinner(): ?Player
    {
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

    public function getPlayers() {
        return $this->players;
    }

}