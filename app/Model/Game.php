<?php

namespace App\Model;

use Exception;

class Game
{
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
            dump($this);
            throw new Exception("démarrage impossible, nombre de joueurs incorrect");
        }
        $this->addGameSet();
    }

    private function addGameSet() {
        $this->gameSets[] = new GameSet($this->getId());
        $gameSetNumber = count($this->gameSets);
        echo "<br>Set {$gameSetNumber}<br>";
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


    public function affiche(){
        echo "<h1>Game : {$this->getId()}</h1>";
        echo "<h2></h2>";
    }

}