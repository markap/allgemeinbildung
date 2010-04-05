<?php

class ResultController extends Zend_Controller_Action
{

    protected $userId = null;

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
        echo "index";
    }

    public function questionsAction()
    {
        $resultKey = strtoupper($this->_getParam('result'));
		if (!in_array($resultKey, array('Y', 'N'))) {
			$this->_redirect('/result');
		}
		$this->view->resultKey = $resultKey;

		$this->view->count = $this->resultDb->countQuestions($resultKey);
		$result = $this->resultDb->getDistinctResult($resultKey);
		$questionIds = $this->resultDb->getResultForGame($resultKey);

		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->nextGame = $questionIds;

		$questionView = array();
		foreach ($questionIds as $questionId) {
			$question = Model_QuestionFactory::getRandomQuestion($questionId);
			$questionView[] = array(
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

    public function categoryAction()
    {
        $resultKey = strtoupper($this->_getParam('result'));
		if (!in_array($resultKey, array('Y', 'N'))) {
			$this->_redirect('/result');
		}
		$this->view->resultKey = $resultKey;

		$categoryDb = new Model_DbTable_Category();

		$categories = $categoryDb->getCategories();
		foreach ($categories as $key => $category) {
			$categoryView[] = array('key'   => $key,
									'name'  => $category,
									'count' => $this->resultDb->countQuestionsByCategory($key, $resultKey)
									);	
		}
		$this->view->categories = $categoryView; 


		if ($this->getRequest()->has('cat')) {
			$questionIds = $this->resultDb->getQuestionIds($this->_getParam('cat'), $resultKey);

			$questionView = array();
			foreach ($questionIds as $questionId) {
				$question = Model_QuestionFactory::getRandomQuestion($questionId);
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

    public function timelineAction()
    {    
		$resultKey = strtoupper($this->_getParam('result'));
		if (!in_array($resultKey, array('Y', 'N'))) {
			$this->_redirect('/result');
		}
		$this->view->resultKey = $resultKey;

		echo "timeline";
    }

}

