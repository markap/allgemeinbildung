<?php

/**
 * mapping suedamerika - map 
 *
 * @package models
 */
class Model_GeneratorMapping_SuedAmerikaMapQuestionMapping extends Model_GeneratorMapping_AbstractImageQuestionMapping {

	protected $key = 0;

	protected $countries = array();

	protected $currentCountry;

	protected function init() {
		$this->key = 0;

		$files = $this->getFolderContent(true);
		
		foreach ($files as $file) {
			$this->countries[] = substr(trim($file), 0, -4);	// cut .png
		}
	}

	protected function initEach() {
		$this->currentCountry = $this->countries[$this->key];
		$this->key++;
	}

	protected function createQuestionTitle() {
		$question = 'Auf welchem Land steht das blaue Fähnchen?';
		$this->questionData['question'] = $question; 
	}

	protected function createQuestionImage() {
		$fileName 	= $this->currentCountry . '.png';;
		$exist 		= $this->existTmpImage($fileName);
		if (!$exist) {
			echo ('Nicht gefunden: ' . $fileName);
			exit();
		}

		if ($this->isTestImageCreation === false) {
			$newData = $this->getImageName();
			$name    = $newData['name'];
			$this->moveImage($fileName, $name);
			$fileName = $name;
		}
		
		$this->questionImage = $fileName;
	}

	protected function createAnswer() {
		$answer = $this->currentCountry;
		$answer = $this->formatCheck($answer);

		$this->answerData['answer'] = $answer;
	}

	protected function formatCheck($text) {
		if ($text === 'Franzoesisch-Guayana') $text = 'Französisch-Guayana';
		if ($text === 'Suedgeorgien und die Suedlichen Sandwichinseln')
			$text = 'Suedgeorgien und die Suedlichen Sandwichinseln';
		return $text;
	}

	protected function createFakeAnswers() {
		$picSum = 15;		

		$picSum = $picSum-1;
		$key = $this->key -1;
		$numberOne = ($key +2 > $picSum) ? $key -2 : $key +2;
		$key = $this->key -1;
		$numberTwo = ($key -1 < 0) ? $key +3 : $key -1;
		$key = $this->key -1;
		$numberThree = ($key +4 > $picSum) ? $key -3 : $key +4;
		$this->answerData['fake1'] = $this->formatCheck($this->getCountry($numberOne));
		$this->answerData['fake2'] = $this->formatCheck($this->getCountry($numberTwo));
		$this->answerData['fake3'] = $this->formatCheck($this->getCountry($numberThree));
	}

	protected function getCountry($key) {
		return $this->countries[$key];
	}


	protected function createCategories() {
		$this->categoriesData = array(1,12); 
	}

	
}
