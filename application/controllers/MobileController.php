<?php

class MobileController extends Zend_Controller_Action
{

    public function init()
    {
        if (!Model_MobileAuth::authentificate($this->_getParam('auth'))) {
			exit();
		}
		$this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }

    public function gamelistAction()
    {
        $gameListDb 	= new Model_DbTable_GameList();
		$json 			= $gameListDb->getGames(null, 'qtype = "def"');
		echo Zend_Json::encode($json);
    }

    public function gameAction()
    {
        $gameId 		= $this->_getParam('gameid');
		$gameListDb  	= new Model_DbTable_GameList();
		$questionIds  	= $gameListDb->getQuestionIds($gameId);
	
		$questionDb 	= new Model_DbTable_Question();
		$answerDb 		= new Model_DbTable_Answer();

		$gameData = array();
		foreach ($questionIds as $questionId) {
			
			$question   	= $questionDb->getQuestion($questionId, false);
			$answer			= $answerDb->getAnswer($question['answerid']);
			$answer['answerimage'] = $answer['image'];
			unset($answer['image']);
			$questionData 	= array_merge($question, $answer);

			$gameData[] = $questionData;
		}	

		echo Zend_Json::encode($gameData);
    }

    public function loginAction()
    {
		$username = $this->_getParam('user');
		$password = $this->_getParam('pass');

		$userDb = new Model_DbTable_User();
		$user	= $userDb->findCredentials($username, $password);
		echo Zend_Json::encode($user->toArray());
    }


}







