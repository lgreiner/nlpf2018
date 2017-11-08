<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class GreinerPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class GreinerPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {

        //Ouai les variables ouai énorme !!!
        $NumRound = $this->result->getNbRound();
        $enemy = $this->result->getStatsFor($this->opponentSide);        
        $proba_scissors = $enemy['scissors'] / ($NumRound + 1);
        $proba_paper = $enemy['paper'] / ($NumRound + 1);
        $proba_rock = $enemy['rock'] / ($NumRound + 1);
        $last_opponent_score = $this->result->getLastScoreFor($this->opponentSide);
        $last_opponent_choice = $this->result->getLastChoiceFor($this->opponentSide);
        $last_me_choice = $this->result->getLastChoiceFor($this->mySide);
        $choice = parent::paperChoice();
        $last_opp = $this->result->getStatsFor($this->opponentSide);


        if ($last_opp['name'] === 'Crepin') {
            if ($NumRound % 2 === 0) {
                return parent::paperChoice();
            } else {
                return parent::scissorsChoice();
            }
        } else if ($last_opp['name'] === 'Labat') {
            if ($NumRound % 2 === 0) {
                return parent::paperChoice();
            } else {
                return parent::scissorsChoice();
            }
        } else if ($last_opp['name'] === 'Debec') {
            return parent::scissorsChoice();
        }

        if (0 !== $last_opponent_choice) {
            if ($proba_scissors > 0.65) {
                if ($last_opponent_score === 5 && $last_opponent_choice == parent::paperChoice()) {
                    $choice = parent::scissorsChoice();                    
                } elseif ($last_opponent_score === 0) {
                    $choice = $last_me_choice;
                }
                else {
                    $choice = parent::rockChoice();
                }
            } elseif ($proba_paper > 0.45) {
                if ($last_opponent_score === 5 && $last_opponent_choice == parent::rockChoice()) {
                    $choice = parent::paperChoice();                    
                } elseif ($last_opponent_score === 0) {
                    $choice = $last_me_choice;
                }
                else {
                    $choice = parent::scissorsChoice();
                }
            } elseif ($proba_rock > 0.62) {
                if ($last_opponent_score === 5 && $last_opponent_choice == parent::scissorsChoice()) {
                    $choice = parent::rockChoice();                    
                } elseif ($last_opponent_score === 0) {
                    $choice = $last_me_choice;
                }
                else {
                    $choice = parent::paperChoice();
                }
            }
        }
        return $choice;
        
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
    }
};