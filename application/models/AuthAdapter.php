<?php

/**
 * user authentification
 * @package models
 */
class Model_AuthAdapter implements Zend_Auth_Adapter_Interface {

	/**
	 * @var string
	 */
	protected $username;

	/**
	 * @var string
	 */
	protected $password;
	
	/**
	 * @var Model_DbTable_User
	 */
	protected $userDb;

	/**
	 * @var object
	 */	
	protected $match;


	/**
	 * constructor
	 *
	 * @author Martin Kapfhammer
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
		$this->userDb 	= new Model_DbTable_User();
		$this->match = $this->userDb->findCredentials($this->username, $this->password);
	}


	/**
	 * user authentification 
	 *
	 * @author Martin Kapfhammer
	 * @return Zend_Auth_Result $result
	 */
	public function authenticate() {
 		if (!$this->match) {
            $result = new Zend_Auth_Result(
                            Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
                            null);
        } else {
        	$user = current($this->match);
        	$result = new Zend_Auth_Result(
                        Zend_Auth_Result::SUCCESS,
                        $user);
		}
        return $result;
	}


	/**
	 * checks if the user is active
	 *
	 * @author Martin Kapfhammer
	 * @return boolean 
	 */
	public function isActive() {
		if (!$this->match) {
			return false;
		}
		$match = $this->match->toArray();
		return ($match['active'] === 'Y') ? true : false;
	}
}
