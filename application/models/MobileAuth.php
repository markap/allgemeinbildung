<?php

/**
 *
 * @package models
 */
class Model_MobileAuth {

	public static function authentificate($auth) {
		return ($auth === md5('abmobile!123') ? true : false);
	}
}
