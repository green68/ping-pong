<?php
    require 'vendor/autoload.php'; 
    
    use App\Model\Game;
    use App\Model\Player;

    function randomPlayerNum() {
        return random_int(0,1);
    }
    $NUMBER_OF_SET_WIN = 3;
    $NUMBER_OF_PLAYERS = 2;
    $MIN_POINTS_FOR_WINNING = 11;

    $game = new Game($NUMBER_OF_SET_WIN, $NUMBER_OF_PLAYERS);
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
    $game->start();
    $game->affiche();
    
    // ajout des points
    for ($i=0; $i < 22; $i++) { 
        $game->getCurrentSet()->addPointToPlayerNum(randomPlayerNum());
        if($game->getCurrentSet()->getScore()->isWinner()) {

            echo "Set win by ".$game->getCurrentSet()->getScore()->getWinner()->getName();
        }
    }

    dump($game);
    
    // TODO:
    // control des sets : si gagnant -> set suivant ou fin match
