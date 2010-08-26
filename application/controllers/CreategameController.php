<?php

class CreategameController extends Zend_Controller_Action
{

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

    }

	protected function isManager() {
		return ($this->userSession->user['role'] === 'manager');
	}

    public function indexAction()
    {
        $questionDb = new Model_DbTable_Question();
		$questions  = $questionDb->getCreatedQuestions(6, 'N');
		$this->view->questions = $questions;

		$questionIds = array();
		foreach ($questions as $question) {
			$questionIds[] = $question['questionid'];
		}

		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;
		$nextGameSession->redirect = '/creategame';
    }

    public function saveaddingAction()
    {
        Model_ControllerDeprecated::redirectToIndex($this);
    }

    public function savegameAction()
    {
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$questionIds 	 = $nextGameSession->nextGame;

		$hasCategoryDb = new Model_DbTable_HasCategory();
		
		$categoryIds = array();
		foreach ($questionIds as $id) {
			$categoryIds = array_merge($categoryIds, $hasCategoryDb->getCategoryIds($id));
		}

		$categoryIds = array_unique($categoryIds);
		$categoryDb  = new Model_DbTable_Category();		
		$categories   = array();
		foreach ($categoryIds as $id) {
			$category 	  = $categoryDb->getCategory($id);	
			$categories[] = $category['name'];
		}

		$this->view->categories = $categories;
		$this->view->form 		= new Form_TextField();


		$request = $this->getRequest();
		if ($request->isPost()) {
			$gameName = $request->getPost('textfield');
			if (!empty($gameName)) {
				$questionIdString 	= implode(',', $questionIds);
				$gameListDb 		= new Model_DbTable_GameList();
				$gameCategoryDb		= new Model_DbTable_GameCategoryRelation();
				$questionDb			= new Model_DbTable_Question();
				$gameId = $gameListDb->insertGame($gameName, $questionIdString);
				$gameCategoryDb->insertRelation($gameId, $categoryIds);
				foreach ($questionIds as $id) {
					$questionDb->setActive($id);
				}
				$this->_redirect('/gamelist');
			} else {
				$this->view->error = 'Bitte Name eingeben';
			}
		}
    }

	


}





