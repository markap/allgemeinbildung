<?php			

/**
 * Main class for register validation
 * @package models
 */
class Model_RegisterValidator {


	/**
	 * the register data
	 */
	protected $data		= array();

	/**
	 * errors of validation
	 * @var array
	 */
	protected $errors 	= array();


	/**
	 * contructor
	 *
	 * @author Martin Kapfhammer
	 * @param array $registerData
	 */
	public function __construct(array $registerData) {
		$this->data = $registerData;
	}


	/**
	 * checks is data is valid
	 *
	 * @author Martin Kapfhammer
	 * @return boolean
	 */
	public function isValid() {
		$this->validateUser();
		$this->existUser();
		$this->validateMail();	
		$this->repeatMail();
		$this->existMail();
		$this->validatePassword();
		$this->repeatPassword();
		return (count($this->errors) === 0) ? true : false;
	}


	/**
	 * return the errors
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->errors
	 */	
	public function getErrors() {
		return $this->errors;
	}


	/**
	 * validates the username 
	 * 
	 * @author Martin Kapfhammer
	 */
	protected function validateUser() {
		$lengthValidation  = new Zend_Validate_StringLength(0, 40);
		$isValid = $lengthValidation->isValid($this->data['username']);		
		if ($isValid === false) {
			$this->errors[] = 'Kein gültiger Benutzername';
		}
	}

	/**
	 * exist the username 
	 * 
	 * @author Martin Kapfhammer
	 */
	protected function existUser() {
		$uniqueUserValidate = new Zend_Validate_Db_RecordExists('user', 'username');
		$existsUser = $uniqueUserValidate->isValid($this->data['username']);
		if ($existsUser === true) {
			$this->errors[] = 'Benutzername existiert bereits';
		}
	}


	/**
	 * validates email 
	 * 
	 * @author Martin Kapfhammer
	 */
	public function validateMail() {
		$mailValidate = new Zend_Validate_EmailAddress();
		$isMailValid  = $mailValidate->isValid($this->data['mail']);
		if ($isMailValid === false) {
			$this->errors[] = 'Keine gültige Emailadresse';
		}
	}


	/**
	 * repeat email 
	 * 
	 * @author Martin Kapfhammer
	 */
	public function repeatMail() {
		if ($this->data['mail'] !== $this->data['mail_repeat']) {
			$this->errors[] = 'Falsche Emailwiederholung';
		}
	}


	/**
	 * checks if a mail already exists 
	 * 
	 * @author Martin Kapfhammer
	 */
	public function existMail() {
		$uniqueMailValidate = new Zend_Validate_Db_RecordExists('user', 'email');
		$existsMail = $uniqueMailValidate->isValid($this->data['mail']);
		if ($existsMail === true) {
			$this->errors[] = 'Email existiert bereits';
		}
	}


	/**
	 * validates the password 
	 * 
	 * @author Martin Kapfhammer
	 */
	public function validatePassword() {
		$lengthValidation  = new Zend_Validate_StringLength(4);
		$lengthValidation  = $lengthValidation->isValid($this->data['password']);		
		if ($lengthValidation === false) {
			$this->errors[] = 'Passwort muss mindestens 4 Stellen haben';
		}
	}


	/**
	 * repeat the password 
	 * 
	 * @author Martin Kapfhammer
	 */
	public function repeatPassword() {
		if ($this->data['password'] !== $this->data['password_repeat']) {
			$this->errors[] = 'Falsche Passwortwiederholung';
		}
	}
}
