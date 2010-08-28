<?php

/**
 * defines the level - difficulty rules
 * for calculation
 *
 * @package models/Rules
 */
class Model_Calculate_Rules {

	protected static $rule = array(1 => array('+' => array('numbers' => array(array(2,100), array(2,10), array(2,10), array(3,10)), 'rules' => array('operation' => 2)),
									   		  '-' => array('numbers' => array(array(2,100), array(2,10)), 'rules' => array('negative' => false)),
									   		  '*' => array('numbers' => array(array(2,10), array(2,10)), 'rules' => array()),
									   		  '/' => array('numbers' => array(array(2,10), array(2,10)), 'rules' => array('divide-rest' => false)),
											  'op' => 1 
											),
								   2 => array('+' => array('numbers' => array(array(10,100), array(10,100)), 'rules' => array()),
									   		  '-' => array('numbers' => array(array(10, 500), array(10,100)), 'rules' => array('negative' => false)),
									   		  '*' => array('numbers' => array(array(2,30), array(2,10)), 'rules' => array()),
									   		  '/' => array('numbers' => array(array(2,30), array(2,10)), 'rules' => array('divide-rest' => false))
									),
								   3 => array('+' => array('numbers' => array(array(10,100), array(10,100)), 'rules' => array('float' => 1)),
									   		  '-' => array('numbers' => array(array(1, 10), array(10,100)), 'rules' => array('negative' => false)),
									   		  '*' => array('numbers' => array(array(2,30), array(2,10)), 'rules' => array()),
									   		  '/' => array('numbers' => array(array(2,30), array(2,10)), 'rules' => array('divide-rest' => false))
									),
								   4 => array('+' => array('numbers' => array(array(10,100), array(10,100), array(1,10)), 'rules' => array('operation' => 2)),
									   		  '-' => array('numbers' => array(array(1, 10), array(10,100)), 'rules' => array('negative' => false)),
									   		  '*' => array('numbers' => array(array(2,30), array(2,10)), 'rules' => array()),
									   		  '/' => array('numbers' => array(array(2,30), array(2,10)), 'rules' => array('divide-rest' => false))
									)	
							);


	public static function getRule($level, $operator) {
		return self::$rule[$level][$operator];
	}

	public static function getOperations($level) {
		return (isset(self::$rule[$level]['op'])) ? self::$rule[$level]['op'] : 0;
	}
}
