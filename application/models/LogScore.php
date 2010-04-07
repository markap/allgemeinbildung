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
	 * @param integer $questionId
 	 * @param string $questionType
	 */
	public function addRightAnswer($questionId, $questionType = null) {
		parent::addRightAnswer($questionId);
		$this->saveQuestion($questionId, $questionType, 'Y');
	}	
	
	
	/**
	 * executes the superclass method 
	 * and saves the wrong question
	 *
	 * @author Martin Kapfhammer
	 * @param integer $questionId
 	 * @param string $questionType
	 */
	public function addWrongAnswer($questionId, $questionType = null) {
		parent::addWrongAnswer($questionId);
		$this->saveQuestion($questionId, $questionType, 'N');
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
}
