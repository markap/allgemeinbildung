<?php			

/**
 * Interface for validation
 * @package models
 */
interface Model_ValidatorInterface {

	public function isValid();
	public function getErrors();
}
