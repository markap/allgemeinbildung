<?php

/**
 * text object
 * provides some strings
 *
 * @package models
 */
class Model_Text {

	public static function get($key) {
		$text = array(
				'mc'  => 'Multiple Choice',
				'txt' => 'Direkteingabe'
				);
		return $text[$key];

	}
}
