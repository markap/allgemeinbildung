<?php

class NextController extends Zend_Controller_Action
{

    protected $userId   = null;
    protected $resultDb = null;

    public function init()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect('/index/login');
		}

		$userSession = new Zend_Session_Namespace('user');
		$this->userId	   = isset($userSession->user['userid']) 
								? $userSession->user['userid'] : null;
		$this->resultDb = new Model_DbTable_GameResult();
    }

    public function indexAction()
    {
    }

    public function showAction()
    {
        $qtype 	= $this->_getParam('qt', 'mc');
		$type 	= $this->_getParam('t', 'PN');

		$result = $this->resultDb->getGamesByType($this->userId, $type, $qtype);
		
		if ($result) {
			$helper = new Model_ControllerHelper();
			$this->view->next = $helper->createNextList($helper->removeDoubleResults($result)); 
		} else {
			$this->view->message = "Keine Daten vorhanden";
		}
    }

    public function noplayAction()
    {
		$result = $this->resultDb->getUnplayedGames($this->userId);
		$helper = new Model_ControllerHelper();
		$this->view->userId 	= $this->userId;
		$this->view->gameList 	= $helper->createGameList($result, $this->userId);
    }


}





