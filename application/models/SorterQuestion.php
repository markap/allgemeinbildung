<?php

/**
 * sorter question object
 *
 * @package models
 */
class Model_SorterQuestion implements Model_QuestionInterface {

	/**
	 * @var Model_Question
	 */
	protected $question;

	/**
	 * @var array
	 */
	protected $sortedAnswers = array();


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
		return $this->question->getQuestion();
	}


	/**
	 * getter for answers-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->answers
	 */
	public function getAnswers() {
		$answers 				= $this->question->getAnswers();
		$sortAnswers 			= explode('#', $answers[3]);
		$this->sortedAnswers 	= $sortAnswers;
		shuffle($sortAnswers);
		return $sortAnswers;
	}


	/**
	 * getter for categories-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->categories
	 */
	public function getCategories() {
		return $this->question->getCategories();
	}


	/**
	 * checks if the given answerhash is right
	 * 
	 * @param string $answerHash
	 * @return boolean $result
	 */
	public function checkAnswer($answerHash) {
		$result = false;
		if ($answerHash === md5($this->answers['answer'])) {
			$result = true;
		}
		return $result;
	}

	
	/**
	 * return readable answer for given hash
	 *
	 * @author Martin Kapfhammer
 	 * @param string $answerHash
	 * @return string $result
	 */
	public function getAnswer($answerHash) {
		$answers = $this->getAnswerStrings();
		$result	 = null;
		foreach ($answers as $answer) {
			$md5Answer = md5($answer);
			if ($answerHash === $md5Answer) {
				$result = $answer;
				break;
			}
		}
		return $result;
	}


	/**
	 * returns the right answer
	 * 
	 * @author Martin Kapfhammer
 	 * @return string $this->answers['answer']
	 */
	public function getRightAnswer() {
		return $this->answers['answer'];
	}


	/**
	 * returns current questionid
	 *
	 * @author Martin Kapfhammer
	 * @return string question id
 	 */
	public function getQuestionId() {
		return $this->question['questionid'];
	}


	/**
	 * returns the type of the question
	 *
	 * @author Martin Kapfhammer
	 * @return string 
	 */
	public function getQuestionType() {
		return 'srt'; 
	}


	/**
	 * checks if there exists an answer image
	 * if not, return question image 
	 *
	 * @author Martin Kapfhammer
	 * @return string
	 */
	public function getAnswerImage() {
		if ($this->answers['image'] !== '0') {
			return $this->answers['image'];
		}
		return $this->question['image'];
	}

	public function getAnswerText() {
		return ''; 
	}

}
