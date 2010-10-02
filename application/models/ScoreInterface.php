<?php

/**
 * score interface
 * 
 * @package models
 */
interface Model_ScoreInterface {

	public function addRightAnswer(Model_QuestionInterface $question);
	public function addWrongAnswer(Model_QuestionInterface $question);
	public function getRightQuestions();
	public function getWrongQuestions();
}
