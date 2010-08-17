<?php

/**
 * Helper for Controllers 
 * if controllers are deprecated
 *
 * @package models
 */
class Model_ControllerDeprecated {

	public static function redirectToIndex(Zend_Controller_Action $ctr) {
		$ctr->getHelper('redirector')->gotoUrl('/index', array());
	}
}
