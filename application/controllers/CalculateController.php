<?php

class CalculateController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

		$calculator  = new Model_Calculate_Calculator();
		$numberPairs = $calculator->createNumberPairs();
		$this->view->numberPairs = $numberPairs;
    }


}

