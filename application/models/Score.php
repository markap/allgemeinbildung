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
	 * array for the right questionids
	 * @var array
	 */
	protected $rightQuestionIds = array();
	
	/**
	 * array for the wrong questionids
	 * @var array
	 */
	protected $wrongQuestionIds = array();
 	
	

	/**
 	 * increments the right answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param integer $questionId
	 * @param string $questionType
	 */
	public function addRightAnswer($questionId, $questionType = null) {
		$this->rightQuestionIds[] = $questionId;
		$this->questions++;
		$this->rightAnswers++;
	}	
	
	
	/**
	 * increments the wrong answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param integer $questionId
	 * @param string $questionType
	 */
	public function addWrongAnswer($questionId, $questionType = null) {
		$this->wrongQuestionIds[] = $questionId;
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

}
