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
        $playerTwo = new Player("Kevin");

        $game->addPlayer($playerOne);
        $game->addPlayer($playerTwo);
        // instance joueur3 et tentative ajout à un match
        // $game->addPlayer($playerThree);
    } catch (\Throwable $th) {
        echo "<br>".$th->getMessage();
    }

    // démarrage match
    echo "<h1>Game : {$game->getId()}</h1>";
    echo "<h2>Joueur 1: ". $game->getPlayers()[0]->getName()."<br>";
    echo "Joueur 2: ". $game->getPlayers()[1]->getName()."</h2>";

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

    // recup nbre sets pour chaque joueur
    $sets = array(0,0);
    foreach ($game->getSets() as $set) {
        $set->getWinner() === $playerOne ? $sets[0]++ : $sets[1]++;
    } 
    dump($sets);
    echo "<h2>Jeu gagné par : ".$game->getWinner()->getName()." $sets[0] / $sets[1]</h2>";
    