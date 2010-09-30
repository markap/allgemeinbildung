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

	/**
	 * @var boolean
	 */
	protected $test = false;

	/**
	 * @var string
	 */
	protected $questionType = 'MC';

	/**
	 * @var int
	 */
	protected $gameId = null;

	/**
	 * @var integer
	 */
	protected $numberOfQuestions;



	/**
	 * constructor
	 *
	 * @author Martin Kapfhammer
	 * @param array $questionIds one or more questionIds as array
	 * @param integer $userId
	 */
	public function __construct(array $questionIds, Model_Score $score) {
		$this->questionIds 	= array_reverse($questionIds);	
		$this->score 		= $score; 
		$this->numberOfQuestions = count($this->questionIds);
	}

	public function setTest($isTest) {
		$this->test = $isTest;
	}

	public function setGameId($gameId) {
		$this->gameId = $gameId;
	}

	public function getGameId() {
		return $this->gameId;
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
		$this->question = 
			Model_QuestionFactory::getRandomQuestion(
				$nextId, 
				$this->questionType, 
				$this->test);
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
		if ($result === true) { //right answer
			$this->score->addRightAnswer($this->question);
		} else { // wrong answer
			$this->score->addWrongAnswer($this->question);
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
	 * returns the question type
	 *
	 * @author Martin Kapfhammer
	 * @return string $this->getQuestiontype;
	 */
	public function getQuestionType() {
		return $this->questionType;
	}
	

	/**
	 * shuffles the questionIds
	 *
	 * @author Martin Kapfhammer
	 */
	public function shuffleQuestionIds() {
		shuffle($this->questionIds);
	}

	
	/**
	 * returns the number of question
	 * 
	 * @author Martin Kapfhammer
	 * @return integer number of questions
	 */
	public function getNumberOfQuestions() {
		return $this->numberOfQuestions; 
	}
	

	/*
	 * returns the number of question left to play
	 * 
	 * @author Martin Kapfhammer
	 * @return integer number of questions
	 */
	public function getCurrentNumberOfQuestions() {
		return count($this->questionIds)+1;
	}


	public function getGameType() {
		return 'GAME';
	}
}
