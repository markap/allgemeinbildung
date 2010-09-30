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
	 * constructor
	 *
	 * @author Martin Kapfhammer
	 * @param array $questionIds one or more questionIds as array
	 * @param integer $userId
	 */
	public function __construct(array $questionIds, Model_Score $score, $test = false) {
		parent::__construct($questionIds, $score, $test);
		$this->shuffleQuestionIds();
		$this->copiedQuestionIds = $this->questionIds;
		$this->numberOfQuestions = $this->numberOfQuestions * 2;
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
			$this->questionIds = $this->copiedQuestionIds;	
			$this->shuffleQuestionIds();
			$this->copiedQuestionIds = array();
		}
		$existNextQuestion = parent::existNextQuestion();

		// add the wrongQuestionIds
		if ($existNextQuestion === false) {
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
			$this->numberOfQuestions++;
		}
		return $result;	
	}


	/**
	 * returns the number of questions left to play
	 * 
	 * @author Martin Kapfhammer
 	 * @return integer
	 */
	public function getCurrentNumberOfQuestions() {
		$number = count($this->questionIds);
		$number += count($this->copiedQuestionIds);
		$number += count($this->wrongQuestionIds);
		return $number+1;
	}

	public function getGameType() {
		return 'LEARNGAME';
	}
}
