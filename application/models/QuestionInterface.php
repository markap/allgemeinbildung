<?php

/**
 * question interface
 *
 * @package models
 */
interface Model_QuestionInterface {

	public function getQuestion();

	public function getAnswers();

	public function getCategories();

	public function checkAnswer($answerHash);

	public function getAnswer($answerHash);

	public function getRightAnswer();

	public function getQuestionId();

	public function getQuestionType();

	public function getAnswerImage();

	public function getAnswerText();
}
