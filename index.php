<?php
    require 'vendor/autoload.php'; 
    
    use App\Model\Game;
    use App\Model\Players;
    
    $licensed = array(
        "Adrien",
        "Eric",
        "Laurent",
        "Mathieu",
        "Said",
    );
    
    $players = new Players($licensed);
    dump($players);
    
    
    $g1 = new Game(3, 2);
    echo "création d'un match,";
    echo " id : ".$g1->getId();

    try {
        echo "<br>nombre de joueur(s) restant : ".$g1->checkNumberOfPlayers();
        // instance joeur1 et affectation à un match
        $playerOne = $players->getFreePlayer();
        $g1->addPlayer($playerOne);
        echo "<br>nombre de joueur(s) restant : ".$g1->checkNumberOfPlayers();
        
        // instance joueur2 et affectation à un match
        $playerTwo = $players->getFreePlayer();
        $g1->addPlayer($playerTwo);
        echo "<br>nombre de joueur(s) restant : ".$g1->checkNumberOfPlayers();
        
        // instance joueur3 et tentative ajout à un match
        $playerThree = $players->getFreePlayer();
        $g1->addPlayer($playerThree);
    } catch (\Throwable $th) {
        echo "<br>".$th->getMessage();
    }

    dump($g1);

    // TODO:
    // démarrage match
    // ajout des points
    // control des sets : si gagnant -> set suivant ou fin match

    // $g1->addPointToPlayer($playerOne);
    // dump($g1);
    // $g1->addPointToPlayerNum(1);
    // dump($g1);
