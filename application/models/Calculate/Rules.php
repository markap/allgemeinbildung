<?php

/**
 * defines the level - difficulty rules
 * for calculation
 *
 * @package models/Rules
 */
class Model_Calculate_Rules {

	const LEVELS = 4;

	protected static $rule = array(1 => array('+' => array('numbers' 	=> array(array(2,30), array(2,20)), 
														   'rules' 		=> array(),
														   'next'		=> array('right' => 20, 'time' => 80)),
									   		  '-' => array('numbers' 	=> array(array(2,30), array(2,20)),
														   'rules' 		=> array('negative' => false),
														   'next'		=> array('right' => 20, 'time' => 80)),
									   		  '*' => array('numbers' 	=> array(array(2,5), array(2,5)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 80)),
									   		  '/' => array('numbers' 	=> array(array(2,5), array(2,5)), 
														   'rules' 		=> array('divide-rest' => false),
														   'next' 		=> array('right' => 20, 'time' => 80)),
											  'all' => array('next' 	=> array('right' => 20, 'time' => 80)),
											  'free' => true
											),
								   2 => array('+' => array('numbers' 	=> array(array(2,50), array(2,50)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 100)),
									   		  '-' => array('numbers' 	=> array(array(2, 50), array(2,30)), 
														   'rules' 		=> array('negative' => false),
														   'next' 		=> array('right' => 20, 'time' => 70)),
									   		  '*' => array('numbers' 	=> array(array(2,10), array(2,10)), 
														   'rules'	 	=> array(),
														   'next' 		=> array('right' => 20, 'time' => 70)),
									  		  '/' => array('numbers' 	=> array(array(2,10), array(2,10)), 
														   'rules' 		=> array('divide-rest' => false),
														   'next' 		=> array('right' => 20, 'time' => 70)),
											  'all' => array('next' 	=> array('right' => 20, 'time' => 90)),
									),
								   3 => array('+' => array('numbers' 	=> array(array(2,100), array(2,100)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 120)),
									   		  '-' => array('numbers' 	=> array(array(2, 100), array(2,90)), 
														   'rules' 		=> array('negative' => false),
														   'next' 		=> array('right' => 20, 'time' => 100)),
									   		  '*' => array('numbers' 	=> array(array(4,9), array(4,9)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 100)),
									   		  '/' => array('numbers' 	=> array(array(2,30), array(2,10)), 
														   'rules' 		=> array('divide-rest' => false),
														   'next' 		=> array('right' => 20, 'time' => 100)),
											  'all' => array('next' 	=> array('right' => 20, 'time' => 110)),
									),
								   4 => array('+' => array('numbers' 	=> array(array(50,100), array(50,100)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 160)),
									   		  '-' => array('numbers' 	=> array(array(50, 100), array(50,90)), 
														   'rules' 		=> array('negative' => false),
														   'next' 		=> array('right' => 20, 'time' => 160)),
									   		  '*' => array('numbers' 	=> array(array(4,15), array(3,9)), 
														   'rules' 		=> array(),
														   'next' 		=> array('right' => 20, 'time' => 160)),
									   		  '/' => array('numbers' 	=> array(array(2,30), array(2,10)), 
														   'rules' 		=> array('divide-rest' => false),
														   'next'		=> array('right' => 20, 'time' => 160)),
											  'all' => array('next' 	=> array('right' => 20, 'time' => 110))
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
