<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select question result data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_QuestionResult extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'questionresult';

	/**
	 * the userid of the logged user
	 * @var integer
	 */
	protected $userId = null;


	/**
	 * constructor
	 * executes superclass constructor 
	 * 
	 * @author Martin Kapfhammer
 	 * @param integer $userId
	 */
	public function __construct($userId) {
		parent::__construct();
		$this->userId = $userId;
	}


	/**
	 * checks if an entry for the current user, questionid and questiontype
	 * already exists
	 * returns the entry or false if not exists
	 *
	 * @author Martin Kapfhammer
	 * @param integer $questionId
	 * @param string $questionType
	 * @return array|boolean
	 */
	public function recordExists($questionId, $questionType) {
		$stmt = $this->select()
					 ->where('userid 	 = ?', $this->userId)				
					 ->where('questionid = ?', $questionId)
					 ->where('questiontype = ?', $questionType);
		$row = $this->fetchRow($stmt);
		
		return ($row) ? $row->toArray() : false;
	}


	/**
 	 * inserts the entry in db
	 *
	 * @author Martin Kapfhammer
	 *
 	 * @param integer $questionId
	 * @param string $questionType
	 * @param string $result
	 */
	public function saveResult($questionId, $questionType, $result) {
		$data = array('userid' 		 => $this->userId,
					  'questionid' 	 => $questionId,
					  'questiontype' => $questionType,
					  'result' 		 => $result
					);	
		$this->insert($data);
	}


	/**
	 * updates a entry
	 *
	 * @author Martin Kapfhammer
	 *
 	 * @param integer $questionId
	 * @param string $questionType
	 * @param string $result
	 */
	public function updateResult($questionId, $questionType, $result) {
		$data  = array('result' => $result);
		$where = "userid = $this->userId and questionid = $questionId and questiontype = '$questionType'";
		$this->update($data, $where);
	}

	public function getDistinctResult($result) {
		$stmt = $this->select();
		$stmt->distinct()
			 ->from($this, array('questionid'))
			 ->where('userid = ?', $this->userId)
			 ->where('result = ?', $result);
		$result = $this->fetchAll($stmt);
		return $result->toArray();
	}

	public function getResultForGame($result) {
		$where  = "userid = $this->userId and result = '$result'";
		$result = $this->fetchAll($where);
		$resultArray = $result->toArray();
		$questionIds = array();
		foreach ($resultArray as $result) {
			$questionIds[] = array(
								'id' 	=> $result['questionid'],
								'type'	=> $result['questiontype']);
		}
		return $questionIds;
	}
}
