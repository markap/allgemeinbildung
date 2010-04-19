<?php

/**
 * throw this exception if 
 * game does not exists
 *
 * @package models
 * @subpackage Exception
 */
class Model_Exception_GameNotFound extends Exception {

	/**
	 * id of the game which does not exist
	 * @var string
	 */
	protected $id = null;


	/**
	 * constructor
	 * 
	 * @author Martin Kapfhammer
	 * @param integer $id
	 */
	public function __construct($id) {
		$this->id = $id;
	}
	

	/**
	 * Getter for the id
	 *
	 * @author Martin Kapfhammer
	 * @return $id
	 */
	public function getId() {
		return $this->id;
	}

}
