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

	protected $child = null;
	protected $childNumber = 0;


	public function setNumbers($numberOne, $numberTwo) {
		$this->numberOne = $numberOne;
		$this->numberTwo = $numberTwo;
	}


	public function setChild(Model_Calculate_NumberPair $child) {
		$this->child = $child;
	}

	public function nextChild() {
		return $this->child;
	}

	public function hasChild() {
		return ($this->child !== null);
	}

	public function setChildNumber($childNumber) {
		$this->childNumber = $childNumber;
	}

	public function getChildNumber() {
		return $this->childNumber;
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
		$result = $this->calculate($this->numberOne, $this->numberTwo, $this->operator);
		$pair 	= $this;
		while ($pair->hasChild()) {
			$pair 	= $pair->nextChild();
			$result = $this->calculate($result, $pair->numberTwo, $pair->operator);
		}
		return $result;
	}

	protected function calculate($numberOne, $numberTwo, $operation) {
		$result = 0;
		switch ($operation) {
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
