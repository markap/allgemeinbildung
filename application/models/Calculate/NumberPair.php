<?php

/**
 * class for store values pairs
 *
 * @package models/Calculate
 */
class Model_Calculate_NumberPair {

	protected $numberOne;
	protected $numberTwo;
	protected $operator;
	protected $displayOperator;

	public function setNumbers($numberOne, $numberTwo) {
		$this->numberOne = $numberOne;
		$this->numberTwo = $numberTwo;
	}


	public function setOperators($operator, $displayOperator) {
		$this->operator 		= $operator;
		$this->displayOperator 	= $displayOperator;
	}

	
	public function getNumberOne() {
		return $this->numberOne;
	}


	public function getNumberTwo() {
		return $this->numberTwo;
	}


	public function getOperator() {
		return $this->operator;
	}


	public function getDisplayOperator() {
		return $this->displayOperator;
	}


	public function getResult() {
		$result = 0;
		switch ($this->operator) {
			case '+':
				$result = $this->numberOne + $this->numberTwo;	
			break;
			case '-':
				$result = $this->numberOne - $this->numberTwo;	
			break;
			case '*':
				$result = $this->numberOne * $this->numberTwo;	
			break;
			case '/':
				$result = $this->numberOne / $this->numberTwo;	
			break;
		}
		return $result;
	}

}
