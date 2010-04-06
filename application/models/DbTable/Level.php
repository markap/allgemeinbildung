<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select level data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_Level extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'level';


	/**
	 * returns a level for a special id
	 * 
	 * @author Martin Kapfhammer
	 * @param string $levelId
	 * @throws Model_Exception_QuestionNotFound
	 * @return array $level
	 */
	public function getLevel($levelId) {
		$level = $this->fetchRow('levelid = '. $levelId);
		if (!$level) {
			throw new Model_Exception_QuestionNotFound('level', $levelId);
		}
		return $level->toArray();
	}


	/**
	 * returns all levels
	 * 
	 * @author Martin Kapfhammer
	 * @return array $formattedResult	
	 */
	public function getLevels() {
		$orderBy = array('levelid ASC');
		$results = $this->fetchAll('1', $orderBy)->toArray();
		$formattedResult = array();
		foreach ($results as $result) {
			$formattedResult[$result['levelid']] = $result['name']; 
		}
		return $formattedResult;
	}
}
