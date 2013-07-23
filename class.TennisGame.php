<?php

class TennisGame {
    private $playerOneName;
    private $playerTwoName;
    private $playerOneScore = 0;
    private $playerTwoScore = 0;
    private $playerWithAdvantage = "";
    
    public function __construct($playerOne = "Player 1", 
                                $playerTwo = "Player 2") {
        $this->playerOneName = $playerOne;
        $this->playerTwoName = $playerTwo;
    }
    
    public function getScore(){
        if ($this->hasWinner()) {
            return $this->playerWithHigherScore() . "Wins";
        }
        
        if ($this->hasAdvantage()) {
            return $this->playerWithAdvantage . " has advantage.";
        }
        
        if ($this->isDeduce()){
            return "Deduce";
        }
        
        if ($this->playerOneScore == $this->playerTwoScore){
            return $this->translateScore($this->playerOneScore) . " all";
        }
        
        return $this->translateScore($this->playerOneScore) . ", " .
               $this->translateScore($this->playerTwoScore);
    }
    
    private function playerWithHigherScore(){
        return $this->playerOneScore > $this->playerTwoScore ?
               $this->playerOneName : $this->playerTwoName;
    }
    
    private function isDeduce(){
        return $this->playerOneScore == 3
            && $this->playerOneScore == $this->playerTwoScore;
    }
    
    private function hasWinner(){
        if (($this->playerOneScore >= 4 || $this->playerTwoScore >= 4) 
            && abs($this->playerOneScore-$this->playerTwoScore) >= 2) {
            return TRUE;
        }
        return FALSE;
    }
    
    private function hasAdvantage(){
        if ($this->playerWithAdvantage == ""){
            return FALSE;
        }
        return $this->playerWithAdvantage;
    }
    
    public function playerOneScores(){
        if ($this->playerWithAdvantage != $this->playerOneName){
            $this->playerWithAdvantage = $this->playerOneName;
            return;
        }
        $this->playerOneScore++;
        if ($this->playerOneScore == 3 && $this->playerWithAdvantage == ""){
            $this->playerWithAdvantage = $this->playerOneName;
        }
    }
    
    public function playerTwoScores(){
        if ($this->playerWithAdvantage != $this->playerTwoName){
            $this->playerWithAdvantage = $this->playerTwoName;
            return;
        }
        $this->playerTwoScore++;
        if ($this->playerTwoScore == 3 && $this->playerWithAdvantage == ""){
            $this->playerWithAdvantage = $this->playerTwoName;
        }
    }
    
    private function translateScore($score){
        switch ($score) {
            case 0:
                return "0";
                
            case 1:
                return "15";
                
            case 2:
                return "30";
                
            case 3:
                return "40";
                
            default :
                return "Unknown";
        }
    }
}

?>