<?php

class GameController extends Zend_Controller_Action
{

    /**
     * @var Zend_Session_Namespace
     */
    protected $gameSession = null;

    public function init()
    {
        $this->gameSession = new Zend_Session_Namespace('game');
    }

    public function indexAction()
    {
		//TODO you play and then you go to another
	  	// when you go back to this, session exists

		// use always the same question object
        if ($this->gameSession->game === null) {
        	$this->gameSession->game = new Model_Game(array(1,2,3,1));	
     	}
		$game = $this->gameSession->game; 

		// refresh browser -> answer wrong
		if ($this->gameSession->waitForAnswer === true) {
			$game->getScore()->addWrongAnswer();
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
		catch (Model_Exception_GameEnd $e) {
			$this->gameSession->result = $game->getScore();
			$this->gameSession->game   = null;
			$this->_redirect('/game/result');
		}
		catch (Model_Exception_QuestionNotFound $e) {
        //TODO
			// show mistake message
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

}





