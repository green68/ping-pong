<?php

namespace App\Helper;

use App\Model\Game;
use App\Model\Player;

class GameSimulator {

    private Game $game;
    private array $players;

    public function __construct(string $namePlayer1, string $namePlayer2)
    {
        $this->game = new Game(2);
        $this->players[] = new Player($namePlayer1);
        $this->players[] = new Player($namePlayer2);
        $this->game->addPlayer($this->players[0]);
        $this->game->addPlayer($this->players[1]);
        $this->gameStart();
        $this->gamePlay();
        $this->gameFinished();

    }

    private function gameStart()
    {
        ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Simulateur de parti de Ping-pong</title>
            </head>
            <body>
                
        <?php
        echo "<h1>Match : ";
        echo $this->game->getPlayers()[0]->getName()." vs ";
        echo $this->game->getPlayers()[1]->getName()."</h1>";
        $this->game->start();
        $this->game->addGameSet();
        echo "<h2>Set : " . count($this->game->getSets()) . "</h2>";
    }


    private function randomPlayerNum() {
        return random_int(0,1);
    }

    private function gamePlay(){

        do {
            $this->game->getCurrentSet()->getScore()->addPoint($this->randomPlayerNum());
            echo $this->game->getCurrentSet()->getScore()->getPoints(0)." - ".$this->game->getCurrentSet()->getScore()->getPoints(1)." / ";
            // control des sets gagnants
            if($this->game->getCurrentSet()->isWinner()) {
                echo "<h3>Set gagné par : ".$this->game->getCurrentSet()->getWinner()->getName()."</h3><hr>";
                // ajout d'un set?
                // if(!$this->game->isGameWin()){
                if(!$this->game->getWinner()){
                    $this->game->addGameSet();
                    echo "<h2>Set : " . count($this->game->getSets()) . "</h2>";
                }
            }
    
        } while (!$this->game->getWinner());

        // $this->gameFinished();
    }

    private function gameFinished(){
        // recup nbre sets pour chaque joueur
        $sets = array(0,0);
        foreach ($this->game->getSets() as $set) {
            $set->getWinner() === $this->players[0] ? $sets[0]++ : $sets[1]++;
        } 
        echo "<h2>Match gagné par : ".$this->game->getWinner()->getName()." ($sets[0] / $sets[1])</h2>";
        ?>
                </body>
            </html>

        <?php
    }
}

// $gameSimulator = new GameSimulator("Eric", "David");