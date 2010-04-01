<?php

class CreatequestionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
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
			if (/**Model_ValidateFormular::notEmpty($postValues) === true 
				&& */$form->getElement('image')->receive()) {

				$pathName = $form->getElement('image')->getFileName();
				if (!empty($pathName)) { 	// image upload
					$fileName  = substr($pathName, strrpos($pathName, '/') + 1);
					$fileExt = substr($fileName, strrpos($fileName, '.') + 1);
					$newImageName = Model_DbTable_Helper::getInstance()->getImageNumber();
					rename(APPLICATION_PATH . '/../public/img/' . $fileName, 
							APPLICATION_PATH . '/../public/img/' . $newImageName . '.' . $fileExt);
				}
				$answerDb = new Model_DbTable_Answer();
				$questionDb = new Model_DbTable_Question();
				$hasCategoryDb = new Model_DbTable_HasCategory();
				$answerId = $answerDb->getNextAnswerId();
				$questionId = $questionDb->insertQuestion($postValues, $answerId, $newImageName.'.'.$fileExt);
				$answerDb->insertAnswer($postValues, $answerId);
				$hasCategoryDb->insertRelation($questionId, $postValues['category']);
				$this->_redirect('/createquestion/result/question/' . $questionId);
			} 
		}

		$this->view->form = $form;
    }

    public function resultAction()
    {
        $questionId = $this->_getParam('question');

		echo "super gemacht...";
		echo "<a href='/question/play/question/".$questionId."'>testen</a>";
    }


}



