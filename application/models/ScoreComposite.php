<?php

/**
 * score object for more scores
 * used for learn games 
 * 
 * @package models
 */
class Model_ScoreComposite implements Model_ScoreInterface {
	
	/**
 	 * @var Model_ScoreInterface
	 */
	protected $childs = array();

	protected $index = 0;

	public function addChild(Model_ScoreInterface $score) {
		$this->childs[] = $score;
	}

	public function setNext() {
		$this->index++;
		if ($this->index >=  count($this->childs)) {
			$this->index = count($this->childs) -1;
		}
	}

	protected function getCurrentChild() {
		return $this->childs[$this->index];	
	} 

	public function getChilds() {
		return $this->childs;
	}	

	/**
	 * increments the wrong answers
	 * and the played questions
	 *
	 * @author Martin Kapfhammer
	 * @param Model_QuestionInterface $question
	 */
	public function addWrongAnswer(Model_QuestionInterface $question) {
		$this->getCurrentChild()->addWrongAnswer($question);
	}

	public function addRightAnswer(Model_QuestionInterface $question) {
		$this->getCurrentChild()->addRightAnswer($question);
	}


	/**
	 * getter for the right question objects
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestions
	 */
	public function getRightQuestions() {
		$rightQuestions = array();
		foreach ($this->childs as $child) {
			$rightQuestions = array_merge($child->getRightQuestions(), $rightQuestions);	
		}
		return $rightQuestions;
	}


	/**
	 * getter for the wrong question objects
	 *
	 * @author Martin Kapfhammer
	 * @return array $this->rightQuestions
	 */
	public function getWrongQuestions() {
		$wrongQuestions = array();
		foreach ($this->childs as $child) {
			$wrongQuestions = array_merge($child->getWrongQuestions(), $wrongQuestions);	
		}
		return $wrongQuestions;
	}

	

}
