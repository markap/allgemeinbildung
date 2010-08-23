<?php

/**
 * @package models/Calculate
 */
class Model_Calculate_Calculator {

	protected $numberPairs = array();

	public function createNumberPairs() {
		$numberPair = array('minValue' => 3, 'maxValue' => 100);
		$util = new Model_Calculate_CalculatorUtil();
		for ($i = 0; $i < 10; $i++) {
			$pair = new Model_Calculate_NumberPair(); 
			$util->createOperator();

			$pair->operator 		= $util->getOperator();
			$pair->displayOperator 	= $util->getDisplayOperator();

			if ($pair->operator !== '/') {
				$pair->numberOne = $util->getNumber($numberPair);
				$pair->numberTwo = $util->getNumber($numberPair);
			} else {
				$util->createDivideNumberPairs($numberPair, $numberPair);
				$dividedNumberPairs = $util->getDividedNumberPairs();
				$pair->numberOne 	= $dividedNumberPairs[0];
				$pair->numberTwo 	= $dividedNumberPairs[1];
			}

			$this->numberPairs[] = $pair;	
		}

		return $this->numberPairs;
	}

}
