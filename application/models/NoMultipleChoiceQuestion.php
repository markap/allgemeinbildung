<?php

/**
 * question object without multiple choice
 *
 * @package models
 */
class Model_NoMultipleChoiceQuestion extends Model_Question {

	public function getAnswers() {
		return 'nochoice';
	}

	/**
	 * 
	 */
	public function checkAnswer($answer) {
		$result = false;
		// TODO besserer vergleich
		if ($answer === $this->answers['answer']) {
			$result = true;
		}		
		return $result;
	}
}
