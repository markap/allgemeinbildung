<?php

class GamelistController extends Zend_Controller_Action
{

	protected $gameListDb = null;

    public function init()
    {
		//TODO try catch
        $this->gameListDb = new Model_DbTable_GameList();
    }

    public function indexAction()
    {
      	$this->view->gameList = $this->gameListDb->getGames();
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


}



