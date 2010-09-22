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
		$answerIds = explode('trtrtrtr', $answer);

		// remove last element
		unset($answerIds[count($answerIds)-1]);

		$result    = true;
		foreach ($answerIds as $key => $id) {
			if ($this->shuffledAnswers['answers'][$id] !== $this->sortedAnswers['answers'][$key]) {
				$this->wrongIds[] = $key;
				$result = false; 
			}	
		}
		return $result;
	}

	
	/**
	 * return my answer
	 *
	 * @author Martin Kapfhammer
 	 * @param string $answerHash
	 * @return string $result
	 */
	public function getAnswer($answer) {
		$answerIds = explode('trtrtrtr', $answer);

		// remove last element
		unset($answerIds[count($answerIds)-1]);


		$myAnswers = array();
		foreach ($answerIds as $key => $id) {
			$myAnswers[] = $this->shuffledAnswers['answers'][$id];
		}
		return array('answers' => $myAnswers,
					 'wrong'   => $this->wrongIds);
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
		return 'map';
	}

}
