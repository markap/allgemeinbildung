<?php

/**
 * learn game object
 * creates a game
 * plays a question first in txt mode, and then (if wrong) in mc mode
 *
 * @package models
 */
class Model_MCtoTXTGame extends Model_Game {
	

	/**
	 * type of the learn game
	 */
	protected $typeOfLearnGame = 'LG';

	/**
	 * questiontype
	 */
	protected $questionType = 'TXT';


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
		$result = $this->question->checkAnswer($answerHash);
		if ($result === false && $this->questionType === 'TXT') {
			array_push($this->questionIds, $this->getQuestion()->getQuestionId());
			$this->switchQuestionType();

		} else if ($this->questionType === 'MC') {
			if ($result === false) {
				$this->score->addWrongAnswer($this->question);
			} else {
				$this->score->addRightMCAnswer($this->question);
			}

			$this->switchQuestionType();
		
		} else {
			$this->score->addRightAnswer($this->question);
		} 

		return $result;	
	}

	private function switchQuestionType() {
		$this->questionType = ($this->questionType === 'MC') ? 
												'TXT' : 'MC';
	}

	/**
	 * sets the questiontype of the whole game
	 * do nothing because questiontype is always txt, 
	 * wrong answer: mc
	 *
	 * @author Martin Kapfhammer
	 * @param string $questionType
	 */
	public function setQuestionType($questionType) {
	}



	public function getGameType() {
		return 'MCTOTXTGAME';
	}

	public function setType($type) {
		$this->typeOfLearnGame = $type;
	}

	public function getType() {
		return $this->typeOfLearnGame;
	}

}
