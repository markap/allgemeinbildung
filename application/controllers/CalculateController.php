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
		$level = $this->_getParam('l', 1);
		$op = $this->_getParam('op', '+');
		if ($op === ':') $op = '/';
		$cnt = $this->_getParam('cnt', 10);

        $calculator  = new Model_Calculate_Calculator();
        $numberPairs = $calculator->createNumberPairs($level, $op, $cnt);

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



