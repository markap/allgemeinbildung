<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select helper data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_Helper extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'helper';

	static protected $instance = null;

	static public function getInstance() {
		if (self::$instance === null) {
			self::$instance = new Model_DbTable_Helper();
		}	
		return self::$instance;
	}
	
	/**
	 * returns the next img number 
	 * updates/increments db value
	 * 
	 * @author Martin Kapfhammer
	 * @return integer $number
	 */
	public function getImageNumber() {
		$result = $this->fetchRow('name = "img"')->toArray();
		$number = (int)$result['value'];
		$data 	= array('value' => ++$number);
		$where 	= array('name' => 'img');
		$this->update($data, $where);
		return $number;
	}

}
