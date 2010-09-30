<?php

/**
 * score object, saves wrong and right answers in db
 * the collector of all your game data
 * 
 * @package models
 */
//class Model_LogScore extends Model_Score {


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
	 * constructor
	 * creates a new instance of the questionresult-dbtable 	
	 *
	 * @author Martin Kapfhammer
	 * @param integer $userId
	 */
	public function __construct($userId) {
		$this->resultDb = new Model_DbTable_QuestionResult($userId);
	}
	

	/**
 	 * executes the superclass method 
	 * and saves the right question
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addRightAnswer(Model_QuestionInterface $question) {
		parent::addRightAnswer($question);
		$this->rightQuestionIds[] = $question->getQuestionId();
		$this->rightQuestions[]	  = $question;
	}	
	
	
	/**
	 * executes the superclass method 
	 * and saves the wrong question
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addWrongAnswer(Model_QuestionInterface $question) {
		parent::addWrongAnswer($question);
		$this->wrongQuestionIds[] = $question->getQuestionId();
		$this->wrongQuestions[]   = $question;
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
