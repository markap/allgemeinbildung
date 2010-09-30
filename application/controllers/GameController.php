<?php

class GameController extends Zend_Controller_Action
{

    protected $gameSession = null;
	protected $userId	   = null;
	protected $role		   = null;

    public function init()
    {
        $this->gameSession = new Zend_Session_Namespace('game');
		$userSession 	   = new Zend_Session_Namespace('user');
		$this->userId	   = isset($userSession->user['userid']) 
								? $userSession->user['userid'] : null;
		$this->role		   = isset($userSession->user['role']) 
								? $userSession->user['role'] : null;
    }

    public function indexAction()
    {

		// get game ids
		if ($this->isNewGame() === true) {
			$this->gameSession->game 	 		= null;	
			$this->gameSession->waitForAnswer 	= false;
			$this->gameSession->redirect 		= '/game/result';
			$this->gameSession->result 			= null;

			$questionIds 	= null;

			$gameConfig 	= new Model_GameConfig($this);
			$gameConfig->createConfig();
			$questionIds 	= $gameConfig->getQuestionIds();
		}

		// use always the same game object
		if ($this->gameSession->game === null) {
			$this->gameSession->game = Model_GameFactory::createGame($questionIds, $this->toLearn());
		}
		$game = $this->gameSession->game; 
		
		// set configs
		if ($this->isNewGame()) {
			$gameConfig->setOptions($game);
		}
		
		// refresh browser -> answer wrong
		if ($this->gameSession->waitForAnswer === true) {
			$game->getScore()->addWrongAnswer($game->getQuestion());
		}
		$this->gameSession->waitForAnswer = true;
				
		try {
			$question = $game->nextQuestion();
			$this->view->game 		  = $game;
			$this->view->question 	  = $question->getQuestion();
			$this->view->objectType   = $question->getObjectType();
			$this->view->answers  	  = $question->getAnswers();
			$this->view->role		  = $this->role;
		}
		catch (Model_Exception_GameEnd $e) { 	// no more question available
			$score 			= $game->getScore();
			$questionType  	= $game->getQuestionType();
			$resultCreator 	= new Model_ResultCreator($score, $questionType);

			if (Zend_Auth::getInstance()->hasIdentity() && $game->getGameId() !== null) { // user played game -> save it
				if ($game->getGameType() === 'GAME') {
					$this->saveGame($game); 
				} else if ($game->getGameType() === 'LEARNGAME') {
					$this->updateGameResult($game);
				}
			}

			$this->gameSession->game 	= null;
			$this->gameSession->result 	= $game;

			$this->gameSession->waitForAnswer = false;
			$this->_redirect($this->gameSession->redirect);
		}
		catch (Model_Exception_QuestionNotFound $e) {	 // question does not exist
			$this->gameSession->waitForAnswer = false;
			error_log('question not found|' . $e->getId() . '|' . $e->getClassName());
			$this->view->questionNotFound = true;
		}
    }

	protected function isNewGame() {
		return ($this->_getParam('play') === md5('nextgame!'));
	}

	protected function toLearn() {
		return ($this->_getParam('tl') === md5('toLearn!'));
	}



	protected function saveGame(Model_Game $game) {
		$gameResultDb = new Model_DbTable_GameResult();

		$score 			= $game->getScore();
		$questionType  	= $game->getQuestionType();
		$resultCreator 	= new Model_ResultCreator($score, $questionType);
		$gameId			= $game->getGameId();

		$result['right'] 	= $score->getImplodedRightQuestionIds();
		$result['wrong'] 	= $score->getImplodedWrongQuestionIds();
		$result['score'] 	= 0;
		$result['qtype'] 	= $questionType;
		$result['type'] 	= $resultCreator->getType();
		$result['result'] 	= $resultCreator->getPercentage();

		$gameResultDb->insertResult($this->userId, $gameId, $result);
	}

	protected function updateGameResult(Model_Game $game) {
		$gameResultDb = new Model_DbTable_GameResult();

		$gameId 			= $game->getGameId();
		$typeOfLearnGame 	= $game->getType();

		if ($typeOfLearnGame === 'LG') {
			$gameResultDb->updateLGGameResult($this->userId, $gameId, $questionType);
		} else if ($typeOfLearnGame === 'PW') {
			$gameResultDb->updatePWGameResult($this->userId, $gameId, $questionType);
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

			$this->view->objectType 	= $question->getObjectType();
			$this->view->image	  		= $question->getAnswerImage();
			$this->view->answerText  	= $question->getAnswerText();
			$this->view->myAnswer 		= $question->getAnswer($selectedAnswerHash);
			$this->view->rightAnswer 	= $question->getRightAnswer(); 
			$this->view->game			= $game;

			$this->gameSession->waitForAnswer = false;

		} else {
			$this->_redirect('/question');
		}
    }

    public function resultAction()
    {
		$nextGameSession = new Zend_Session_Namespace('nextGame');
		$nextGameSession->redirect = null;
		$this->view->playAgainLink = ($nextGameSession->nextGame) ? true : false;


		$game 			= $this->gameSession->result;
        $score 			= $game->getScore();
		$resultCreator 	= new Model_ResultCreator($score, $game->getQuestionType());

		$nextGameSession->gameId 		= $game->getGameId();
		$this->view->playedQuestions 	= $score->getPlayedQuestions();
		$this->view->rightAnswers 		= $score->getRightAnswers();
		$this->view->wrongAnswers 		= $score->getWrongAnswers();
		$this->view->percentage 		= $resultCreator->getPercentage();

		if ($game->getGameId() !== null && $this->userId && $game->getGameType() === 'GAME') {

			$gameResultDb 				= new Model_DbTable_GameResult();
			$lastResult 				= $gameResultDb->getResultForGameAndUser($game->getGameId(), $this->userId);
			$this->view->resultText 	= $resultCreator->getText();

			if (isset($lastResult[1])) {
				$lastResult = $lastResult[1];
				$this->view->lastResult = $lastResult;
				if ($resultCreator->getPercentage() > $lastResult['result']) {
					$trend = 1;
				} else if($resultCreator->getPercentage() == $lastResult['result']) {
					$trend = 0;
				} else {
					$trend = -1;
				}
				$this->view->trend = $trend;
			}
		}
    }

    public function timeoverAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
		
			$this->_helper->layout->disableLayout();

			$game 		= $this->gameSession->game;
			$question 	= $game->getQuestion();

			$this->view->rightAnswer 	= $question->getRightAnswer();
			$this->view->image	  	 	= $question->getAnswerImage();
			$this->view->answerText  	= $question->getAnswerText();
			$this->view->objectType 	= $question->getObjectType();
			$this->view->game			= $game;

			$game->getScore()->addWrongAnswer($question);

			$this->gameSession->waitForAnswer = false;

		} else {
			$this->_redirect('/question');
		}
    }

}
