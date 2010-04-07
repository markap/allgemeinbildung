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
	
				$fileName = $this->getFileName($form);

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
        $questionId = ($this->_getParam('question')) ? $this->_getParam('question') : -1;
		// TODO checken ob frage überhaupt editiert werden darf ...
		//todo DARF NUR AUTOR ODER ERSTELLER
		// populate form von oben ..

		$form = new Form_CreateQuestion();

		$categoryDb = new Model_DbTable_Category();
		$categorySelect = $form->getElement('category');
		$categorySelect->setMultiOptions($categoryDb->getCategories());

		$levelDb = new Model_DbTable_Level();
		$levelSelect = $form->getElement('level');
		$levelSelect->setMultiOptions($levelDb->getLevels());

        $change = new Zend_Form_Element_Submit('Änderung Speichern');
        $change->setAttrib('id', 'changebutton');
		$form->addElement($change);


		// populate formular
		$questionDb 	  = new Model_DbTable_Question();
		$answerDb 		  = new Model_DbTable_Answer();
		$hasCategoryDb 	  = new Model_DbTable_HasCategory();
		$levelDb		  = new Model_DbTable_Level();
		$question   	  = $questionDb->getQuestion($questionId);
		$level 			  = $levelDb->getLevel($question['level']);
		$question['level'] = $level['levelid'];
		$answers	  	   = $answerDb->getAnswer($question['answerid']);
		$categories 	   = $hasCategoryDb->getCategoryIds($questionId);
		$form->populate($question);
		$form->populate($answers);
		$form->populate(array('imageText'  => $question['image'],
							  'category'   => $categories 
						));

		// handle request
		$request = $this->getRequest();
		if ($request->isPost()) {
			$postValues = $request->getPost();
			//TODO gscheite validierung
			if (/**Model_ValidateFormular::notEmpty($postValues) === true 
				&& */$form->getElement('image')->receive()) {

				$fileName = $this->getFileName($form);

				// if neuanlage
					$answerId 	= $answerDb->getNextAnswerId();
					$questionId = $questionDb->insertQuestion($postValues, $answerId, 
														  $fileName, $this->userId);
					$answerDb->insertAnswer($postValues, $answerId);
					$hasCategoryDb->insertRelation($questionId, $postValues['category']);
				// if update
					$this->_redirect('/createquestion/result/question/' . $questionId);
			} 
		}
		$this->view->form = $form;
    }

    protected function getFileName(Zend_Form $form)
    {
        $postValues = $this->getRequest()->getPost();
		$pathName   = $form->getElement('image')->getFileName();
		if (!empty($pathName)) { 	// image upload
			$uploadedFileName  = substr($pathName, strrpos($pathName, '/') + 1);
			$fileExt   		   = substr($fileName, strrpos($fileName, '.') + 1);
			$newImageName  = Model_DbTable_Helper::getInstance()->getImageNumber();
			$directoryName = APPLICATION_PATH . '/../public/img/question/';
			$fileName = $newImageName . '.' . $fileExt;
			rename($directoryName . $uploadedFileName, 
				   $directoryName . $fileName);
		} else if ($postValues['imageText']) {
			$fileName = $postValues['imageText'];
		} else {
			// TODO default image
			$fileName = 'default.jpg';
		}
		return $filename;
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

    public function questionlistAction()
    {
        $questionDb  = new Model_DbTable_Question();
		$questionIds = $questionDb->getQuestionIds('N');

		if (!empty($questionIds)) {
			$questionView = array();
			foreach ($questionIds as $questionId) {
				$question = new Model_Question($questionId, true);
				$questionView [] = array(
					'question' 	 => $question->getQuestion(),
					'answers' 	 => $question->getAnswers(),
					'categories' => $question->getCategories(),
					'backUrl'	 => str_replace('/', '_', getenv('REQUEST_URI'))
				);
			}

			//pagination
			$page = $this->_getParam('page', 1);
			$paginator = Zend_Paginator::factory($questionView);
			$paginator->setItemCountPerPage(10);
			$paginator->setCurrentPageNumber($page);
			$this->view->paginator = $paginator;

		} else {
			$this->view->message = 'Keine Fragen vorhanden';
		}
    }

    public function setactiveAction()
    {
		if ($this->getRequest()->isXmlHttpRequest()) {
			$this->_helper->layout->disableLayout();
        	$questionId = $this->_getParam('question');
			$questionDb = new Model_DbTable_Question();
			$questionDb->setActive($questionId);

		} else {
			$this->_redirect('/createquestion');
		}
    }

}

