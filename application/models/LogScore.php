<?php

/**
 * score object, saves wrong and right answers in db
 * the collector of all your game data
 * 
 * @package models
 */
class Model_LogScore extends Model_Score {

	/**
	 * @var Model_DbTable_QuestionResult
	 */
	protected $resultDb = null;

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
	 * @param Model_Question $question
	 */
	public function addRightAnswer(Model_Question $question) {
		parent::addRightAnswer($question);
		$this->rightQuestionIds[] = $question->getQuestionId();
		$this->rightQuestions[]	  = $question;
		//$this->saveQuestion($question->getQuestionId(), 
							//$question->getQuestionType(), 'Y');
	}	
	
	
	/**
	 * executes the superclass method 
	 * and saves the wrong question
	 *
	 * @author Martin Kapfhammer
	 * @param Model_Question $question
	 */
	public function addWrongAnswer(Model_Question $question) {
		parent::addWrongAnswer($question);
		$this->wrongQuestionIds[] = $question->getQuestionId();
		$this->wrongQuestions[]   = $question;
		//$this->saveQuestion($question->getQuestionId(), 
							//$question->getQuestionType(), 'N');
	}


	/**
 	 * checks if a question entry already exists, and then
	 * update, insert or let the entry
	 *
	 * @author Martin Kapfhammer
	 * @param integer $questionId
	 * @param string $questionType
 	 * @param string $result
	 */
	protected function saveQuestion($questionId, $questionType, $result) {
		$existRecord = $this->resultDb->recordExists($questionId, $questionType);
		if ($existRecord === false) {
			$this->resultDb->saveResult($questionId, $questionType, $result);
			return '';
		}
		if (!$this->isReadyToUpdate($existRecord['date']) && $result === 'Y') {
			// do nothing -> its not the time to set right 
			return '';
		}
		$this->resultDb->updateResult($questionId, $questionType, $result);
		return '';
	}

	protected function isReadyToUpdate($existingDate) {
		$existingTimestamp = strtotime($existingDate);
		$nowAsTimestamp    = strtotime('now') - (60 * 60 * 24 *3);
		return ($nowAsTimestamp >= $existingTimestamp) ? true : false;
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
