<?php

/**
 * Validation Class
 * Are all required fields filled?
 * @package Validation
 */
class Model_ValidateFormular {

	/**
     * checks  if everything is filled
	 * @author Martin Kapfhammer
	 * @static
 	 * @param array $data
	 * @return boolean
	 */
	static public function notEmpty(array $data) {
		$notEmpty = true;
		foreach ($data as $id => $value) {
			if ((is_numeric($value) && !isset($value)) || (!is_numeric($value) && !$value)) {
				$notEmpty = false;
				break;
			}
		}
		return $notEmpty;
	}
} 
 
