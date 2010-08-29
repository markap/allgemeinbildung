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
	protected $operators = array('+', '-', '*', '/');
		
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

	protected $level = 1;

	/**
 	 * childs of the pair
	 * @var integer
	 */
	protected $childs;


	public function init($level, $operator) {
		$startChilds  = Model_Calculate_Rules::getOperations($level); 
		$this->childs = $startChilds;
		$this->operator = $operator;
		$this->level = $level;
		$pair = $this->create();
		$pair->setChildNumber($startChilds);
		return $pair;
	}


	public function create($hasParent = false) {

		$operator = $this->createOperator($hasParent);

		$rule			= Model_Calculate_Rules::getRule($this->level, $operator);
		$numberPairs 	= $rule['numbers'];
		$rules 			= $rule['rules'];

		$pair 		= new Model_Calculate_NumberPair();

		$numbers 	= $this->createNumberPairs($numberPairs, $rules);

		// rule negative
		if (isset($rules['negative']) && $rules['negative'] === false) {
			if ($hasParent === false) {		// do not sort if it is a child
				rsort($numbers);	
			}
		}

		// rule divide
		if (isset($rules['divide-rest']) && $rules['divide-rest'] === false) {
			$numbers = $this->createDivideNumberPairs($numbers);
		}

		
		$pair->setNumbers($numbers[0], $numbers[1]);
		$pair->setOperators($operator, $this->displayOperators[$operator]);

		
		if ($this->childs-- !== 0) {
			$child = $this->create(true);
			$pair->setChild($child);
		}	

		return $pair;
	}


	/**
	 *  create the numbers, either integer or floats
	 */
	protected function createNumberPairs(array $numberPairs, $rules) {
		if (isset($rules['float'])) {
			$precision  = $rules['float'];
			$numbers    = array($this->getFloatNumber($numberPairs[0], $precision),
								$this->getFloatNumber($numberPairs[1], $precision));
		} else {
			$numbers    = array($this->getNumber($numberPairs[0]),
								$this->getNumber($numberPairs[1]));
		}
		return $numbers;
	}


	protected function createOperator($hasParent) {
		if ($this->operator === 'all') {
			$operator = $this->randomOperator();
		} else {
			$operator = $this->operator;
		}
		if ($hasParent === true) {		// has parent? than dont allow dividing
			if ($operator === '/') $operator = '+';
		}
		return $operator;
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
