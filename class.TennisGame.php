<?php

class TennisGame {

    private $playerOneName;
    private $playerTwoName;
    private $playerOneSetScore = 0;
    private $playerTwoSetScore = 0;
    private $playerOneGameScore = 0;
    private $playerTwoGameScore = 0;
    private $playerWithAdvantage = "";

    public function __construct($playerOne = "Player 1", $playerTwo = "Player 2") {
        $this->playerOneName = $playerOne;
        $this->playerTwoName = $playerTwo;
    }

    public function getSetScore() {
        // Advantage Checking
        if ($this->playerWithAdvantage != "") {
            return "Advantage of " . $this->playerWithAdvantage;
        }

        // Deduce Checking
        if ($this->playerOneSetScore == 3
         && $this->playerOneSetScore == $this->playerTwoSetScore) {
            return "Deduce";
        }

        return $this->translateScore($this->playerOneSetScore) . ", " .
               $this->translateScore($this->playerTwoSetScore);
    }

    public function getGameScore() {
        // Checking if there is any winner by rules
        if ($this->hasWinner()) {
            $result = "";
            if ($this->playerOneGameScore > $this->playerTwoGameScore) {
                $result .= $this->playerOneName;
            }
            else {
                $result .= $this->playerTwoName;
            }
            $result .= " won by " . $this->playerOneGameScore . "-";
            $result .= $this->playerTwoGameScore;
            return $result;
        }
        
        return $this->playerOneName . ":" . $this->playerOneGameScore . ", " .
               $this->playerTwoName . ":" . $this->playerTwoGameScore;
    }

    private function hasWinner() {
        if ($this->playerOneGameScore >= 3
         && $this->playerOneGameScore - $this->playerTwoGameScore >= 2) {
            return TRUE;
        } 
        elseif ($this->playerTwoGameScore >= 3
             && $this->playerTwoGameScore - $this->playerOneGameScore >= 2) {
            return TRUE;
        }
        return FALSE;
    }

    public function playerOneScores() {
        if (($this->playerWithAdvantage == $this->playerOneName)
         || ($this->playerOneSetScore >=3 && $this->playerTwoSetScore <= 2)    ) {
            $this->playerOneGameScore++;
            $this->resetSetScore();
            return;
        }
        elseif ($this->playerWithAdvantage == $this->playerTwoName) {
            $this->playerWithAdvantage = "";
            return;
        }
        elseif ($this->playerOneSetScore == $this->playerTwoSetScore
             && $this->playerOneSetScore == 3) {
            $this->playerWithAdvantage = $this->playerOneName;
            return;
        }
        
        $this->playerOneSetScore++;
    }

    public function playerTwoScores() {
        if (($this->playerWithAdvantage == $this->playerTwoName)
         || ($this->playerTwoSetScore >=3 && $this->playerOneSetScore <= 2)    ) {
            $this->playerTwoGameScore++;
            $this->resetSetScore();
            return;
        }
        elseif ($this->playerWithAdvantage == $this->playerOneName) {
            $this->playerWithAdvantage = "";
            return;
        }
        elseif ($this->playerOneSetScore == $this->playerTwoSetScore
             && $this->playerOneSetScore == 3) {
            $this->playerWithAdvantage = $this->playerTwoName;
            return;
        }
        
        $this->playerTwoSetScore++;
    }

    private function resetSetScore() {
        $this->playerOneSetScore = 0;
        $this->playerTwoSetScore = 0;
        $this->playerWithAdvantage = "";
    }

    private function translateScore($score) {
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