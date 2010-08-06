<?php

class GamelistController extends Zend_Controller_Action
{

    protected $gameListDb 	= null;
    protected $gameResultDb = null;
    protected $userId 		= null;

    public function init()
    {
        //TODO try catch
		$this->gameListDb   = new Model_DbTable_GameList();
		$this->gameResultDb = new Model_DbTable_GameResult();
		$userSession 	    = new Zend_Session_Namespace('user');
		$this->userId	    = isset($userSession->user['userid']) 
								? $userSession->user['userid'] : null;
    }

    public function indexAction()
    {
        $gameList = $this->gameListDb->getGames();
		$helper = new Model_ControllerHelper();
		$this->view->userId = $this->userId;
		$this->view->gameList = $helper->createGameList($gameList, $this->userId);
    }

    public function gameAction()
    {
        $gameId = $this->_getParam('g');
		$questionIds = $this->gameListDb->getQuestionIds($gameId);

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

    public function categoryAction()
    {
        $categoryDb = new Model_DbTable_Category();
		$this->view->categories = $categoryDb->getCategories();
}

    public function categoryresultAction()
    {
		$categoryIds 	= implode(',', $this->getRequest()->getPost('cat'));
		$gameCategoryDb = new Model_DbTable_GameCategoryRelation();
		$gameIds = $gameCategoryDb->getGameIds($categoryIds);
		foreach ($gameIds as $gameId) {
			$gameList[] = $this->gameListDb->getGame($gameId);			
		}
		$helper = new Model_ControllerHelper();
		$this->view->gameList = $helper->createGameList($gameList, $this->userId);	
			//TODO render gamelist/index-view instead of copy
		
    }


}

