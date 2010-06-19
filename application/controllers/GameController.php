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
		$questionIds = array(array('id' => 48, 'type' => 'mc'),
							 array('id' => 41, 'type' => 'txt'),
							 array('id' => 41, 'type' => 'mc'),
							3,4);

		// get game ids
		if ($this->isNewGame() === true) {
			$this->gameSession->game 	 = null;	
			$this->gameSession->waitForAnswer = false;
			$this->gameSession->redirect = '/game/result';
			$this->gameSession->gameId 	 = null; 

			$nextGameSession = new Zend_Session_Namespace('nextGame');
			if ($nextGameSession->nextGame !== null) {	// nextGame isset ?
				$questionIds = $nextGameSession->nextGame;
				if ($this->isTestGame() === true) {
					$this->gameSession->redirect = '/createquestion/result/question/' . $nextGameSession->nextGame[0]['id'];
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
				$gameId = $this->_getParam('g');
				if ($this->toLearn()) {
					$this->gameSession->gameId = $gameId;
				}
				$gameListDb  = new Model_DbTable_GameList();
				$questionIds  = $gameListDb->getQuestionIds($gameId);
				$questionType = $gameListDb->getQuestionType($gameId);
			} else if ($this->replayGameResult()) {
				$resultType = $this->_getParam('rty'); // result type -> y or n
				$resultId   = $this->_getParam('rid'); // result id 
				$gameResultDb = new Model_DbTable_GameResult();
				$result	= $gameResultDb->getGameResultForResultId($resultId, $this->userId);
				if ($result === false) { 
					$this->_redirect('/gamelist');
				}	
				if ($resultType === 'N') {
					$getIds = 'wrongids';
				} else if ($resultType === 'Y') {
					$getIds = 'rightids';
				}	
				$questionIds = Model_String::explodeString($result[$getIds]);
			}
		}

		//TODO if questionids = null, show error

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
			$this->view->question 	= $question->getQuestion();
			$this->view->answers  	= $question->getAnswers();
			$this->view->categories = $question->getCategories();

			$this->view->playedQuestions = $game->getScore()->getPlayedQuestions();
			$this->view->rightAnswers  = $game->getScore()->getRightAnswers();
			$this->view->wrongAnswers  = $game->getScore()->getWrongAnswers();
			$this->view->role		   = $this->role;
			$this->view->addToGameForm = new Form_AddToGame();
		}
		catch (Model_Exception_GameEnd $e) { 	// no more question available
			$score = $game->getScore();
			$questionType = $game->getQuestionType();
			if (Zend_Auth::getInstance()->hasIdentity() && $this->gameSession->gameId !== null) { // user played game -> save it
				$this->saveGame($score, $questionType); 
			}
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

	protected function hasQuestionType() {
		return ($this->isGame() || $this->getRequest()->has('qtyp'));
	}

	protected function saveGame(Model_Score $score, $questionType) {
		$gameId = $this->gameSession->gameId;
	
		// calculate the score		
		$calculateScore  = new Model_CalculateScore($score);
		$calculatedScore = $calculateScore->getScore();
		$score->setCalculatedScore($calculatedScore);

		$result['right'] = $score->getImplodedRightQuestionIds();
		$result['wrong'] = $score->getImplodedWrongQuestionIds();
		$result['score'] = $calculatedScore;
		$result['qtype']  = $questionType;

		$gameResultDb = new Model_DbTable_GameResult();
		$gameResultDb->insertResult($this->userId, $gameId, $result);
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
		$this->view->score		  = $score->getCalculatedScore();
		$this->gameSession->result = null;
    }

    public function timeoverAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
		
			$this->_helper->layout->disableLayout();
			$game = $this->gameSession->game;
			$question = $game->getQuestion();
			$this->view->rightAnswer = $question->getRightAnswer();

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
