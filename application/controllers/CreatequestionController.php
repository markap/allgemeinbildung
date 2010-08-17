<?php

class CreatequestionController extends Zend_Controller_Action
{

    protected $userId 		 = null;
	protected $questionDb 	 = null;
	protected $answerDb 	 = null;
	protected $hasCategoryDb = null;
	protected $userSession	 = null;

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
		$this->questionDb  = new Model_DbTable_Question();
		$this->answerDb    = new Model_DbTable_Answer();
		$this->hasCategoryDb = new Model_DbTable_HasCategory();
    }

    public function indexAction()
    {
        // TODO show hints for every question
		$form = new Form_CreateQuestion();
		$this->setFormOptions($form);

		// handle request
		$request = $this->getRequest();
		if ($request->isPost()) {
			$postValues = $request->getPost();
			//TODO gscheite validierung
			if (/**Model_ValidateFormular::notEmpty($postValues) === true 
				&& */$form->getElement('image')->receive()) {
	
				$fileName = $this->getFileName($form);

				$answerId 	= $this->answerDb->getNextAnswerId();
				$questionId = $this->questionDb->insertQuestion($postValues, $answerId, $fileName, $this->userId);
				$this->answerDb->insertAnswer($postValues, $answerId);
				$this->hasCategoryDb->insertRelation($questionId, $postValues['category']);
				$this->_redirect('/createquestion/result/question/' . $questionId);
			} 
		}
		$this->view->form = $form;
    }

	protected function setFormOptions(Zend_Form $form) {
		$categoryDb = new Model_DbTable_Category();
		$categorySelect = $form->getElement('category');
		$categorySelect->setMultiOptions($categoryDb->getCategories());

		$levelDb = new Model_DbTable_Level();
		$levelSelect = $form->getElement('level');
		$levelSelect->setMultiOptions($levelDb->getLevels());
	}

    public function resultAction()
    {
        $questionId = ($this->_getParam('question')) ? $this->_getParam('question') : -1;

		if (!$this->allowEditByAuthor($questionId) && !$this->isManager()) {
			$this->_redirect('/createquestion');
		}
				
		$questionIds = array(array('id' => $questionId, 'type' => 'mc'),
							 array('id' => $questionId, 'type' => 'txt')
							);
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;

		$this->view->questionId = $questionId;
    }

	protected function allowEditByAuthor($questionId) {
		return ($this->isAuthor($questionId) && $this->isNotActiveQuestion($questionId));
	}

	protected function isAuthor($questionId) {
		return $this->questionDb->isAuthor($this->userId, $questionId);
	}

	protected function isNotActiveQuestion($questionId) {
		return $this->questionDb->isNotActive($questionId);
	}

	protected function isManager() {
		return ($this->userSession->user['role'] === 'manager');
	}

    public function editquestionAction()
    {
        $questionId = ($this->_getParam('question')) ? $this->_getParam('question') : -1;

		if (!$this->allowEditByAuthor($questionId) && !$this->isManager()) {
			$this->_redirect('/createquestion');
		}

		$form = new Form_CreateQuestion();
		$this->setFormOptions($form);
        $change = new Zend_Form_Element_Submit('changebutton');
        $change->setAttrib('id', 'changebutton')
			   ->setLabel('Änderung Speichern');
		$form->addElement($change);


		// populate formular
		try {
			$formInput = $this->getFormInput($questionId);
		} catch (Model_Exception_QuestionNotFound $e) {
			try { 	// question could be testquestion, so not active
				$formInput = $this->getFormInput($questionId, true);
			} catch (Model_Exception_QuestionNotFound $e) {
				$this->_redirect('/createquestion');
			}
		}
		$form->populate($formInput);

		// handle request
		$request = $this->getRequest();
		if ($request->isPost()) {
			$postValues = $request->getPost();
			//TODO gscheite validierung
			if (/**Model_ValidateFormular::notEmpty($postValues) === true 
				&& */$form->getElement('image')->receive()) {

				$fileName = $this->getFileName($form);

				if ($this->isNewQuestion()) {
					$answerId 	= $this->answerDb->getNextAnswerId();
					$questionId = $this->questionDb->insertQuestion($postValues, $answerId, 
														  $fileName, $this->userId);
					$this->answerDb->insertAnswer($postValues, $answerId);
					$this->hasCategoryDb->insertRelation($questionId, $postValues['category']);

				} else if ($this->isEditQuestion()) {
					$this->questionDb->updateQuestion($questionId, $postValues, $fileName);
					$answerId = $formInput['answerid'];
					$this->answerDb->updateAnswer($answerId, $postValues);
					$oldVals = $formInput['category'];
					$newVals = $postValues['category'];
					$this->hasCategoryDb->updateRelation($questionId, $oldVals, $newVals);
				}
				$this->_redirect('/createquestion/result/question/' . $questionId);
			} 
		}
		$this->view->form = $form;
    }

	protected function getFormInput($questionId, $testGame = false) {
		$levelDb = new Model_DbTable_Level();

		$question  		   = $this->questionDb->getQuestion($questionId, $testGame);
		$level 			   = $levelDb->getLevel($question['level']);
		$question['level'] = $level['levelid'];
		$answers	  	   = $this->answerDb->getAnswer($question['answerid']);
		$categories 	   = $this->hasCategoryDb->getCategoryIds($questionId);
		
		$formInput = array_merge($question, $answers, array('imageText'  => $question['image'],
							  								'category'   => $categories 
						));
		return $formInput;
	}

    protected function getFileName(Zend_Form $form) {
        $postValues = $this->getRequest()->getPost();
		$pathName   = $form->getElement('image')->getFileName();
		if (!empty($pathName)) { 	// image upload
			$uploadedFileName  = substr($pathName, strrpos($pathName, '/') + 1);
			$fileExt   		   = substr($uploadedFileName, strrpos($uploadedFileName, '.') + 1);
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
		return $fileName;
    }

	protected function isNewQuestion() {
		return ($this->getRequest()->getPost('submitbutton', false) !== false);
	}

	protected function isEditQuestion() {
		return ($this->getRequest()->getPost('changebutton', false) !== false);
	}

    public function showimagesAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
			$this->_helper->layout->disableLayout();
			$searchTerm = $this->_getParam('name');
			$this->view->images = $this->questionDb->findImages($searchTerm);
		} else {
			$this->_redirect('/createquestion');
		}
    }

    public function questionlistAction()
    {
// manager darf alle sehen, rest nur selbst angelegte
// aktivieren link darf nicht jeder sehen, nur manger
// testgame sollte laufen
		$questionIds = $this->questionDb->getQuestionIds('N');

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
        	$questionId = $this->_getParam('questionid', -1);
			$this->questionDb->setActive($questionId);

		} else {
			$this->_redirect('/createquestion');
		}
    }

}

