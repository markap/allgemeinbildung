<?php

/**
 * score object
 * the collector of all your game data
 * 
 * @package models
 */
class Model_Score {

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
	 * contains all right question objects Model_Question
	 * @var array
	 */
	protected $rightQuestions = array();

	/**
	 * contains all wrong question objects Model_Question
	 * @var array
	 */
	protected $wrongQuestions = array();


	/**
 	 * increments the right answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addRightAnswer(Model_QuestionInterface $question) {
		$this->rightQuestionIds[] = $question->getQuestionId();
		$this->rightQuestions[]	  = $question;
	}	
	
	
	/**
	 * increments the wrong answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addWrongAnswer(Model_QuestionInterface $question) {
		$this->wrongQuestionIds[] = $question->getQuestionId();
		$this->wrongQuestions[]   = $question;
	}


	/**
	 * getter for the right answers
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->rightAnswers
	 */
	public function getRightAnswers() {
		return count($this->rightQuestionIds);
	}


	/**
	 * getter for the wrong  answers
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->wrongAnswers
	 */
	public function getWrongAnswers() {
		return count($this->wrongQuestionIds);
	}


	/**
	 * getter for the played questions
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->questions
	 */
	public function getPlayedQuestions() {
		return $this->getRightAnswers() + $this->getWrongAnswers(); 
	}


	/**
	 * getter for the right questionids
	 * 
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestionIds
	 */
	public function getRightQuestionIds() {
		return $this->rightQuestionIds;
	}


	/**
	 * getter for the wrong questionids
	 * 
	 * @author Martin Kapfhammer
	 * @return array $this->wrongQuestionIds
	 */ 
	public function getWrongQuestionIds() {
		return $this->wrongQuestionIds;
	}


	/**
	 * returns the right questionIds as a string
	 * 
	 * @author Martin Kapfhammer
	 * @return imploded question Ids
	 */
	public function getImplodedRightQuestionIds() {
		return implode(',', $this->getRightQuestionIds());
	}


	/**
	 * returns the wrong questionIds as a string
	 * 
	 * @author Martin Kapfhammer
	 * @return imploded question Ids
	 */
	public function getImplodedWrongQuestionIds() {
		return implode(',', $this->getWrongQuestionIds());
	}


	/**
	 * getter for the right question objects
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestions
	 */
	public function getRightQuestions() {
		return $this->rightQuestions;
	}


	/**
	 * getter for the wrong question objects
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestions
	 */
	public function getWrongQuestions() {
		return $this->wrongQuestions;
	}

}
