<?php

class ResultController extends Zend_Controller_Action
{

    protected $userId 		= null;
    protected $resultDb 	= null;
    protected $gameResultDb = null;
    protected $gameListDb   = null;

    public function init()
    {
		if (!Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect('/index');
		}
		$userSession  = new Zend_Session_Namespace('user');
		$userData     = $userSession->user;
		$this->userId = $userData['userid'];
		$this->resultDb = new Model_DbTable_QuestionResult($this->userId);
		$this->gameResultDb = new Model_DbTable_GameResult();
		$this->gameListDb   = new Model_DbTable_GameList();
    }

    public function indexAction()
    {
		Model_ControllerDeprecated::redirectToIndex($this);
    }

    public function questionsAction()
    {
		Model_ControllerDeprecated::redirectToIndex($this);
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
		Model_ControllerDeprecated::redirectToIndex($this);
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
		Model_ControllerDeprecated::redirectToIndex($this);
        $resultKey = strtoupper($this->_getParam('result'));
		if (!in_array($resultKey, array('Y', 'N'))) {
			$this->_redirect('/result');
		}
		$this->view->resultKey = $resultKey;

		echo "timeline";
    }

    public function gamesAction()
    {
		$gameResult = $this->gameResultDb->getGameResult($this->userId);
		foreach ($gameResult as $result) {
			$gameIds[] = $result['gameid'];
		}
		if (isset($gameIds)) {
			$gameIds = array_unique($gameIds);
			foreach ($gameIds as $gameId) {
				$gameList[] = $this->gameListDb->getGame($gameId);			
			}
			$helper = new Model_ControllerHelper();
			$this->view->gameList = $helper->createGameList($gameList, $this->userId);				//TODO render gamelist/index-view instead of copy
		}
    }

    public function gameAction()
    {
		// user muss angemeldet sein!!!
		$gameId = $this->_getParam('gid', -1);
		$results = $this->gameResultDb->getResultForGameAndUser($gameId, $this->userId);
		if (empty($results)) {
			$this->_redirect('/gamelist');
		}

		$gameDescription = $this->gameListDb->getGame($gameId);
		$this->view->gameName = $gameDescription['name'];
        $categoryDb = new Model_DbTable_GameCategoryRelation();
		foreach ($results as $key => $result) {
			$results[$key]['right'] = Model_String::countValues($result['rightids']);	
			$results[$key]['wrong'] = Model_String::countValues($result['wrongids']);	
			$results[$key]['sum']   = $results[$key]['right'] + $results[$key]['wrong'];
            $results[$key]['cat'] = $categoryDb->getCategories($result['gameid']);;
		}
		$this->view->results = $results;
		$this->view->gameId  = $gameId;
		$this->view->lastResult = $results[0];
    }


}


