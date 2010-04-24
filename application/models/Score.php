<?php

/**
 * score object
 * the collector of all your game data
 * 
 * @package models
 */
class Model_Score {

	/**
	 * counts the played questions
	 * @var integer
	 */
	protected $questions	= 0;

	/**
	 * counts the right answers
	 * @var integer
	 */
	protected $rightAnswers = 0;

	/**
	 * counts the wrong answers
	 * @var integer
	 */
	protected $wrongAnswers = 0;
	
	/**
	 * the score at the and of a game
	 * @var integer
	 */
	protected $calculatedScore = 0;
 	

	/**
 	 * increments the right answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param Model_Question $question
	 */
	public function addRightAnswer(Model_Question $question) {
		$this->questions++;
		$this->rightAnswers++;
	}	
	
	
	/**
	 * increments the wrong answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param Model_Question $question
	 */
	public function addWrongAnswer(Model_Question $question) {
		$this->questions++;
		$this->wrongAnswers++;
	}


	/**
	 * getter for the right answers
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->rightAnswers
	 */
	public function getRightAnswers() {
		return $this->rightAnswers;
	}


	/**
	 * getter for the wrong  answers
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->wrongAnswers
	 */
	public function getWrongAnswers() {
		return $this->wrongAnswers;
	}


	/**
	 * getter for the played questions
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->questions
	 */
	public function getPlayedQuestions() {
		return $this->questions;
	}


	/**
 	 * setter for the calculated score at the
	 * end of a game
	 *
	 * @author Martin Kapfhammer
	 * @param integer $score
	 */
	public function setCalculatedScore($score) {
		$this->calculatedScore = $score;
	}


	/**
	 * getter for the calculated score
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->calculatedScore
	 */
	public function getCalculatedScore() {
		return $this->calculatedScore;
	}
}
