<?php

include_once 'class.TennisGame.php';

class TennisTest extends \PHPUnit_Framework_TestCase {

    private $game;

    public function setUp() {
        $this->game = new TennisGame();
    }

    public function testZeroOnMatchStart() {
        $this->assertEquals("0, 0", $this->game->getSetScore());
    }

    public function testPlayerOneScoredOnce() {
        $this->game->playerOneScores();
        $this->assertEquals("15, 0", $this->game->getSetScore());
    }

    public function testPlayerTwoScoredOnce() {
        $this->game->playerTwoScores();
        $this->assertEquals("0, 15", $this->game->getSetScore());
    }

    public function testBothPlayersAt30() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->assertEquals("30, 30", $this->game->getSetScore());
    }
    
    public function testOneAt30TwoAt40() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->assertEquals("30, 40", $this->game->getSetScore());
    }
    
    public function testOneAt40TwoAt30() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->assertEquals("30, 40", $this->game->getSetScore());
    }
    
    public function testDeduce() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->assertEquals("Deduce", $this->game->getSetScore());
    }
    
    public function testAdvantageOfFirst() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->assertEquals("Advantage of Player 1", $this->game->getSetScore());
    }
    
    public function testAdvantageOfSecond() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->assertEquals("Advantage of Player 2",
                             $this->game->getSetScore());
    }
    
    public function testDirectWinOfFirst() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->assertEquals("0, 0", $this->game->getSetScore());
        $this->assertEquals("Player 1:1, Player 2:0", 
                             $this->game->getGameScore());
    }
    
    public function testDirectWinOfSecond() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->assertEquals("0, 0", $this->game->getSetScore());
        $this->assertEquals("Player 1:0, Player 2:1", 
                             $this->game->getGameScore());
    }
    
    public function testWinOfFirstAfterDeduce() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->assertEquals("0, 0", $this->game->getSetScore());
        $this->assertEquals("Player 1:1, Player 2:0", 
                             $this->game->getGameScore());
    }
    
    public function testWinOfSecondAfterDeduce() {
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerOneScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->assertEquals("0, 0", $this->game->getSetScore());
        $this->assertEquals("Player 1:0, Player 2:1", 
                             $this->game->getGameScore());
    }
    
    public function testFirstWinner() {
        // Player 1 Win
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        
        // Player 2 Won
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        
        // Player 1 Won
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        
        // Player 1 Won
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        
        $this->assertEquals("0, 0", $this->game->getSetScore());
        $this->assertEquals("Player 1 won by 3-1", 
                             $this->game->getGameScore());
    }
    
    public function testSecondWinner() {
        // Player 2 Won
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        
        // Player 2 Won
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        
        // Player 1 Won
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        $this->game->playerOneScores();
        
        // Player 2 Won
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        $this->game->playerTwoScores();
        
        $this->assertEquals("0, 0", $this->game->getSetScore());
        $this->assertEquals("Player 2 won by 1-3", 
                             $this->game->getGameScore());
    }

}