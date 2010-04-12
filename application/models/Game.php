<?php

/**
 * game object
 * creates a game
 *
 * @package models
 */
class Model_Game {
	
	/**
	 * the ids of the question the player must play
	 * @var array
	 */
	protected $questionIds = array();

	/**
	 * current question-object
	 * @var Model_Question
	 */
	protected $question = null;

	/**
	 * @var Model_Score
	 */
	protected $score = null;

	protected $test = false;

	protected $questionType = null;


	/**
	 * constructor
	 *
	 * @author Martin Kapfhammer
	 * @param array $questionIds one or more questionIds as array
	 * @param integer $userId
	 */
	public function __construct(array $questionIds, $userId = null, $test = false) {
		$this->questionIds = array_reverse($questionIds);	
		if ($userId === null) {
			$this->score = new Model_Score();
		} else {
			$this->score = new Model_LogScore($userId);
		}
		$this->test = $test;
	}
	
	
	/**
	 * inits and returns the next question-object
	 *
	 * @author Martin Kapfhammer
	 *
	 * @throws Model_Exception_GameEndException 
	 * @return Model_Question
	 */
	public function nextQuestion() {
		if ($this->existNextQuestion() === false) {
			throw new Model_Exception_GameEnd();
		}	
		$nextId = array_pop($this->questionIds);
		$this->question = Model_QuestionFactory::getRandomQuestion($nextId, $this->questionType, $this->test);
		return $this->question;
	}


	/**
	 * checks if $this->questionIds contains any values
	 *
	 * @author Martin Kapfhammer
	 * @return boolean
	 */
	protected function existNextQuestion() {
		return (count($this->questionIds) !== 0);
	}

	
	/**
	 * getter for the current question-object
	 *
	 * @author Martin Kapfhammer
	 * @return Model_Question $this->question
	 */
	public function getQuestion() {
		return $this->question;
	}


	/**
	 * getter for the score-object
	 *
	 * @author Martin Kapfhammer
	 * @return Model_Score $this->score
	 */
	public function getScore() {
		return $this->score;
	}


	/**
	 * when you play a game, the answer must be checked
	 * by the game object also, so you can
	 * modify the score class
	 * deletegate checking to the question-object
	 *
	 * @author Martin Kapfhammer
	 * @param string $answerHash
	 * @return boolean $result
	 */
	public function checkAnswer($answerHash) {
		$result = $this->question->checkAnswer($answerHash);
		$this->addScore($result);
		return $result;	
	}


	/**
	 * add right or wrong answers to score
	 *
	 * @author Martin Kapfhammer
	 * @param boolean $result
	 */
	protected function addScore($result) {
		$questionId   = $this->question->getQuestionId();
		$questionType = $this->question->getQuestionType();
		if ($result === true) { //right answer
			$this->score->addRightAnswer($questionId, $questionType);

		} else { // wrong answer
			$this->score->addWrongAnswer($questionId, $questionType);
		}
	}


	/**
	 * sets the questiontype of the whole game
	 *
	 * @author Martin Kapfhammer
	 * @param string $questionType
	 */
	public function setQuestionType($questionType) {
		$this->questionType = $questionType;
	}

	
	/**
	 * shuffles the questionIds
	 *
	 * @author Martin Kapfhammer
	 */
	public function shuffleQuestionIds() {
		shuffle($this->questionIds);
	}

}
