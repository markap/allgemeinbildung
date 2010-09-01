<?php

class CalculateController extends Zend_Controller_Action
{

    protected $session = null;
	protected $userId  = null;

    public function init()
    {   
		$userSession 	   = new Zend_Session_Namespace('user');
		$this->userId	   = isset($userSession->user['userid']) 
								? $userSession->user['userid'] : null;

        $this->session = new Zend_Session_Namespace('calculate');
    }

    public function indexAction()
    {
        $levelCount = Model_Calculate_Rules::getLevelCount();
		$levels 	= range(1, $levelCount);

		$displayLevels = array();
		$user		   = new Model_Calculate_UserManagement();
		foreach ($levels as $key => $level) {
			$allowed = $user->isAllowed($level);
			$divClass  = ($allowed) ? 'abled' : 'disabled';
			$linkStart = ($allowed) ? '<a href="/calculate/list/l/' . $level . '" class="calculate-link">' : '';
			$linkEnd   = ($allowed) ? '</a>' : '';
			$displayLevels[$key] = array(
									'name' 		=> $level,
									'divclass' 	=> $divClass,
									'linkstart' => $linkStart,
									'linkend'	=> $linkEnd
									);
		}
		$this->view->levels = $displayLevels;
    }

    public function resultAction()
    {
        $results 	 = $this->getRequest()->getPost();
		$minute		 = $results['minute'];
		$second		 = $results['second'];
		unset($results['minute']);
		unset($results['second']);

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
		}

		if ($this->userId !== null) {
			$completeTime = $second + $minute * 60;
			$data = array('time' 		=> $completeTime,
						  'level' 		=> $this->session->level,
						  'operation' 	=> $this->session->operation,
						  'right' 		=> $right
						);
			$result = $calculateResultDb->getResult($op, $level, $this->userId);	
			$calculateResultDb = new Model_DbTable_CalculateResult();
			$calculateResultDb->insertResult($data, $this->userId);
		}

echo "zeit :  : " .$minute . " : " . $second;
		echo "<br />richitg: ". $right;
		echo "<br/>falsch : ". $wrong;
    }

    public function calcAction()
    {
//TODO is allowed
        $level 	= $this->_getParam('l', 1);
		$op 	= $this->_getParam('op', 'plus');
		$cnt 	= $this->_getParam('cnt', 10);

		$calculator  = new Model_Calculate_Calculator();
		$numberPairs = $calculator->createNumberPairs($level, $op, $cnt);

		$this->session->numberPairs = $numberPairs;
		$this->session->level		= $level;
		$this->session->operation	= $op;

		$this->view->numberPairs 	= $numberPairs;
    }

    public function listAction()
    {
		$level = $this->_getParam('l', 1);
        $this->view->level = $level;
		
		$operators 			= array('plus', 'minus', 'multi', 'divide', 'all');
		$calculateResultDb 	= new Model_DbTable_CalculateResult();
		foreach ($operators as $op) {
			if ($this->userId !== null) {
				$result = $calculateResultDb->getResult($op, $level, $this->userId);	
			}
var_dump($result);
		}
    }


}







