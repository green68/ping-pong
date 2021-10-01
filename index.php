<?php
    require 'vendor/autoload.php'; 
    
    use App\Model\Game;
    use App\Model\Player;

    function randomPlayerNum() {
        return random_int(0,1);
    }

    const NUMBER_OF_PLAYERS = 2;

    $game = new Game(Game::MIN_SET_FOR_WIN, NUMBER_OF_PLAYERS);

    try {
        // instance joueur1 et joueur2, puis affectation à un match
        $playerOne = new Player("Eric");
        $playerTwo = new Player("Mathieu");

        $game->addPlayer($playerOne);
        $game->addPlayer($playerTwo);
        // instance joueur3 et tentative ajout à un match
        // $game->addPlayer($playerThree);
    } catch (\Throwable $th) {
        echo "<br>".$th->getMessage();
    }

    // démarrage match
    echo "<h1>Game : {$game->getId()}</h1>";
    $game->start();
    echo "<h2>Set : " . count($game->getSets()) . "</h2>";
    
    do {
        $game->getCurrentSet()->addPointToPlayerNum(randomPlayerNum());
        echo $game->getCurrentSet()->getScore()->getPoints(0)." - ".$game->getCurrentSet()->getScore()->getPoints(1)." / ";
        // control des sets gagnants
        if($game->getCurrentSet()->isWinner()) {
            echo "<h3>Set gagné par ".$game->getCurrentSet()->getWinner()->getName()."</h3><hr>";
            // ajout d'un set?
            if(!$game->isGameWin()){
                $game->addGameSet();
                echo "<h2>Set : " . count($game->getSets()) . "</h2>";
            }
        }

    } while (!$game->isGameWin());


    echo "<h2>Jeu gagné par : ".$game->getWinner()->getName()."</h2>";
    