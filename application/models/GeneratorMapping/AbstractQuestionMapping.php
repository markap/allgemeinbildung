<?php

/**
 * abstract superclass for mapping for new questions 
 *
 * @package models
 */
abstract class Model_GeneratorMapping_AbstractQuestionMapping {


	/**
	 * a question array
	 */
	protected $questionOrg;
	protected $answerOrg;
	protected $categoriesOrg;
	protected $userId;

	protected $questionDb;
	protected $answerDb;
	protected $hasCategoryDb;

	/**
	 * values: question, hint
	 * @var array
	 */
	protected $questionData = array();

	protected $questionImage;

	/**
	 * values: answer, fake1, fake2, fake3, image, text
	 * @var array
	 */
	protected $answerData = array();

	protected $categoriesData = array();


	public function __construct($questionId, $userId) {
		$this->questionDb 	  		= new Model_DbTable_Question();
		$this->answerDb 		  	= new Model_DbTable_Answer();
		$this->hasCategoryDb 	  	= new Model_DbTable_HasCategory();
		$this->questionOrg   		= $this->questionDb->getQuestion($questionId);
		$this->answerOrg	 		= $this->answerDb->getAnswer($this->questionOrg['answerid']);
		$this->categoriesOrg 		= $this->hasCategoryDb->getCategoryIds($questionId);
		$this->userId				= $userId;
	}

	public function map() {
		$this->createQuestionTitle();
		$this->createQuestionHint();
		$this->createQuestionImage();
		$this->createAnswer();
		$this->createFakeAnswers();
		$this->createAnswerImage();
		$this->createAnswerText();
		$this->createCategories();
		
		return $this;
	}

	protected function createQuestionTitle() {
		$this->questionData['question'] = $this->questionOrg['question']; 
	}

	protected function createQuestionHint() {
		$this->questionData['hint'] = $this->questionOrg['hint'];
	}

	protected function createQuestionImage() {
		$this->questionImage = $this->questionOrg['image'];
	}

	protected function createAnswer() {
		$this->answerData['answer'] = $this->answerOrg['answer'];
	}

	protected function createFakeAnswers() {
		$this->answerData['fake1'] = $this->answerOrg['fake1'];
		$this->answerData['fake2'] = $this->answerOrg['fake2'];
		$this->answerData['fake3'] = $this->answerOrg['fake3'];
	}

	protected function createAnswerImage() {
		$this->answerData['image'] = $this->answerOrg['image'];
	}

	protected function createAnswerText() {
		$this->answerData['text'] = $this->answerOrg['text'];
	}

	protected function createCategories() {
		$this->categoriesData = $this->categoriesOrg;
	}

	public function getValues() {
		$categoryDb  = new Model_DbTable_Category();
        $categories  = array();
        foreach ($this->categoriesData as $categoryId) {
            $category       = $categoryDb->getCategory($categoryId);
            $categories[]   = $category['name'];
        }

		$question = $this->questionData;
		$question['image'] = $this->questionImage;

		return array(
					$question,
					$this->answerData,
					$categories
					);
	}

	public function save() {
		$answerId 	= $this->answerDb->getNextAnswerId();
		$questionId = $this->questionDb->insertQuestion($this->questionData, 
														$answerId, 
														$this->questionImage, 
														$this->userId);
		$this->answerDb->insertAnswer($this->answerData, $answerId);
		$this->hasCategoryDb->insertRelation($questionId, $this->categoriesData);
	}
}
