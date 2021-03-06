<?php

/**
 * util object
 * provides some util methods 
 *
 * @package models
 */
class Model_Util {

	public static function randomFloat($min, $max) {
   		return ($min+lcg_value()*(abs($max-$min)));
	}

	public static function shuffle($params) {
		$params = $params;
		shuffle($params);
		return $params;
	}
}
