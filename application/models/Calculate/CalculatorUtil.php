<?php

/**
 *
 * @package models/Calculate
 */
class Model_Calculate_CalculatorUtil {

	protected $key;

	/**
	 * operators 
	 * @var array
	 */
	protected $operators 		= array('+', '-', '*', '/');
		
	/**
	 * display operators
	 * @var array
 	 */
	protected $displayOperators = array('+', '-', 'x', ':');

	protected $dividedNumberPairs;


	public function createOperator() {
		$this->randomOperatorKey();
	}

	protected function randomOperatorKey() {
		$this->key = rand(0,3);
	}

	public function getOperator() {
		return $this->operators[$this->key];
	}

	public function getDisplayOperator() {
		return $this->displayOperators[$this->key];
	}

	public function getNumber(array $numberPair) {
		return rand($numberPair['minValue'], $numberPair['maxValue']);
	}

	public function createDivideNumberPairs(array $numberPair1, array $numberPair2) {
		$firstNumber  = $this->getNumber($numberPair1);		
		$secondNumber = $this->getNumber($numberPair2);
		if ($this->hasRest($firstNumber, $secondNumber)) {
			$this->createDivideNumberPairs($numberPair1, $numberPair2);
		} else {
			$this->dividedNumberPairs = array($firstNumber, $secondNumber);
		}
	}

	public function getDividedNumberPairs() {
		return $this->dividedNumberPairs;
	}

	protected function hasRest($firstNumber, $secondNumber) {
		return (($firstNumber % $secondNumber) !== 0);
	}
}
