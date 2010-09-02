<?php

/**
 * class for user management 
 *
 * @package models/Calculate
 */
class Model_Calculate_UserManagement {


	public function isAllowed($level, $userId) {
		$allowed =  Model_Calculate_Rules::allowedToPlay($level);
		if ($allowed) {
			return $allowed;
		}
		

		if ($userId !== null) {
				$operators 			= Model_Calculate_Util::getStringOperators();
				$calculateResultDb 	= new Model_DbTable_CalculateResult();
				$allowed			= true;
				$level				= $level -1;

				foreach ($operators as $op) {
					$result = $calculateResultDb->getResult($op, $level, $userId);	
					if ($result['next'] === 'N' || $result === false) {
						$allowed = false;
						break;
					}
				}
		}
		return $allowed;
	}
}
