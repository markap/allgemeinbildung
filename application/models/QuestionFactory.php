<?php

/** 
 * factory class
 * returns a question object for the given parameters
 * @package models
 */
class Model_QuestionFactory {


	/**
	 * creates a question object
	 *
	 * @author Martin Kapfhammer
	 * @static
	 * @param integer|array $questionId
	 * @throws Model_Exception_QuestionNotFound
	 * @return Model_QuestionInterface $question
	 */
	static public function getRandomQuestion($questionId, $questionType = 'MC', $test = false) {
		switch (strtoupper($questionType)) {
			case 'MC' : $question = new Model_Question($questionId, $test);
						if ($question->isSorterQuestion()) {
							$question = new Model_SorterQuestion($question);
						}
						break;
			case 'TXT': $question = new Model_NoMultipleChoiceQuestion($questionId, $test);
						if ($question->isSorterQuestion()) {
							$question = new Model_NoMCSorterQuestion($question);
						}
						break;
			default: throw new Model_Exception_QuestionNotFound('questionfactory', $questionType);
		} 
		if ($question->isMapQuestion()) {
			$question = new Model_MapQuestion($question);
		}

		return $question; 
	}
}
