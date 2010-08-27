<?php

/**
 * defines the level - difficulty rules
 * for calculation
 *
 * @package models/Rules
 */
class Model_Calculate_Rules {

	protected static $rule = array(1 => array('+' => array('numbers' => array(array(1,100), array(1,10)), 'rules' => array()),
									   		  '-' => array('numbers' => array(array(1,100), array(1,10)), 'rules' => array('negative' => false)),
									   		  '*' => array('numbers' => array(array(1,10), array(1,10)), 'rules' => array()),
									   		  '/' => array('numbers' => array(array(1,10), array(1,10)), 'rules' => array('divide-rest' => false))
											),
								   2 => array('+' => array('numbers' => array(array(10,100), array(10,100)), 'rules' => array()),
									   		  '-' => array('numbers' => array(array(10, 500), array(10,100)), 'rules' => array('negative' => false)),
									   		  '*' => array('numbers' => array(array(1,30), array(1,10)), 'rules' => array()),
									   		  '/' => array('numbers' => array(array(1,30), array(1,10)), 'rules' => array('divide-rest' => false))
									)	   		  
							);


	public static function getRule($level, $operator) {
		return self::$rule[$level][$operator];
	}
}
