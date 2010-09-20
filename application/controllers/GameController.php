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
			$this->gameSession->game 	 = null;	
			$this->gameSession->waitForAnswer = false;
			$this->gameSession->redirect = '/game/result';
			$this->gameSession->gameId 	 = null; 
			$this->gameSession->typeOfLearnGame = null;

			$nextGameSession = new Zend_Session_Namespace('nextGame');
			if ($nextGameSession->nextGame !== null && $this->useSession()) {	// nextGame isset ?
				$questionIds = $nextGameSession->nextGame;
				if ($nextGameSession->redirect !== null) {
					$this->gameSession->redirect = $nextGameSession->redirect; 
				}
				$nextGameSession->nextGame = null;
			} else if ($this->getRequest()->has('cat')) {
				if (!$this->getRequest()->has('result')) {
					$hasCategoryDb = new Model_DbTable_HasCategory();
					$questionIds = $hasCategoryDb->getQuestionIds($this->_getParam('cat'));
				} else {
					$questionResultDb = new Model_DbTable_QuestionResult($this->userId);
					$questionIds = $questionResultDb->getQuestionIds($this->_getParam('cat'), $this->_getParam('result'));
				}
			} else if ($this->isGame()) {
				if ($this->toLearn()) {
					$this->gameSession->typeOfLearnGame = 'LG';
				}
				$gameId = $this->_getParam('g');
				$this->gameSession->gameId = $gameId;
				$gameListDb  = new Model_DbTable_GameList();
				$questionIds  = $gameListDb->getQuestionIds($gameId);
			} else if ($this->replayGameResult()) {
				$resultType = $this->_getParam('rty'); // result type -> y or n
				$resultId   = $this->_getParam('rid'); // result id 
				$gameResultDb = new Model_DbTable_GameResult();
				$result	= $gameResultDb->getGameResultForResultId($resultId, $this->userId);
				if ($result === false) { 
					$this->_redirect('/gamelist');
				}	
				if ($resultType === 'N') {
					$this->gameSession->typeOfLearnGame = 'PW';
					$this->gameSession->gameId = $resultId;
					$getIds = 'wrongids';
				} else if ($resultType === 'Y') {
					$getIds = 'rightids';
				}	
				$questionIds = Model_String::explodeString($result[$getIds]);
			}
			$nextGameSession->nextGame = $questionIds;
		}


		if (!isset($questionIds) || $this->isRandomGame()) {
			$questionDb  = new Model_DbTable_Question();
			$questionIds = $questionDb->getRandomQuestionIds();
		} 

		// use always the same game object
		if ($this->gameSession->game === null) {
			if ($this->toLearn() === true) { // Learn game
				$this->gameSession->game = new Model_LearnGame($questionIds, null);	
			} else if ($this->isTestGame() === false) {	// it's not a testgame, it is a normal game
				$this->gameSession->game = new Model_Game($questionIds, $this->userId);	
			} else if ($this->isTestGame() === true) {	// test game
				$this->gameSession->game = new Model_Game($questionIds, null, true);	
			} 
		}
		$game = $this->gameSession->game; 
		
		// set QuestionType
		if ($this->isNewGame() && $this->hasQuestionType()) {
			$questionType = $this->_getParam('qtyp');
			$game->setQuestionType($questionType);
		}

		// shuffle
		if ($this->isNewGame() === true && $this->getRequest()->has('sh')) {
			$game->shuffleQuestionIds();
		}

		// refresh browser -> answer wrong
		if ($this->gameSession->waitForAnswer === true) {
			$game->getScore()->addWrongAnswer($game->getQuestion());
		}
		$this->gameSession->waitForAnswer = true;
				
		try {
			$question = $game->nextQuestion();
			$this->view->question 	  = $question->getQuestion();
			$this->view->objectType   = $question->getObjectType();
			$this->view->answers  	  = $question->getAnswers();
			$this->view->numberOfQuestions = 
						$game->getNumberOfQuestions();
			$this->view->currentNumberOfQuestions = 
						$game->getCurrentNumberOfQuestions();

			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers  = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers  = $game->getScore()->getWrongAnswers();
			$this->view->role		   = $this->role;
			$this->view->addToGameForm = new Form_AddToGame();
		}
		catch (Model_Exception_GameEnd $e) { 	// no more question available
			$score = $game->getScore();
			$questionType  = $game->getQuestionType();
			$score->setResultCreator(new Model_ResultCreator($score, $questionType));
			if (Zend_Auth::getInstance()->hasIdentity() && $this->gameSession->gameId !== null) { // user played game -> save it
				if ($game->getGameType() === 'GAME') {
					$this->saveGame($score, $questionType); 
				} else if ($game->getGameType() === 'LEARNGAME') {
					$this->updateGameResult($questionType);
				}
			}
			$score->setGameId($this->gameSession->gameId);
			$score->setGameType($game->getGameType());
			$this->gameSession->result = $score;
			$this->gameSession->game   = null;
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

	protected function isTestGame() {
		return ($this->_getParam('test') === md5('testgame!'));
	}

	protected function isGame() {
		return ($this->getRequest()->has('g'));
	}

	protected function toLearn() {
		return ($this->_getParam('tl') === md5('toLearn!'));
	}
	
	protected function replayGameResult() {
		return ($this->_getParam('re') === md5('replay!'));
	}

	
	protected function useSession() {
		return ($this->_getParam('se') === md5('session!'));
	}

	protected function hasQuestionType() {
		return ($this->isGame() || $this->getRequest()->has('qtyp'));
	}

	protected function isRandomGame() {
		return ($this->isGame() && $this->_getParam('ra') === md5('random!'));
	}

	protected function saveGame(Model_Score $score, $questionType) {
		$gameResultDb = new Model_DbTable_GameResult();
		$gameId = $this->gameSession->gameId;
	
		// calculate the score		
		$calculateScore  = new Model_CalculateScore($score);
		$calculatedScore = $calculateScore->getScore();
		$score->setCalculatedScore($calculatedScore);

		$result['right'] = $score->getImplodedRightQuestionIds();
		$result['wrong'] = $score->getImplodedWrongQuestionIds();
		$result['score'] = $calculatedScore;
		$result['qtype'] = $questionType;
		$result['type']  = $score->getResultType();
		$result['result'] = $score->getResultPercentage();

		$gameResultDb->insertResult($this->userId, $gameId, $result);
	}

	protected function updateGameResult($questionType) {
		$gameResultDb = new Model_DbTable_GameResult();
		$gameId = $this->gameSession->gameId;
		$typeOfLearnGame = $this->gameSession->typeOfLearnGame;
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

			$this->view->numberOfQuestions = 
						$game->getNumberOfQuestions();
			$this->view->currentNumberOfQuestions = 
						$game->getCurrentNumberOfQuestions() - 1;
			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers = $game->getScore()->getWrongAnswers();
			
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

        $score = $this->gameSession->result;
		$this->view->playedQuestions = $score->getPlayedQuestions();
		$this->view->rightAnswers = $score->getRightAnswers();
		$this->view->wrongAnswers = $score->getWrongAnswers();
		$this->view->score		  = $score->getCalculatedScore();
		$this->view->percentage = $score->getResultPercentage();

		if ($score->getGameId() && $this->userId && $score->getGameType() === 'GAME') {
			$gameResultDb = new Model_DbTable_GameResult();
			$lastResult = $gameResultDb->
					getResultForGameAndUser($score->getGameId(), $this->userId);
			$this->view->resultText   = $score->getResultText();
			if (isset($lastResult[1])) {
				$lastResult = $lastResult[1];
				$this->view->lastResult = $lastResult;
				if ($score->getResultPercentage() > $lastResult['result']) {
					$trend = 1;
				} else if($score->getResultPercentage() == $lastResult['result']) {
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
			$game = $this->gameSession->game;
			$question = $game->getQuestion();
			$this->view->rightAnswer 	= $question->getRightAnswer();
			$this->view->image	  	 	= $question->getAnswerImage();
			$this->view->answerText  	= $question->getAnswerText();
			$this->view->objectType 	= $question->getObjectType();

			$this->view->numberOfQuestions = 
						$game->getNumberOfQuestions();
			$this->view->currentNumberOfQuestions = 
						$game->getCurrentNumberOfQuestions() - 1;
			$game->getScore()->addWrongAnswer($question);
			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers = $game->getScore()->getWrongAnswers();

			$this->gameSession->waitForAnswer = false;

		} else {
			$this->_redirect('/question');
		}
    }

}
