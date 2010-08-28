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

	/**
 	 * childs of the pair
	 * @var integer
	 */
	protected $childs;


	public function init($level, $operator) {
		$childs	= Model_Calculate_Rules::getOperations($level); 
		$this->childs = $childs;
		$pair = $this->create($level, $operator);
		$pair->setChildNumber($childs);
		return $pair;
	}


	public function create($level, $operator, $parent = false) {
$op = $operator;

		if ($operator === 'all') {
			$operator = $this->randomOperator();
		}
		$this->rule		= Model_Calculate_Rules::getRule($level, $operator);
		$this->operator = $operator;
		
		if ($parent === true) {		// has parent? than dont allow dividing
			if ($this->operator === '/') $this->operator = '+';
		}
		$numberPairs = $this->rule['numbers'];
		$rules = $this->rule['rules'];

		$pair = new Model_Calculate_NumberPair();

		if (isset($rules['float'])) {
			$precision  = $rules['float'];
			$numbers    = array($this->getFloatNumber($numberPairs[0], $precision),
								$this->getFloatNumber($numberPairs[1], $precision));
		} else {
			$numbers    = array($this->getNumber($numberPairs[0]),
								$this->getNumber($numberPairs[1]));
		}

		if (isset($rules['negative']) && $rules['negative'] === false) {
			if ($parent === null) {		// do not sort if it is a child
				rsort($numbers);	
			}
		}

		if (isset($rules['divide-rest']) && $rules['divide-rest'] === false) {
			$numbers = $this->createDivideNumberPairs($numbers);
		}

		
		$pair->setNumbers($numbers[0], $numbers[1]);
		$pair->setOperators($this->operator,
							$this->displayOperators[$this->operator]);

		
		if ($this->childs-- !== 0) {
			$child = $this->create($level, $op, true);
			$pair->setChild($child);
		}	

		return $pair;
	}


	protected function randomOperator() {
		$key = rand(0,3);
		return $this->operators[$key];
	}


	protected function getNumber(array $numberPair) {
		return rand($numberPair[0], $numberPair[1]);
	}

	protected function getFloatNumber(array $numberPair, $precision) {
		$floatNumber =  Model_Util::randomFloat($numberPair[0], $numberPair[1]);
		return round($floatNumber, $precision);
	}

	protected function createDivideNumberPairs(array $numbers) {
		$result = $numbers[0] * $numbers[1];
		return array($result, $numbers[0]);
	}
}
