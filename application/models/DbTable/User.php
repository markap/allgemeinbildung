<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select user data
 *
 * @package models/DbTable
 */
class Model_DbTable_User extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'user';


	/**
	 * searches username and password for authentification
	 *
	 * @author Martin Kapfhammer
	 * @param string $username
	 * @param string $password
	 * @return array|boolean
	 */
	public function findCredentials($username, $password) {
		$stmt =  $this->select()
						->where('username = ?', $username)
						->where('password = ?', md5($password)) 
						->where('active = ?', 'Y');
		$row  =  $this->fetchRow($stmt);
		$this->user = $row;

		return ($row) ? $row : false;
	}
}
