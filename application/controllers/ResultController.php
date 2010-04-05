<?php

class ResultController extends Zend_Controller_Action
{

    protected $userId = null;

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
		echo "index";
    }

    public function questionsAction()
    {
		$resultKey = strtoupper($this->_getParam('result'));
		if (!in_array($resultKey, array('Y', 'N'))) {
			$this->_redirect('/result');
		}

		$result = $this->resultDb->getDistinctResult($resultKey);
		$questionIds = $this->resultDb->getResultForGame($resultKey);
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;

    }


}







