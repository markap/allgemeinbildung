<?php

class MobileController extends Zend_Controller_Action
{

    public function init()
    {
		if (!Model_MobileAuth::authentificate($this->_getParam('auth'))) {
			exit();
		}
    }

    public function indexAction()
    {
        // action body
    }

    public function gamelistAction()
    {
		$gameListDb = new Model_DbTable_GameList();
		$json = $gameListDb->getGames(null, 'qtype = "def"');
		echo Zend_Json::encode($json);	
    }


}



