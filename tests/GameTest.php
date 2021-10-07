<?php 
declare(strict_types=1);

// namespace test;

use App\Model\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(Game::class, new Game(2));
    }
}

