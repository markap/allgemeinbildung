<?php

/**
 * defines the level - difficulty rules
 * for calculation
 *
 * @package models/Rules
 */
class Model_Calculate_Rules {

	const LEVELS = 4;

	protected static $rule = array(1 => array('+' => array('numbers' 	=> array(array(2,50), array(2,20)), 
														   'rules' 		=> array('operation' => 2),
														   'next'		=> array('right' => 1, 'time' => 120)),
									   		  '-' => array('numbers' 	=> array(array(2,50), array(2,20)),
														   'rules' 		=> array('negative' => false),
														   'next'		=> array('right' => 20, 'time' => 120)),
									   		  '*' => array('numbers' 	=> array(array(2,5), array(2,5)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 120)),
									   		  '/' => array('numbers' 	=> array(array(2,5), array(2,5)), 
														   'rules' 		=> array('divide-rest' => false),
														   'next' 		=> array('right' => 20, 'time' => 120)),
											  'free' => true
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
									));


	public static function getRule($level, $operator) {
		return self::$rule[$level][$operator];
	}

	public static function getOperations($level) {
		return (isset(self::$rule[$level]['op'])) ? self::$rule[$level]['op'] : 0;
	}

	public static function getLevelCount() {
		return self::LEVELS; 
	}

	public static function allowedToPlay($level) {
		$level = self::$rule[$level];
		return (isset($level['free'])) ? $level['free'] : false;	
	}

	public static function readyForNext($level, $operation, array $data) {
		$next = self::$rule[$level][$operation]['next'];
		return ($next['right'] <= $data['right'] && $next['time'] >= $data['time']) ? true : false;
	}
}
