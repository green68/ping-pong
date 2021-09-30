<?php

namespace App\Model;

use Exception;

class Game
{
    const MIN_POINTS_FOR_WINNING = 11;
    const GAP_POINTS = 2;
    const NUMBER_MIN_SET_WIN = 4;

    private string $id;
    private array $players = array();
    private array $gameSets = array();
    
    public function __construct(
        private int $numberOfGameSets, 
        private int $numberOfPlayers
    ) 
    {
        $this->id = uniqid("game-");
    }
        
    public function getId(): string
    {
        return $this->id;
    }
    
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
        if($this->isGameWin()) return;

        $this->gameSets[] = new GameSet($this->getPayers());
        $gameSetNumber = count($this->gameSets);
    }

    public function addPlayer($player) {
        if(count($this->players) == $this->numberOfPlayers) {
            throw new Exception("Ajout d'un nouveau joueur impossible");
        }

        $this->players[] = $player;
        $player->setPlaying($this->getId());
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
        if(count($this->gameSets) < Game::NUMBER_MIN_SET_WIN) return false;
        $setsWin = array();
        foreach($this->gameSets as $set) {
            if($set->getScore()->getWinner() !== null){
                 $setsWin[] = $set->getScore()->getWinner()->getName();
            } 
        }
        if(
            array_count_values($setsWin)[$this->players[0]->getName()] === Game::NUMBER_MIN_SET_WIN
            || array_count_values($setsWin)[$this->players[1]->getName()] === Game::NUMBER_MIN_SET_WIN
        ) {
            return true;
        }
        return false;
    }

    public function getPayers() {
        return $this->players;
    }

}