<?php

/**
 *
 * @package models/Calculate
 */
class Model_Calculate_NumberCreator {


	/**
	 * operators 
	 * @var array
	 */
	protected $operators 		= array('+', '-', '*', '/');
		
	/**
	 * display operators
	 * @var array
 	 */
	protected $displayOperators = array('+' => '+', '-' => '-', '*' => 'x', '/' => ':');

	/**
	 * operator for calculation
	 * @var string
	 */
	protected $operator = '+';

	public function init($level, $operator) {
		if ($operator === 'all') {
			$operator = $this->randomOperator();
		}
		$this->rule		= Model_Calculate_Rules::getRule($level, $operator);
		$this->operator = $operator;
		return $this;
	}


	public function create() {
		$numberPairs 	= $this->rule['numbers'];
		$rules			= $this->rule['rules'];

		$pair 		= new Model_Calculate_NumberPair();
		$numbers    = array($this->getNumber($numberPairs[0]),
							$this->getNumber($numberPairs[1]));

		if (isset($rules['negative']) && $rules['negative'] === false) {
			rsort($numbers);	
		}

		if (isset($rules['divide-rest']) && $rules['divide-rest'] === false) {
			$numbers = $this->createDivideNumberPairs($numbers);
		}
		
		$pair->setNumbers($numbers[0], $numbers[1]);
		$pair->setOperators($this->operator,
							$this->displayOperators[$this->operator]);
		return $pair;
	}


	protected function randomOperator() {
		$key = rand(0,3);
		return $this->operators[$key];
	}


	protected function getNumber(array $numberPair) {
		return rand($numberPair[0], $numberPair[1]);
	}

	public function createDivideNumberPairs(array $numbers) {
		$result = $numbers[0] * $numbers[1];
		return array($result, $numbers[0]);
	}
}
