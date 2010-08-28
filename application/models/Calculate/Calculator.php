<?php

/**
 * @package models/Calculate
 */
class Model_Calculate_Calculator {


	public function createNumberPairs($level, $operation = '+', $count = 10) {

		$creator 	= new Model_Calculate_NumberCreator();

		for ($i = 0; $i < $count; $i++) {
			$pair = $creator->init($level, $operation);
			$numberPairs[] = $pair;	
		}

		return $numberPairs;
	}


}
