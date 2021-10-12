<?php 
declare(strict_types=1);

namespace test;

use App\Model\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testPlayer()
    {
        $player = new  Player("Eric");
        $this->assertInstanceOf(Player::class, new Player("Eric"));
    }
}