<?php

class GenerategameController extends Zend_Controller_Action
{

    protected $questionIds 	= null;

	protected $userSession 	= null;
    protected $userId 		= null;

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

		$gameListDb  		= new Model_DbTable_GameList();
		$this->questionIds	= $gameListDb->getQuestionIds(11);
    }

    public function indexAction()
    {
//$s = array('167.jpg', '164.jpg', '163.jpg', '162.jpg');
//$t = new Model_GeneratorMapping_ImageMerge($s);
//$t->merge();

    }

    public function showAction()
    {
        // action body
 		$this->view->questions = array();
        foreach ($this->questionIds as $id) {
        	$mapping  = new Model_GeneratorMapping_BundespraesiParteiQuestionMapping($id, $this->userId);
            $this->view->questions[] = $mapping->map()->getValues();
		}

    }

    public function saveAction()
    {
        // action body
		$this->view->questions = array();
        foreach ($this->questionIds as $id) {
        	$mapping  = new Model_GeneratorMapping_BundespraesiParteiQuestionMapping($id, $this->userId);
            $mapping->map()->save();
		}

    }


	protected function isManager() {
		return ($this->userSession->user['role'] === 'manager');
	}
}





