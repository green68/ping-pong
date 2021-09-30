<?php
    require 'vendor/autoload.php'; 
    
    use App\Model\Game;
    use App\Model\Player;

    function randomPlayerNum() {
        return random_int(0,1);
    }

    const NUMBER_OF_PLAYERS = 2;

    $game = new Game(Game::NUMBER_MIN_SET_WIN, NUMBER_OF_PLAYERS);
    echo "création d'un match,";
    echo " id : ".$game->getId();


    try {
        // instance joeur1 et affectation à un match
        $playerOne = new Player("Eric");
        $playerTwo = new Player("Mathieu");
        $playerThree = new Player("Saïd");

        $game->addPlayer($playerOne);
        // instance joueur2 et affectation à un match
        $game->addPlayer($playerTwo);
        // instance joueur3 et tentative ajout à un match
        $game->addPlayer($playerThree);
    } catch (\Throwable $th) {
        echo "<br>".$th->getMessage();
    }

    // démarrage match
    echo "<h1>Game : {$game->getId()}</h1>";
    $game->start();
    echo "<h2>Set : " . count($game->getSets()) . "</h2>";
    
    // ajout des points
    // for ($i=0; $i < 200; $i++) { 
    do {
    
        $game->getCurrentSet()->addPointToPlayerNum(randomPlayerNum());
        // control des sets gagnants
        if($game->getCurrentSet()->getScore()->isWinner()) {
            echo "<h3>Set win by ".$game->getCurrentSet()->getScore()->getWinner()->getName()."</h3><hr>";
            // test nombre de sets
            // if($game->isGameWin()) break;
            // ajout d'un set
            $game->addGameSet();
            echo "<h2>Set : " . count($game->getSets()) . "</h2>";
            // echo "<h2>Set ".count($game->getSets())."</h2>";

        }
    } while (!$game->isGameWin());
    // }

    dump($game);
    
    // TODO:
    // control des sets : si gagnant -> set suivant ou fin match
