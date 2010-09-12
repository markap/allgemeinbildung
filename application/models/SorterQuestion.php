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
 	 * @var array
	 */
	protected $shuffledAnswers = array();


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
		$answers 				= $this->question->getAnswersUnshuffled();
		$sortAnswers 			= explode('#', $answers['answer']);
		$keys					= ($answers['fake2'] === '') ? range(1, count($sortAnswers)) : explode('#', $answers['fake2']);
		$this->sortedAnswers 	= array('keys' 	  => $keys,
										'answers' => $sortAnswers);
		shuffle($sortAnswers);
		$this->shuffledAnswers  = array('keys'    => $keys,
										'answers' => $sortAnswers);
		return $this->shuffledAnswers;
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
		$answerIds = explode('trtrtrtr', $answer);
		$result    = true;
		foreach ($answerIds as $key => $id) {
			if (!($this->shuffledAnswers['answers'][$id] === $this->sortedAnswers['answers'][$key])) {
				$result = false; 
				break;
			}	
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
	public function getAnswer($answer) {
		return $this->sortedAnswers;
	}


	/**
	 * returns the right answer
	 * 
	 * @author Martin Kapfhammer
 	 * @return string $this->answers['answer']
	 */
	public function getRightAnswer() {
		return $this->sortedAnswers;
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
		return 'sorter';
	}

}