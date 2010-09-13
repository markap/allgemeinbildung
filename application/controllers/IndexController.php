<?php

class IndexController extends Zend_Controller_Action
{

    protected $userId = null;

    public function init()
    {
        $userSession 	    = new Zend_Session_Namespace('user');
		$this->userId	    = isset($userSession->user['userid']) 
										? $userSession->user['userid'] : null;
    }

    public function indexAction()
    {
        $linkBuilder	= new Model_WhatsNextLinkBuilder();
                
		$this->view->randomMCLink  =  $linkBuilder->getRandomGameLink('MC');	
		$this->view->randomTXTLink =  $linkBuilder->getRandomGameLink('TXT');	

    }

    public function loginAction()
    {
        $auth = Zend_Auth::getInstance();	
		if ($auth->hasIdentity()) {
			$this->_redirect('/index'); 
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			$username = $request->getPost('username');
			$password = $request->getPost('password');
			if (!empty($username) && !empty($password)) {
				$authAdapter = new Model_AuthAdapter($username, $password);
				$result = $auth->authenticate($authAdapter);
				if (!$authAdapter->isActive() && $result->isValid()) {
					$this->view->error = 'Benutzer ist noch nicht aktiv.' . 
										 ' Bitte aktivieren Sie den Link in der Email, 
											den Sie bei Anmeldung bekommen haben';
				} else if ($result->isValid()) {
					$userSession = new Zend_Session_Namespace('user');
					$userSession->user = $result->getIdentity();
					$this->_redirect('/index'); 
				} else {
					$this->view->error = 'Benutzerdaten nicht gefunden';
				}
			} else {
				$this->view->error = 'Bitte alle Felder ausfüllen';
			}
		}
		$this->view->loginForm = new Form_Login();
    }

    public function showimagesAction()
    {
        // action body
    }

    public function registerAction()
    {
        /// if already logged in, redirect to start
		$auth = Zend_Auth::getInstance();	
		if ($auth->hasIdentity()) {
			$this->_redirect('/index'); 
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			if (Model_ValidateFormular::notEmpty($request->getPost())) {	
				$postValues = $request->getPost();
				$registerValidator = new Model_RegisterValidator($postValues);
				if ($registerValidator->isValid()) {
					$userDb = new Model_DbTable_User();
					$userId = $userDb->saveUser($postValues);
					$this->sendActivationMail($userId, $postValues);
					$this->_redirect('/index/registersave'); 
				} else {
					$this->view->errors = $registerValidator->getErrors();
				}
			} else {
				$this->view->errors = array('Bitte alle Felder ausfüllen');
			}
		}
		$this->view->form = new Form_Register();
    }

    protected function sendActivationMail($userId, array $data)
    {
        $md5 = md5($data['username'] + $data['mail'] + '123!');
			
		$content = '<h2>Anmeldung auf allgemein-bildung.de</h2>';
		$content .= 'Um deine Anmeldung zu aktivieren, kopiere den folgenden Link und öffne ihn im Browser: <br /><br />';
		$content .= 'allgemein-bildung.de/index/activate/u/' . $userId . '/h/' . $md5;
		$content .= '<br /><br />Vielen Dank'; 

		$mail = new Zend_Mail();
		$mail->setBodyHtml($content);
		$mail->setFrom('anmeldung@allgemein-bildung.de');
		$mail->setSubject('Anmeldung auf allgemein-bildung.de');
		$mail->addTo($data['mail'], $data['username']);
		$mail->send();
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
		$userSession = new Zend_Session_Namespace('user');
		unset($userSession->user);
		$this->_redirect("/");
    }

    public function registersaveAction()
    {
        // just render view
    }

    public function activateAction()
    {
        $userId = $this->_getParam('u');
		$md5	= $this->_getParam('h');
		
		$userDb = new Model_DbTable_User();
		$data   = $userDb->getUser($userId);

	
		$md5Hash = md5($data['username'] + $data['email'] + '123!');
		if ($md5 === $md5Hash && $data['active'] !== 'Y') {
			$userDb->activateUser($userId);
			$this->view->result = 'Herlichen Glückwunsch ' . $data['username'] .
									', dein Account wurde erfolgreich registriert.';
		} else {
			$this->view->result = 'Aktivierung nicht erfolgreich.';
		}
    }

    public function nextAction()
    {
		if ($this->getRequest()->isXmlHttpRequest()) {
				$this->_helper->layout->disableLayout();

				$linkBuilder	= new Model_WhatsNextLinkBuilder();

						
				$gameDb = new Model_DbTable_GameList();
				$games  = $gameDb->getGames(5);
				foreach ($games as $key => $game) {
						$games[$key]['linkMC'] 	= $linkBuilder->getGameLink($game['gameid'], 'MC');	
						$games[$key]['linkTXT'] 	= $linkBuilder->getGameLink($game['gameid'], 'TXT');	
						$games[$key]['postfix'] 	= ''; 
						$games[$key]['tooltip'] 	= ''; 
						$games[$key]['type'] 		= null; 
				
					
				}
				$this->view->next = $games;
		}
	}

}















