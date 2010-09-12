<?php

class GenerategameController extends Zend_Controller_Action
{

    protected $mapping = null;

    protected $userSession = null;

    protected $userId = null;

    public function init()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect('/index/login');
		}

		$this->userSession = new Zend_Session_Namespace('user');
		$this->userId	   = isset($this->userSession->user['userid']) 
								? $this->userSession->user['userid'] : null;

		if (!$this->isManager()) {
			$this->_redirect('/index');
		}

		$gameListDb  	= new Model_DbTable_GameList();
		$questionIds	= array();
		//for ($i = 0; $i < 15; $i++) $questionIds[] = 18;
		$questionIds	= $gameListDb->getQuestionIds(25); 
		$this->mapping  = new Model_GeneratorMapping_FlaggenSuedAmerikaQuestionMapping($questionIds, $this->userId);
    }

    public function indexAction()
    {
    }

    public function showAction()
    {
        $this->view->questions 	= $this->mapping->runAndGetValues(); 
		$this->view->path		= $this->mapping->getImagePath(true);
    }

    public function saveAction()
    {
        $this->mapping->setTestCreation(false)->runAndSave();
    }

    protected function isManager()
    {
        return ($this->userSession->user['role'] === 'manager');
    }

    public function testAction()
    {
/**
		$gameListDb  	= new Model_DbTable_GameList();
		$questionIds	= $gameListDb->getQuestionIds(1);
		$mapping  = new Model_GeneratorMapping_Bundesland4ImageQuestionMapping($questionIds, $this->userId);
		$this->view->questions = $mapping->runAndGetValues(); 
		**/
    }

    public function show2Action()
    {
		$gameListDb  	= new Model_DbTable_GameList();
		$questionIds	= $gameListDb->getQuestionIds(25); 
		$mapping  = new Model_GeneratorMapping_SuedAmerikaCapitalQuestionMapping($questionIds, $this->userId);
        $this->view->questions 	= $mapping->runAndGetValues(); 
		$this->view->path		= $mapping->getImagePath(true);
    }

    public function save2Action()
    {
		$gameListDb  	= new Model_DbTable_GameList();
		$questionIds	= $gameListDb->getQuestionIds(25); 
		$mapping  = new Model_GeneratorMapping_SuedAmerikaCapitalQuestionMapping($questionIds, $this->userId);
        $mapping->setTestCreation(false)->runAndSave();
    }


}











