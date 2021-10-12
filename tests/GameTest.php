<?php 
declare(strict_types=1);

namespace test;

use App\Model\Game;
use App\Model\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testGameConstruct()
    {
        $this->assertInstanceOf(Game::class, new Game());
    }

    public function testNewGameStartError()
    {
        $game = new Game();
        $this->expectException(\Exception::class);
        $game->start();
        
    }

    public function testAddOneNewplayer()
    {
        $game = new Game();
        $game->addPlayer(new Player("Eric"));
        $this->assertCount(1, $game->getPlayers());
    }
    
    public function testAddNewplayerError()
    {
        $game = new Game();
        $game->addPlayer(new Player("Eric"));
        $game->addPlayer(new Player("David"));
        $this->expectException(\Exception::class);
        $game->addPlayer(new Player("Mathieu"));
    }
    
    public function testAddGameSetError()
    {
        $game = new Game();
        $this->expectException(\Exception::class);
        $game->addGameSet();
        
    }


}

