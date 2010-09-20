<?php

/**
 * sorter question object
 * for no-Multiple Choice
 *
 * @package models
 */
class Model_NoMCSorterQuestion extends Model_SorterQuestion {

	/**
	 * getter for answers-array
	 *
	 * @author Martin Kapfhammer
	 * @return $this->answers
	 */
	public function getAnswers() {
		$answers 				= $this->question->getAnswersUnshuffled();
		$sortAnswers 			= explode('#', $answers['answer']);
		$keys					= ($answers['fake2'] === '') ? range(1, count($sortAnswers)) : explode('#', $answers['fake2']);
		$this->sortedAnswers 	= array('keys' 	  => $keys,
										'answers' => $sortAnswers);
		$this->shuffledAnswers  = array('keys'    => $keys);
		return $this->shuffledAnswers;
	}


	/**
	 * checks if the given sorted answer is right
	 * 
	 * @param string $answerHash
	 * @return boolean $result
	 */
	public function checkAnswer($answer) {
		$answers = explode('trtrtrtr', $answer);

		// remove last element
		unset($answers[count($answers)-1]);

		$result    = true;
		$wrongIds  = array();
		foreach ($answers as $key => $answer) {
			$rightAnswer = $this->sortedAnswers['answers'][$key];
			if ($answer !== $rightAnswer) {
				$answer 		= $this->question->modifyAnswer($answer);	
				$rightAnswer 	= $this->question->modifyAnswer($rightAnswer);
				if ($answer !== $rightAnswer) {
					$this->wrongIds[] = $key;
					$result = false;
				}
			}	
		}
		return $result;
	}

	
	/**
	 * return my answer 
	 *
	 * @author Martin Kapfhammer
 	 * @param string $answerHash
	 * @return string $result
	 */
	public function getAnswer($answer) {
		$answers = explode('trtrtrtr', $answer);

		// remove last element
		unset($answers[count($answers)-1]);
		return array('answers' => $answers,
					 'wrong'   => $this->wrongIds);
	}


	/**
	 * returns the type of the question
	 *
	 * @author Martin Kapfhammer
	 * @return string 
	 */
	public function getQuestionType() {
		return 'txt'; 
	}
}
