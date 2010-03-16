<?php

/**
 * displays questions
 * 
 * @package controller
 */
class QuestionController extends Zend_Controller_Action
{

	/**
	 * @var Zend_Session_Namespace
	 */
	protected $questionSession = null;


	/**
	 * inits controller
	 *
	 * @author Martin Kapfhammer	
	 */
    public function init()
    {
		$this->questionSession = new Zend_Session_Namespace('question');
    }

    public function indexAction()
    {
    }

    public function playAction()
    {
        $questionId = $this->_getParam('question');
		try {
			$question   = new Model_Question($questionId);
			$this->view->question 	= $question->getQuestion();
			$this->view->answers  	= $question->getAnswers();
			$this->view->categories = $question->getCategories();
			$this->questionSession->questionObject = $question;
		}
		catch (Model_Exception_QuestionNotFound $e) {
			echo $e->getId();	
			echo $e->getClassName();
		}
    }

    public function questionrequestAction()
    {
		if ($this->getRequest()->isXmlHttpRequest()) {

        	$this->_helper->layout->disableLayout();
			$selectedAnswerHash = $this->_getParam('answer');	
			$question = $this->questionSession->questionObject;
			$this->view->isAnswerRight = $question->checkAnswer($selectedAnswerHash);
			$this->view->myAnswer = $question->getAnswer($selectedAnswerHash);
			$this->view->rightAnswer = $question->getRightAnswer(); 

		} else {
			$this->_redirect('/question');
		}
    }


}



