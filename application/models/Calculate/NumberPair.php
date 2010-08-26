<?php

/**
 * class for store values pairs
 *
 * @package models/Calculate
 */
class Model_Calculate_NumberPair {

	public $numberOne;
	public $numberTwo;
	public $operator;
	public $displayOperator;

	public function getResult() {
		$result = 0;
		switch ($operator) {
			case '+':
				$result = $numberOne + $numberTwo;	
			break;
			case '-':
				$result = $numberOne - $numberTwo;	
			break;
			case '*':
				$result = $numberOne * $numberTwo;	
			break;
			case '/':
				$result = $numberOne / $numberTwo;	
			break;
		}
		return $result;
	}

}
