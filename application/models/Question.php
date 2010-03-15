<?php

/**
 * question object
 * creates one question
 *
 * @package models
 */
class Model_Question {

	/**
	 * question array with the data from db
	 * @var array
	 */
	private $question = array();

	/**
	 * answer array with the data from db
	 * @var array
	 */
	private $answer = array();


	/**
	 * constructor
	 * creates a new Question-object with given id
	 *
	 * @author Martin Kapfhammer
	 * @param string $questionId
	 */
	public function __construct($questionId) {
		$questionDb 	= new Model_DbTable_Question();
		$answerDb 		= new Model_DbTable_Answer();
		$hasCategoryDb 	= new Model_DbTable_HasCategory();
		$this->question = $questionDb->getQuestion($questionId);		
		$this->answer	= $answerDb->getAnswer($this->getQuestionElement('answerid'));
		$this->category = $hasCategoryDb->getCategories($questionId);

	}


	/**
	 * return an element of the question array or null
	 * 
	 * @author Martin Kapfhammer
	 * @param string $element
	 * @return mixed|null 
	 */
	private function getQuestionElement($element) {
		return isset($this->question[$element]) ? $this->question[$element] : null;
	}

}
