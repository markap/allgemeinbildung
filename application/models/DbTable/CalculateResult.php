<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select calculate result data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_CalculateResult extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'calculateresult';

	public function insertResult(array $params, $userId) {
		$data = array('userid' 		=> $userId,
					  'time'   		=> $params['time'],
					  'right' 		=> $params['right'],
					  'level'	 	=> $params['level'],
					  'operation' 	=> $params['operation'],
					  'next'		=> $params['next']
					);
		return $this->insert($data);
	}


	public function updateResult(array $params, $userId) {
		$data = array('time' 	=> $params['time'],
					  'right'	=> $params['right'],
					  'next'	=> $params['next']
					);
		$where = array('userid = ' 		. $userId,
					   'level = '  		. $params['level'],
					   'operation = "' 	. $params['operation'] . '"'
					);
		$this->update($data, $where);
	}


	public function getResult($operation, $level, $userId) {
		$where = array('operation = "' . $operation . '"',
					   'level = ' 	  . $level,
					   'userid = ' 	  . $userId);
		$result = $this->fetchRow($where);
		return ($result) ? $result->toArray() : false;
	}
}
