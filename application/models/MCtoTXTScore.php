<?php

/**
 * score object
 * 
 * @package models
 */
class Model_MCtoTXTScore implements Model_ScoreInterface {

	/**
	 * array for the right questionids
	 * answered in txt mode
	 * @var array
	 */
	protected $rightTXTQuestionIds = array();
	
	/**
	 * array for the right questionids
	 * answered in mc mode
	 * @var array
	 */
	protected $rightMCQuestionIds = array();

	/**
	 * array for the wrong questionids
	 * @var array
	 */
	protected $wrongQuestionIds = array();

 	/**
	 * contains all right question objects Model_Question
	 * @var array
	 */
	protected $rightQuestions = array();

	/**
	 * contains all wrong question objects Model_Question
	 * @var array
	 */
	protected $wrongQuestions = array();


	/**
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addRightAnswer(Model_QuestionInterface $question) {
		$this->rightTXTQuestionIds[] 	= $question->getQuestionId();
		$this->rightQuestions[]			= $question;
	}	

	public function addRightMCAnswer(Model_QuestionInterface $question) {
		$this->rightMCQuestionIds[]	= $question->getQuestionId();
		$this->rightQuestions[]	= $question;
	}
	
	
	/**
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addWrongAnswer(Model_QuestionInterface $question) {
		$this->wrongQuestionIds[] = $question->getQuestionId();
		$this->wrongQuestions[]   = $question;
	}

	public function getRightAnswers() {
		return $this->getRightMCAnswers() + $this->getRightTXTAnswers();
	}

	/**
	 * @author Martin Kapfhammer
	 */
	public function getRightTXTAnswers() {
		return count($this->rightTXTQuestionIds);
	}

	/**
	 * @author Martin Kapfhammer
	 */
	public function getRightMCAnswers() {
		return count($this->rightMCQuestionIds);
	}


	/**
	 * getter for the wrong  answers
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->wrongAnswers
	 */
	public function getWrongAnswers() {
		return count($this->wrongQuestionIds);
	}


	/**
	 * getter for the played questions
	 *
	 * @author Martin Kapfhammer
	 * @return integer $this->questions
	 */
	public function getPlayedQuestions() {
		return $this->getRightMCAnswers() 
				+ $this->getRightTXTAnswers()
				+ $this->getWrongAnswers(); 
	}




	/**
	 * getter for the right question objects
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestions
	 */
	public function getRightQuestions() {
		return array_merge($this->rightMCQuestions, $this->rightTXTQuestions);
	}


	/**
	 * getter for the wrong question objects
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestions
	 */
	public function getWrongQuestions() {
		return $this->wrongQuestions;
	}

}
