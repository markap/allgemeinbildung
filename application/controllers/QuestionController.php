<?php

/**
 * @package controller
 */
class QuestionController extends Zend_Controller_Action
{

    protected $questionSession = null;

    public function init()
    {
        $this->questionSession = new Zend_Session_Namespace('question');
    }

    public function indexAction()
    {
        $questionDb = new Model_DbTable_Question();

		$this->view->countQuestion = $questionDb->countQuestions();
		//var_dump($questionDb->getDates());
		$questionIds = $questionDb->getQuestionIds();
		$sortDate = true;
		if ($this->_getParam('mode') !== 'd') {
			shuffle($questionIds);
			$sortDate = false;
		}
		$this->view->sortDate = $sortDate;


		$questionView = array();
		foreach ($questionIds as $questionId) {
			$question = new Model_Question($questionId);
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

    }

    public function playAction()
    {
        $questionId = ($this->_getParam('question')) ? $this->_getParam('question') : -1;
		$this->questionSession->backLink = $this->_getParam('back');
		try {
			$question   = new Model_Question($questionId);
			$this->view->question 	= $question->getQuestion();
			$this->view->answers  	= $question->getAnswers();
			$this->view->categories = $question->getCategories();
			$this->questionSession->questionObject = $question;
		}
		catch (Model_Exception_QuestionNotFound $e) {
			$this->view->pageNotFound = true;
			$this->view->errorId	  = $e->getId();
			$this->view->className	  = $e->getClassName();
		}
    }

    public function questionrequestAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
        
			$backLink = ($this->questionSession->backLink !== null) 
						 ? $this->questionSession->backLink 
						 : '/question';
			$this->view->backLink = str_replace('_', '/', $backLink);
			$this->_helper->layout->disableLayout();
			$selectedAnswerHash = $this->_getParam('answer');	
			$question = $this->questionSession->questionObject;
			$this->view->isAnswerRight = $question->checkAnswer($selectedAnswerHash);

			$this->view->myAnswer = $question->getAnswer($selectedAnswerHash);
			$this->view->rightAnswer = $question->getRightAnswer(); 

		} else {
			$this->_redirect('/question');
		}
    }

    public function categoryAction()
    {
       	$categoryDb = new Model_DbTable_Category();
		$hasCategoryDb = new Model_DbTable_HasCategory();

		$categories = $categoryDb->getCategories();
		foreach ($categories as $key => $category) {
			$categoryView[] = array('key' => $key,
									'name' => $category,
									'count' => $hasCategoryDb->countQuestions($key)
									);	
		}
		$this->view->categories = $categoryView; 

		if ($this->getRequest()->has('cat')) {
			$questionIds = $hasCategoryDb->getQuestionIds($this->_getParam('cat'));

			$questionView = array();
			foreach ($questionIds as $questionId) {
				$question = new Model_Question($questionId);
				$questionView [] = array(
					'question' 	 => $question->getQuestion(),
					'answers' 	 => $question->getAnswers(),
					'categories' => $question->getCategories(),
					'backUrl'	 => str_replace('/', '_', getenv('REQUEST_URI'))
				);
			}
			$this->view->param = true;

			//pagination
			$page = $this->_getParam('page', 1);
			$paginator = Zend_Paginator::factory($questionView);
			$paginator->setItemCountPerPage(10);
			$paginator->setCurrentPageNumber($page);
			$this->view->paginator = $paginator;
		}
    }


}


