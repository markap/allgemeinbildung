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
		$result   = $this->resultDb->getResult('Y');
    }

    public function wrongquestionAction()
    {
		$result = $this->resultDb->getDistinctResult('N');
		var_dump($result);
		$questionIds = $this->resultDb->getResultForGame('N');
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;
		// get parameter an game url anhängen -> hash wert ...
		// dann aus session lesen
		// falls dieser parameter nich gesetzt ist, immer löschen der session
    }


}





