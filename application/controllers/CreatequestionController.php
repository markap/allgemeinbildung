<?php

class CreatequestionController extends Zend_Controller_Action
{

    protected $userId = null;

    public function init()
    {
        $userSession 	   = new Zend_Session_Namespace('user');
		$this->userId	   = isset($userSession->user['userid']) ? $userSession->user['userid'] : null;
    }

    public function indexAction()
    {
        // TODO show hints for every question
		$form = new Form_CreateQuestion();

		$categoryDb = new Model_DbTable_Category();
		$categorySelect = $form->getElement('category');
		$categorySelect->setMultiOptions($categoryDb->getCategories());

		$levelDb = new Model_DbTable_Level();
		$levelSelect = $form->getElement('level');
		$levelSelect->setMultiOptions($levelDb->getLevels());

		// handle request
		$request = $this->getRequest();
		if ($request->isPost()) {
			$postValues = $request->getPost();
			//TODO gscheite validierung
			if (/**Model_ValidateFormular::notEmpty($postValues) === true 
				&& */$form->getElement('image')->receive()) {

				$pathName = $form->getElement('image')->getFileName();
				if (!empty($pathName)) { 	// image upload
					$fileName  = substr($pathName, strrpos($pathName, '/') + 1);
					$fileExt = substr($fileName, strrpos($fileName, '.') + 1);
					$newImageName = Model_DbTable_Helper::getInstance()->getImageNumber();
					rename(APPLICATION_PATH . '/../public/img/' . $fileName, 
							APPLICATION_PATH . '/../public/img/' . $newImageName . '.' . $fileExt);
					$fileName = $newImageName . '.' . $fileExt;
				} else if ($postValues['imageText']) {
					$fileName = $postValues['imageText'];
				} else {
					// TODO default image
					$fileName = 'default';
				}
				$answerDb = new Model_DbTable_Answer();
				$questionDb = new Model_DbTable_Question();
				$hasCategoryDb = new Model_DbTable_HasCategory();
				$answerId = $answerDb->getNextAnswerId();
				$questionId = $questionDb->insertQuestion($postValues, $answerId, $fileName, $this->userId);
				$answerDb->insertAnswer($postValues, $answerId);
				$hasCategoryDb->insertRelation($questionId, $postValues['category']);
				$this->_redirect('/createquestion/result/question/' . $questionId);
			} 
		}
		$this->view->form = $form;
    }

    public function resultAction()
    {
        $questionId = $this->_getParam('question');
        //todo DARF NUR AUTOR ODER admin
        //TODO chekc ob questionid ist veränderbar
                
		$questionIds = array(array('id' => $questionId, 'type' => 'mc'),
							 array('id' => $questionId, 'type' => 'txt')
							);
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;

		echo "super gemacht...";
		echo "<a href='/game/index/play/".md5('nextgame!')."/test/".md5('testgame!')."'>testen</a>";
		echo "ändern";
		echo "weitere frage anlegen";
    }

    public function editquestionAction()
    {
        $this->_getParam('question');
		// TODO checken ob frage überhaupt editiert werden darf ...
		//todo DARF NUR AUTOR ODER ERSTELLER
		// populate form von oben ..
	}

    public function showimagesAction()
    {
		if ($this->getRequest()->isXmlHttpRequest()) {
			$this->_helper->layout->disableLayout();
			$searchTerm = $this->_getParam('name');
			$questionDb = new Model_DbTable_Question();
			$this->view->images = $questionDb->findImages($searchTerm);
		} else {
			$this->_redirect('/createquestion');
		}
    }


}







