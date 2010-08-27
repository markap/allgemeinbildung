<?php

class CalculateController extends Zend_Controller_Action
{
	protected $session = null;

    public function init()
    {
		$this->session = new Zend_Session_Namespace('calculate');
    }

    public function indexAction()
    {
        $calculator  = new Model_Calculate_Calculator();
        $numberPairs = $calculator->createNumberPairs(2, 'all');
		
		$this->session->numberPairs = $numberPairs;
        $this->view->numberPairs 	= $numberPairs;
    }

    public function resultAction()
    {
		$results 	 = $this->getRequest()->getPost();
		$numberPairs = $this->session->numberPairs;
		$right = 0;
		$wrong = 0;

		foreach ($results as $key => $result) {
			$numberPair = $numberPairs[$key];
			if ($numberPair->getResult() === (int)$result) {
				$right++;
			} else {
				$wrong++;
			}
			// auswertung, abspecihern, zeit
			// besserer mathe algorithmus
		}
echo "richitg: ". $right;
echo "<br/>falsch : ". $wrong;
    }


}



