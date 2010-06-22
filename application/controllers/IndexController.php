<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
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
				if ($result->isValid()) {
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
				$registerValidator = new Model_RegisterValidator($request->getPost());
				if ($registerValidator->isValid()) {
					echo 'valid'; exit();
					$this->_redirect('/index'); 
				} else {
						
				$errors = $registerValidator->getErrors();
		var_dump($errors); exit();
				}
			} else {
				$this->view->errors = array('Bitte alle Felder ausfüllen');
			}
		}
		$this->view->form = new Form_Register();
    }


    public function logoutAction()
    {
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect("/");
    }

}









