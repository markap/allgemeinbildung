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
		foreach ($gameList as $key => $game) {
			$gameList[$key]['numberOfQuestions'] =
				$this->gameListDb->countQuestionIds($game['gameid']);	
			$gameList[$key]['existResult'] = 
				($this->userId != null) ? $this->gameResultDb->existResultForGameAndUser($game['gameid'], $this->userId)
				: false;
			$hasCategoryDb = new Model_DbTable_HasCategory();
			$questionIds   = Model_String::explodeString($game['questionids']);
			$categoryIds   = array();
			foreach ($questionIds as $questionId) {
				$currentIds  = $hasCategoryDb->getCategoryIds($questionId);
				$categoryIds = array_merge($categoryIds, $currentIds);
			}
			$categoryIds = (array_unique($categoryIds));
			$categoryDb  = new Model_DbTable_Category();
			$categories  = array();
			foreach ($categoryIds as $categoryId) {
				$categories[] = $categoryDb->getCategory($categoryId);	
			}
			$gameList[$key]['cat'] = $categories;
		}
		$this->view->gameList = $gameList;
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
		var_dump($this->getRequest()->getPost('cat'));
    }


}


