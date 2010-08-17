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

	public function getUser($userId) {
		$where = array('userid = ' . $userId);
		$user  = $this->fetchRow($where);
		return ($user) ? $user->toArray() : false;
	}

	public function activateUser($userId) {
		$data  = array('active' => 'Y');
		$where = array('userid = ' . $userId);
		$this->update($data, $where);
	}

	
	/**
	 * saves the username 
	 * 
	 * @author Martin Kapfhammer
	 * @param array $data the userdata coming from formular
	 * @return insert id
	 */
	public function saveUser(array $data) {
		$data = array('username' => $data['username'],
					  'password' => md5($data['password']),
					  'creationdate' => date('Y-m-d'),
					  'active'	 => 'N',
					  'role'	 => 'user',
					  'email'	 => $data['mail']
					);
		return $this->insert($data);
	}  
}
