<?php

/**
 * sorter question object
 * for no-Multiple Choice
 *
 * @package models
 */
class Model_NoMCSorterQuestion extends Model_SorterQuestion {

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
										'answer'  => $sortAnswers);
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
		$answerIds = explode('#', $answer);
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
		return $this->question['questionid'];
	}


	/**
	 * returns the type of the question
	 *
	 * @author Martin Kapfhammer
	 * @return string 
	 */
	public function getQuestionType() {
		return 'txt'; 
	}
}
