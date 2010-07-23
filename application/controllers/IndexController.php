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
		$whatsNext = new Model_WhatsNext($this->userId);

    }

    public function loginAction()
    {
        //TODO user ist noch nicht freigegeben, neue mail versenden
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
					$userDb->saveUser($postValues);
					$this->sendActivationMail($postValues);
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

    protected function sendActivationMail(array $data)
    {
        //create a md5 string 
		// send mail
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect("/");
}

    public function registersaveAction()
    {
        // just render view 
    }


}











