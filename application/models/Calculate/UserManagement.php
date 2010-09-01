<?php

/**
 * class for user management 
 *
 * @package models/Calculate
 */
class Model_Calculate_UserManagement {


	public function isAllowed($level) {
		return Model_Calculate_Rules::allowedToPlay($level);
	}
}
