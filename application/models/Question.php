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
	protected $question = array();

	/**
	 * answer array with the data from db
	 * @var array
	 */
	protected $answers = array();

	/**
	 * category  array with the data from db
	 * @var array
	 */
	protected $categories = array();

	/**
	 * constructor
	 * creates a new Question-object with given id
	 *
	 * @author Martin Kapfhammer
	 * @param string $questionId
	 */
	public function __construct($questionId, $test = false) {
		$questionDb 	  = new Model_DbTable_Question();
		$answerDb 		  = new Model_DbTable_Answer();
		$hasCategoryDb 	  = new Model_DbTable_HasCategory();
		$this->question   = $questionDb->getQuestion($questionId, $test);
		$this->answers	  = $answerDb->getAnswer($this->question['answerid']);
		$this->categories = $hasCategoryDb->getCategories($questionId);
	}


	/**
	 * getter for question-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->question
	 */
	public function getQuestion() {
		return $this->question;
	}


	/**
	 * getter for answers-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->answers
	 */
	public function getAnswers() {
		$answers = $this->getAnswerStrings();
		$answers = $this->shuffleAnswers($answers);
		$answers = $this->createHashes($answers);
		return $answers;
	}

	
	/**
	 * creates a array with answerstrings only 
	 * from the answers array
	 *
	 * @author Martin Kapfhammer	
	 * @return array $answerStrings
	 */
	protected function getAnswerStrings() {
		$answerStrings = array($this->answers['answer'],
						 	   $this->answers['fake1'],
						 	   $this->answers['fake2'],
						 	   $this->answers['fake3']
							);
		return $answerStrings;
	}


	/**
	 * Wrapper for the php shuffle function
	 * to ensure callback value
	 * and better reading
	 *
	 * shuffle not all answers
	 * e.g. do not shuffle bild a, bild b etc...
	 *
	 * @author Martin Kapfhammer
	 * @param array $answers 
	 * @return array $answers shuffled array
	 */
	protected function shuffleAnswers(array $answers) {
		if (!in_array('Bild A', $answers)) {
			shuffle($answers);
		} else {
			$answers = array('Bild A', 'Bild B', 'Bild C', 'Bild D');
		}
		return $answers;
	}


	/**
	 * creates a array with answer and answer hashes
	 *
	 * @author Martin Kapfhammer
	 * @param array $answers 
	 * @return array $answers answers with hashes
	 */
	protected function createHashes(array $answers) {
		$answerHashes = array();
		$key = 0;
		foreach ($answers as $answer) {
			$answerHashes[$key++] = md5($answer);
			$answerHashes[$key++] = $answer;
		}
		return $answerHashes;
	}


	/**
	 * getter for categories-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->categories
	 */
	public function getCategories() {
		return $this->categories;
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
	 * @return string self::TYPE
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
		if ($this->answers['image'] !== '0') {
			return $this->answers['image'];
		}
		return $this->question['image'];
	}

	public function getAnswerText() {
		$answerText = $this->answers['text'];
		return ($answerText !== '') ? $answerText : '';
	}

}
