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
	static public function createGame($questionIds, $toLearn = false) {
    	if ($toLearn) { // Learn game
        	$game = new Model_LearnGame($questionIds, new Model_Score());
     	} else {
          	$game = new Model_Game($questionIds, new Model_Score());
        }
		return $game; 
	}
}
