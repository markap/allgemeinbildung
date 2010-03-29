<?php

/** 
 * factory class
 * returns a question object for the given parameters
 * @package models
 */
class Model_QuestionFactory {

	/**
	 * @var integer
	 * @static 
	 */
	static private $questionId;


	/**
	 * creates a question object, usually randomized
	 * the param questionId could also be an array with the param for
	 * the kind of the question object
	 * e.g. $questionId = array('id' => 3, 'type' => 'mc');
	 * available type-params are mc (multiple choice) and txt (Textfield)
	 *
	 * @author Martin Kapfhammer
	 * @static
	 * @param integer|array $questionId
	 * @throws Model_Exception_QuestionNotFound
	 * @return Model_QuestionInterface $question
	 */
	static public function getRandomQuestion($questionId) {
		$questionType = self::getQuestionType($questionId);
		switch (strtoupper($questionType)) {
			case 'MC' : $question = new Model_Question(self::$questionId);
						break;
			case 'TXT': $question = new Model_NoMultipleChoiceQuestion(self::$questionId);
						break;
			default: throw new Model_Exception_QuestionNotFound('questionfactory', $questionType);
		} 
		return $question; 
	}


	/**
	 * return the question type
	 * create it from given parameter or random
 	 *
	 * @author Martin Kapfhammer
	 * @static
	 * @param integer|array $questionId
	 * @throws Model_Exception_QuestionNotFound
	 * @return string $questionType
	 */
	static private function getQuestionType($questionId) {
		self::$questionId = $questionId;
		if (is_array($questionId)) {
			self::$questionId = $questionId['id'];
			$questionType = $questionId['type'];					
			if (self::isQuestionType($questionType) === true) return $questionType;
		} 
		$questionTypeAsNumber = rand(1,2);
		switch ($questionTypeAsNumber) {
			case 1: $questionType = 'mc'; break; 
			case 2: $questionType = 'txt'; break; 
			default: throw new Model_Exception_QuestionNotFound('questionfactory', $questionTypeAsNumber);
		}
		return $questionType;
	}


	/**
	 * checks if the given questionType is valid
	 *
	 * @author Martin Kapfhammer
	 * @static
	 * @param string $questionType
	 * @return boolean 
	 */
	static private function isQuestionType($questionType) {
		$availableTypes = array('mc', 'txt');
		return (in_array($questionType, $availableTypes));
	}

}
