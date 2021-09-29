<?php

namespace App\Model;

use Exception;

class Game
{
    private string $id;
    private bool $starting = false;
    private int $gameSetPlaying = -1;
    private array $players = array();
    private array $gameSets = array();
    // private array $scores = array();

    
    public function __construct(
        private int $numberOfGameSets, 
        private int $numberOfPlayers
    ) 
    {
        // $this->id = spl_object_id($this);
        $this->id = uniqid("game-");
        for ($i=0; $i < $this->numberOfGameSets; $i++) { 
            $this->gameSets[] = new GameSet($this->getId());
        }
    }
        
    public function getId(): string
    {
        return $this->id;
    }
    
    public function isStarting(): bool
    {
        return $this->starting;
    }

    public function setPlayer(int $number, Player $player){

    }
    
    public function start()
    {
        if(!$this->isStarting()){
            throw new Exception("Jeu déjà en cours");
        }
        if($this->checkNumberOfPlayers() !== 0) {
            throw new Exception("démarrage impossible, nombre de joueurs incorrect");
        }
        $this->starting = true;
    }
    public function setPlayers(array $playersArray) 
    {
        // verif nbre de joueurs
        if(count($playersArray)!= $this->numberOfPlayers ) {
            throw new Exception("Nombre de joueurs non conforme doit etre égale à ".$this->numberOfPlayers);
        }
        // verif joueur dispo
        foreach ($playersArray as $player) {
            if(!$player->isPlaying())            {
                throw new Exception("joueur {$player->getName()} joue déjà");
            }
        }
        $this->players = $playersArray;
    }

    public function addPlayer($player) {
        if(count($this->players) == $this->numberOfPlayers) {
            throw new Exception("Ajout d'un nouveau joueur impossible");
        }

        $this->players[] = $player;
        $player->setPlaying($this->getId());
        // $this->scores[] = new Score();       
    }

    public function checkNumberOfPlayers(): int 
    {
        return $this->numberOfPlayers - count($this->players);
    }

    public function addPointToPlayer(Player $player)
    {
        // control si jeu démarré
        if($this->isStarting()){
            throw new Exception("ajout de point impossible, jeu non demarré");
        }

        // cherche num du joueur
        $playerNumber = array_search($player, $this->players);
        $this->addPointToPlayerNum($playerNumber);
    }
    
    
    public function addPointToPlayerNum(int $playerNumber) {
        // dump(isset($this->players[$playerNumber]));
        // control si joueur en jeu
        if(isset($this->players[$playerNumber]) === false) {
            throw new Exception("ajout de point impossible");
        }
        
        // TODO : ajout score pour le joueur dans le set en cours
        // $this->scores[$playerNumber]->addPoint();

    }


}