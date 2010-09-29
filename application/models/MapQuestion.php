<?php

/**
 * map question object
 *
 * @package models
 */
class Model_MapQuestion implements Model_QuestionInterface {

	/**
	 * @var Model_Question
	 */
	protected $question;


	/**
	 * constructor
	 *
	 * @author Martin Kapfhammer
	 * @param string $question
	 */
	public function __construct(Model_Question $question) {
		$this->question = $question;
	}


	/**
	 * getter for question-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->question
	 */
	public function getQuestion() {
		$question = $this->question->getQuestion();
		return array('question' => "Wo liegt " . $question['question'] . "?");
	}


	/**
	 * getter for answers-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->answers
	 */
	public function getAnswers() {
		$answers = $this->question->getAnswersUnshuffled();
		$answer  = $answers['answer'];
		$latLon  = explode('#', $answer);
		$return['lat'] = $latLon[0]; 
		$return['lon'] = $latLon[1];
		$return['type'] = $answers['fake2'];
		$return['greater'] = $answers['fake3'];

		return $return;
	}


	/**
	 * getter for categories-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->categories
	 */
	public function getCategories() {
		return null; 
	}


	/**
	 * checks if the given sorted answer is right
	 * 
	 * @param string $answerHash
	 * @return boolean $result
	 */
	public function checkAnswer($answer) {
		return ($answer === 'right') ? true : false;
	}

	
	/**
	 * return my answer
	 *
	 * @author Martin Kapfhammer
 	 * @param string $answerHash
	 * @return string $result
	 */
	public function getAnswer($answer) {
		return null;
	}


	/**
	 * returns the right answer
	 * 
	 * @author Martin Kapfhammer
 	 * @return string $this->answers['answer']
	 */
	public function getRightAnswer() {
		return null; 
	}


	/**
	 * returns current questionid
	 *
	 * @author Martin Kapfhammer
	 * @return string question id
 	 */
	public function getQuestionId() {
		$question = $this->question->getQuestion();
		return $question['questionid'];
	}


	/**
	 * returns the type of the question
	 *
	 * @author Martin Kapfhammer
	 * @return string 
	 */
	public function getQuestionType() {
		return 'mc'; 
	}


	/**
	 * checks if there exists an answer image
	 * if not, return question image 
	 *
	 * @author Martin Kapfhammer
	 * @return string
	 */
	public function getAnswerImage() {
		return null; 
	}

	public function getAnswerText() {
		return ''; 
	}


	/*
	 * Returns the object type 
	 *
	 * @author Martin Kapfhammer
	 * @return string
	 */
	public function getObjectType() {
		return 'map';
	}

}
