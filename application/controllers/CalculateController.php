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
        $numberPairs = $calculator->createNumberPairs();
		
		$this->session->numberPairs = $numberPairs;
        $this->view->numberPairs 	= $numberPairs;
    }

    public function resultAction()
    {
		$results 	 = $this->getRequest()->getPost();
		$numberPairs = $this->session->numberPairs;

		foreach ($results as $key => $result) {
			$numberPair = $numberPairs[$key];
			// wenn gleich dann richtig, anders falsch
			// auswertung, abspecihern, zeit
			// besserer mathe algorithmus
		}
    }


}



