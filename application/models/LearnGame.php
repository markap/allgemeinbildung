<?php

/**
 * learn game object
 * creates a game
 * all questionids must be played double
 * if a answer is false, you must repeat the answer
 * as long as it is right
 *
 * @package models
 */
class Model_LearnGame extends Model_Game {
	
	/**
	 * the ids of the questionIds-array
	 * @var array
	 */
	protected $copiedQuestionIds = array();

	/**
	 * the ids of the wrongQuestionIds-array
	 * @var array
	 */
	protected $wrongQuestionIds  = array();

	/**
	 * type of the learn game
	 */
	protected $typeOfLearnGame = 'LG';

	protected $numberOfWrongQuestions = 0;
	
	protected $mode = 0;
	

	/**
	 * constructor
	 *
	 * @author Martin Kapfhammer
	 * @param array $questionIds one or more questionIds as array
	 * @param integer $userId
	 */
	public function __construct(array $questionIds, Model_ScoreInterface $score) {
		parent::__construct($questionIds, $score);
		$this->shuffleQuestionIds();
		$this->copiedQuestionIds = $this->questionIds;
	}


	/**
	 * checks if $this->questionIds contains any values
	 * if not, add the copiedQuestionIds
	 * if does not contain anything
	 * add wrongQuestionIds
	 *
	 * @author Martin Kapfhammer
	 * @return boolean
	 */
	protected function existNextQuestion() {
		$existNextQuestion = parent::existNextQuestion();

		// add the copiedQuestionIds
		if ($existNextQuestion === false) {
			$this->mode = 1;
			$this->score->setNext();
			$this->questionIds = $this->copiedQuestionIds;	
			$this->shuffleQuestionIds();
			$this->copiedQuestionIds = array();
		}
		$existNextQuestion = parent::existNextQuestion();

		// add the wrongQuestionIds
		if ($existNextQuestion === false) {
			$this->mode = 2;
			$this->score->setNext();
			$this->questionIds = $this->wrongQuestionIds;	
			$this->shuffleQuestionIds();
			$this->wrongQuestionIds = array();
		}
		return parent::existNextQuestion();
	}


	/**
	 * when the answer is wrong,
	 * add the questionId to the wrongQuestionIds - array
	 *
	 * @author Martin Kapfhammer
	 * @param string $answerHash
	 * @return boolean $result
	 */
	public function checkAnswer($answerHash) {
		$result = parent::checkAnswer($answerHash);
		if ($result === false) {
			$this->wrongQuestionIds[] = $this->getQuestion()->getQuestionId();
			$this->numberOfWrongQuestions++;
		}
		return $result;	
	}


	/**
	 * returns the number of questions left to play
	 * 
	 * @author Martin Kapfhammer
 	 * @return integer
	 */
	public function getCurrentNumberOfQuestionsForKey($key) {
		$number = 0;
		switch ($key) {
			case 0: $number = ($this->mode === 0) ? count($this->questionIds)+1 : 0; break;
			case 1: if ($this->mode === 0) $number = $this->numberOfQuestions;
					if ($this->mode === 1) $number = count($this->questionIds)+1;
					if ($this->mode === 2) $number = 0;
					break;
			case 2: $number = ($this->mode === 2) ? count($this->questionIds) + count($this->wrongQuestionIds)+1 : count($this->wrongQuestionIds); 
					break;
		}
		return $number; 
	}

	public function getGameType() {
		return 'LEARNGAME';
	}

	public function setType($type) {
		$this->typeOfLearnGame = $type;
	}

	public function getType() {
		return $this->typeOfLearnGame;
	}

	public function getNumberOfQuestionsForKey($key) {
		return ($key === 0 || $key === 1) ? $this->numberOfQuestions  : $this->numberOfWrongQuestions; 
	}
}
