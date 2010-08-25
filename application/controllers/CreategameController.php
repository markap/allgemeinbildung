<?php

class CreategameController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
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
			// abspeicher	
			// redirect
			} else {
				$this->view->error = 'Bitte Name eingeben';
			}
		}
    }

	


}





