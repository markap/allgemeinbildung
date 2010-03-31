<?php

class CreatequestionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
			rename(APPLICATION_PATH . '/../img/mhm.jpg', APPLICATION_PATH . '/../img/test.jpg');
/**
        // action body
		// TODO show hints for every question
		$form = new Form_CreateQuestion();

		$categoryDb = new Model_DbTable_Category();
		$categorySelect = $form->getElement('category');
		$categorySelect->setMultiOptions($categoryDb->getCategories());

		// handle request
		$request = $this->getRequest();
		if ($request->isPost()) {
			$postValues = $request->getPost();
			//TODO gscheite validierung
			if (Model_ValidateFormular::notEmpty($postValues) === true 
				&& $form->getElement('image')->receive()) {

				//TODO generiere neuen bildnamen
				$pathName = $form->getElement('image')->getFileName();
				$fileName  = substr($pathName, strrpos($pathName, '/') + 1);
		//		rename(APPLICATION_PATH . '/../img/' . $fileName, APPLICATION_PATH . '/../img/test.jpg');
				$answerDb = new Model_DbTable_Answer();
				$questionDb = new Model_DbTable_Question();
				$answerId = $answerDb->getNextAnswerId();
				//$questionId = $questionDb->insertQuestion($postValues, $answerId, $fileName);
				//$answerDb->insertAnswer($postValues, $answerId);
				
			} else echo 'nix';
			var_dump($postValues);	
		}

		$this->view->form = $form;
*/
    }


}

