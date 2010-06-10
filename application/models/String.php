<?php

/**
 * string object
 * provides some string helper methods 
 *
 * @package models
 */
class Model_String {


	/**
	 * explodes an string, and counts him 
	 *
	 * @author Martin Kapfhammer
	 * @param string 
	 * @return integer
	 */
	public static function countValues($string) {
		if ($string == '') {
			return 0;
		}
		$array = explode(',', $string);
		return count($array);
	}
}
