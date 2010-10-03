<?php

/** 
 * factory class
 * returns a game object for the given parameters
 * @package models
 */
class Model_GameFactory {


	/**
	 * creates a game object
	 *
	 * @author Martin Kapfhammer
	 * @static
	 * @return Model_Game $game
	 */
	static public function createGame($questionIds, $toLearn = false, $mcToTxtType = false) {
    	if ($toLearn && !$mcToTxtType) { // Learn game
			$score = new Model_ScoreComposite();
			$score->addChild(new Model_Score());
			$score->addChild(new Model_Score());
			$score->addChild(new Model_Score());
        	$game = new Model_LearnGame($questionIds, $score);
     	} else if ($toLearn) {
			
          	$game = new Model_MCtoTXTGame($questionIds, new Model_MCtoTXTScore());

		} else {
          	$game = new Model_Game($questionIds, new Model_Score());
        }
		return $game; 
	}
}
