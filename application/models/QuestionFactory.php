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
						break;
			case 'TXT': $question = new Model_NoMultipleChoiceQuestion($questionId, $test);
						break;
			default: throw new Model_Exception_QuestionNotFound('questionfactory', $questionType);
		} 

		if ($question->isSorterQuestion()) {
			$question = new Model_SorterQuestion($question);
		}
		return $question; 
	}
}
