<?php

class GameController extends Zend_Controller_Action
{

    protected $gameSession = null;
	protected $userId	   = null;

    public function init()
    {
        $this->gameSession = new Zend_Session_Namespace('game');
		$userSession 	   = new Zend_Session_Namespace('user');
		$this->userId	   = isset($userSession->user['userid']) ? $userSession->user['userid'] : null;
    }

    public function indexAction()
    {
		$questionIds = array(array('id' => 41, 'type' => 'mc'),
							 array('id' => 41, 'type' => 'txt'),
							 array('id' => 41, 'type' => 'mc'),
							3,4);

		// get game ids
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		if ($this->_getParam('play') === md5('nextgame!')
			|| $this->_getParam('play') === md5('testquestion!')) {
			if ($this->_getParam('play') === md5('testquestion!')) {
				$this->gameSession->redirect = '/createquestion/result/question/' . $nextGameSession->nextGame[0]['id'];
			}
			$this->gameSession->game = null;	
			$this->gameSession->waitForAnswer = false;
        	$nextGame = $nextGameSession->nextGame;
			if ($nextGame !== null) {
				$questionIds = $nextGame;	
			}
		} 
		$nextGameSession->nextGame = null;
		
		// get params without session ->nextGame
		if ($this->_getParam('play') === md5('playcat!')) {
			$this->gameSession->redirect = null;
			$this->gameSession->game = null;	
			$this->gameSession->waitForAnswer = false;
			$hasCategoryDb = new Model_DbTable_HasCategory();
			$questionIds = $hasCategoryDb->getQuestionIds($this->_getParam('cat'));
		}

		// redirect when game is over
		if ($this->gameSession->redirect === null) {
			$this->gameSession->redirect = '/game/result';
		}

		// use always the same game object
		if ($this->gameSession->game === null) {
			if ($this->_getParam('play') === md5('testquestion!')) {
				$this->gameSession->game = new Model_Game($questionIds, null, true);	
			} else {
				$this->gameSession->game = new Model_Game($questionIds, $this->userId);	
			}
		}
		$game = $this->gameSession->game; 
		
		// set QuestionType
		if ($this->getRequest()->has('qtyp')) {
			$game->setQuestionType($this->_getParam('qtyp'));
		}
		

		// refresh browser -> answer wrong
		if ($this->gameSession->waitForAnswer === true) {
			$game->getScore()->addWrongAnswer($game->getQuestion()->getQuestionId(), $game->getQuestion()->getQuestionType());
		}
		$this->gameSession->waitForAnswer = true;
				
		try {
			$question = $game->nextQuestion();
			$this->view->question 	= $question->getQuestion();
			$this->view->answers  	= $question->getAnswers();
			$this->view->categories = $question->getCategories();

			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers = $game->getScore()->getWrongAnswers();
		}
		catch (Model_Exception_GameEnd $e) { 	// no more question available
			$this->gameSession->result = $game->getScore();
			$this->gameSession->game   = null;
			$this->gameSession->waitForAnswer = false;
			$this->_redirect($this->gameSession->redirect);
		}
		catch (Model_Exception_QuestionNotFound $e) {	 // question does not exist
			$this->gameSession->waitForAnswer = false;
			error_log('question not found|' . $e->getId() . '|' . $e->getClassName());
			$this->view->pageNotFound = true;
			$this->view->errorId	  = $e->getId();
			$this->view->className	  = $e->getClassName();
		}
    }

    public function answerrequestAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
		
			$this->_helper->layout->disableLayout();
			$selectedAnswerHash = $this->_getParam('answer');	
			$game = $this->gameSession->game;
			$question = $game->getQuestion();
			$this->view->isAnswerRight = $game->checkAnswer($selectedAnswerHash);
			$this->view->myAnswer = $question->getAnswer($selectedAnswerHash);
			$this->view->rightAnswer = $question->getRightAnswer(); 

			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers = $game->getScore()->getWrongAnswers();
			
			$this->gameSession->waitForAnswer = false;
			$this->gameSession->oneBrowser = true;

		} else {
			$this->_redirect('/question');
		}
    }

    public function resultAction()
    {
        $score = $this->gameSession->result;
		$this->view->playedQuestions = $score->getPlayedQuestions();
		$this->view->rightAnswers = $score->getRightAnswers();
		$this->view->wrongAnswers = $score->getWrongAnswers();
    }

    public function timeoverAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
		
			$this->_helper->layout->disableLayout();
			$game = $this->gameSession->game;
			$question = $game->getQuestion();
			$this->view->rightAnswer = $question->getRightAnswer();

			$game->getScore()->addWrongAnswer($question->getQuestionId(), $question->getQuestionType());
			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers = $game->getScore()->getWrongAnswers();

			$this->gameSession->waitForAnswer = false;
			$this->gameSession->oneBrowser = true;

		} else {
			$this->_redirect('/question');
		}
    }

}
