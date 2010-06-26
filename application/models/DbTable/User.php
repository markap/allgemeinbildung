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
						->where('password = ?', md5($password));
		$row  =  $this->fetchRow($stmt);
		return ($row) ? $row : false;
	}

	
	/**
	 * saves the username 
	 * 
	 * @author Martin Kapfhammer
	 * @param array $data the userdata coming from formular
	 */
	public function saveUser(array $data) {
		$data = array('username' => $data['username'],
					  'password' => md5($data['password']),
					  'creationdate' => date('Y-m-d'),
					  'active'	 => 'N',
					  'role'	 => 'user',
					  'email'	 => $data['mail']
					);
		$this->insert($data);
	}  
}
