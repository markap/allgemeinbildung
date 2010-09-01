<?php

/**
 * util for calculation 
 *
 * @package models/Util
 */
class Model_Calculate_Util {


	protected static $operator = array('plus' 	=> '+',
									   'minus' 	=> '-', 
									   'multi' 	=> '*', 
									   'divide' => '/');

	public static function operatorStringToSign($sign) {
		return self::$operator[$sign];
	}

	public static function getStringOperators() {
		return array('plus', 'minus', 'multi', 'divide', 'all');
	}
}
