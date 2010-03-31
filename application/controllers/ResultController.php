<?php

class ResultController extends Zend_Controller_Action
{

    protected $userId   = null;
	
	protected $resultDb = null;

    public function init()
    {
        //TODO must be logged
		$userSession  = new Zend_Session_Namespace('user');
		$userData     = $userSession->user;
		$this->userId = $userData['userid'];
        $this->resultDb = new Model_DbTable_QuestionResult($this->userId);
    }

    public function indexAction()
    {
    }

    public function rightquestionAction()
    {
		$resultKey = 'Y';	
		$result = $this->resultDb->getDistinctResult($resultKey);
		var_dump($result);
		$questionIds = $this->resultDb->getResultForGame($resultKey);
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;
    }

    public function wrongquestionAction()
    {
		$resultKey = 'N';	
		$result = $this->resultDb->getDistinctResult($resultKey);
		var_dump($result);
		$questionIds = $this->resultDb->getResultForGame($resultKey);
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;
    }


}





