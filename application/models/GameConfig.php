<?php

/**
 * game config object
 * 
 * @package models
 */
class Model_GameConfig {

	protected $questionIds 		= null;

	protected $gameId 			= null;

	protected $typeOfLearnGame 	= null;

	protected $controller 		= null;


	public function __construct(Zend_Controller_Action $controller) {
		$this->controller = $controller;
	}


	public function createConfig() {
		$nextGameSession = new Zend_Session_Namespace('nextGame');

		if ($nextGameSession->nextGame !== null && $this->useSession()) {   // nextGame isset ?

        	$this->questionIds 	= $nextGameSession->nextGame;
            $this->gameId 		= $nextGameSession->gameId;

            if ($nextGameSession->redirect !== null) {
                $this->controller->gameSession->redirect = $nextGameSession->redirect;
            }
            $nextGameSession->nextGame = null;

      	} else if ($this->isGame()) {

        	if ($this->toLearn()) {
                $this->typeOfLearnGame = 'LG';
            }
	
            $this->gameId 		= $this->_getParam('g');
            $gameListDb     	= new Model_DbTable_GameList();
            $this->questionIds  = $gameListDb->getQuestionIds($this->gameId);

   		} else if ($this->replayGameResult()) {
           	$resultType = $this->_getParam('rty'); // result type -> y or n
            $resultId   = $this->_getParam('rid'); // result id 

            $gameResultDb 	= new Model_DbTable_GameResult();
            $result 		= $gameResultDb->getGameResultForResultId($resultId, $this->userId);

           	if ($result === false) {
                $this->_redirect('/gamelist');
            }

            if ($resultType === 'N') {
            	$this->typeOfLearnGame 	= 'PW';
                $this->gameId 			= $resultId;
                $getIds = 'wrongids';
          	} else if ($resultType === 'Y') {
                $getIds = 'rightids';
           	}
            $this->questionIds = Model_String::explodeString($result[$getIds]);
      	}
        $nextGameSession->nextGame = $this->questionIds;

		if (!isset($this->questionIds) || $this->isRandomGame()) {
            $questionDb  		= new Model_DbTable_Question();
            $this->questionIds 	= $questionDb->getRandomQuestionIds();
        }


	}

	public function getQuestionIds() {
		return $this->questionIds;
	}

	public function setOptions(Model_Game $game) {
   		// set QuestionType
        if ($this->isNewGame() && $this->hasQuestionType()) {
            $questionType = $this->_getParam('qtyp');
            $game->setQuestionType($questionType);
        }

        // set test game
        if ($this->isNewGame() && $this->isTestGame()) {
            $game->isTest(true);
        }

        // set gameid
        if ($this->isNewGame()) {
            $game->setGameId($this->gameId);
        }

        // set type off LearnGame
        if ($this->isNewGame() && $this->toLearn()) {
            $game->setType($this->typeOfLearnGame);
        }

        // shuffle
        if ($this->isNewGame() && $this->controller->getRequest()->has('sh')) {
            $game->shuffleQuestionIds();
        }

	}


	protected function _getParam($name) {
  		return $this->controller->getRequest()->getParam($name);
	}

	protected function _redirect($url) {
 		$this->_helper->redirector->gotoUrl($url, array());
	}

  	protected function useSession() {
        return ($this->_getParam('se') === md5('session!'));
    }

  	protected function isGame() {
        return ($this->controller->getRequest()->has('g'));
    }

 	protected function toLearn() {
        return ($this->_getParam('tl') === md5('toLearn!'));
    }

  	protected function replayGameResult() {
        return ($this->_getParam('re') === md5('replay!'));
    }

   protected function isNewGame() {
        return ($this->_getParam('play') === md5('nextgame!'));
    }

 	protected function hasQuestionType() {
        return ($this->isGame() || $this->controller->getRequest()->has('qtyp'));
    }

 	protected function isTestGame() {
        return ($this->_getParam('test') === md5('testgame!'));
    }

  	protected function isRandomGame() {
        return ($this->isGame() && $this->_getParam('ra') === md5('random!'));
    }


}
