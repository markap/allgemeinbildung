<?php

/**
 * throw this exception if 
 * a file is not found 
 *
 * @package models
 * @subpackage Exception
 */
class Model_Exception_FileNotFound extends Exception {

	/**
	 * filename of the file which is not found 
	 * @var string
	 */
	protected $fileName = null;


	/**
	 * constructor
	 * 
	 * @author Martin Kapfhammer
	 * @param string $fileName
	 */
	public function __construct($fileName) {
		$this->fileName = $fileName;
	}

	
	/**
	 * Getter for the filename
	 *
	 * @author Martin Kapfhammer
	 * @return $fileName
	 */
	public function getFileName() {
		return $this->fileName;
	}
}
