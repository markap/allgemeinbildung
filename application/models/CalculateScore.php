<?php

/**
 * calculates the score of your game 
 * 
 * @package models
 */
class Model_CalculateScore {
	
	/**
	 * score for a right answer listed by level
	 * @var array
	 */
	protected $scoreForLevel = array(
						1 => 20,
						2 => 50,
						3 => 80,
						4 => 95,
						5 => 110
							);

	/**
	 * multiply score with this factor,
	 * when questiontype is txt
	 * listed by level
	 * @var array
	 */
	protected $multiForLevel = array(
						1 => 2,
						2 => 3,
						3 => 4,
						4 => 4,
						5 => 4
							);

	/**
	 * @var Model_Score
	 */
	protected $score = null;


	/**
	 * constructor
	 * 
	 * @author Martin Kapfhammer
	 * @param Model_Score $score
 	 */
	public function __construct(Model_Score $score) {
		$this->score = $score;
	}


	/**
 	 * returns the calculated score
	 * 
	 * @author Martin Kapfhammer
	 * @return integer $calculatedScore
	 */
	public function getScore() {
		$calculatedScore = $this->calculateScore();
		return $calculatedScore;
	}


	/**
	 * calculate the score for the right questions
	 * add the levelscore
	 * add the txt questiontype bonus
	 * add the long game bonus
	 * 
	 * @author Martin Kapfhammer
	 * @return integer $score
	 */
	protected function calculateScore() {
		$rightQuestions = $this->score->getRightQuestions();
		$score 			= 0; 
		foreach ($rightQuestions as $question) {
			$questionScore = $this->getScoreForLevel($question);
			$questionScore = $questionScore * $this->getMultiForLevel($question);
			$questionScore += $this->getLongGameBonus();
			$score += $questionScore;
		}
		return $score;
	}


	/**
	 * returns the score for level
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 * @return integer the level score
	 */
	protected function getScoreForLevel(Model_QuestionInterface $question) {
		return $this->scoreForLevel[1];
	}

	
	/**
 	 * returns the multiplicator for a level 
	 * if questiontype is txt
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 * @return integer the multiplicator
	 */
	protected function getMultiForLevel(Model_QuestionInterface $question) {
		if ($this->isTXTQuestion($question)) {
			return $this->multiForlevel[1];
		}
		return 1;
	}	


	/**
	 * checks if questiontype is TXT
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 * @return boolean 
	 */
	protected function isTXTQuestion(Model_QuestionInterface $question) {
		return ($question->getQuestionType() === 'TXT');
	}

	
	/**
	 * returns the long game bonus
	 * 
	 * @author Martin Kapfhammer
	 * @return integer the long game bonus
	 */
	protected function getLongGameBonus() {
		$playedQuestions = $this->countQuestions();
		if ($playedQuestions >= 25) {
			return 15; 
		}
		if ($playedQuestions >= 20) {
			return 10; 
		}
		if ($playedQuestions >= 10) {
			return 5; 
		}
		return 0;
	}


	/**
	 * counts the questions of this game
	 * 
	 * @author Martin Kapfhammer
	 * @return integer $questionSize
	 */
	protected function countQuestions() {
		$wrongQuestionSize = count($this->score->getWrongQuestions());	
		$rightQuestionSize = count($this->score->getRightQuestions());
		$questionSize 	   = $wrongQuestionSize + $rightQuestionSize;
		return $questionSize;
	}
}
