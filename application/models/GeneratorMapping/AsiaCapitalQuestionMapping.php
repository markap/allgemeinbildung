<?php

/**
 * mapping asia - capital 
 *
 * @package models
 */
class Model_GeneratorMapping_AsiaCapitalQuestionMapping extends Model_GeneratorMapping_AbstractImageQuestionMapping {

	protected $key = 0;

	protected $data = array();

	protected $currentData;

	protected function init() {
		$this->key = 0;

		$files = $this->getFolderContent(true);
		
		foreach ($files as $key => $fileName) {
			$explodeRaute = explode('#', $fileName);
			$name 		  = $explodeRaute[0];
			$explodePoint = explode('.', $explodeRaute[1]);
			$this->data[$key] = array('name' 		=> $name,
									  'capital' 	=> $explodePoint[0],
									  'filetype' 	=> $explodePoint[1],
									  'file'		=> $fileName
									);
		}
		
	}

	protected function initEach() {
		$this->currentData = $this->data[$this->key];
		$this->key++;
	}

	protected function createQuestionTitle() {
		$question = 'Wie heißt die Haupstadt von ' . $this->formatCheck($this->currentData['name']) . '?';
		$this->questionData['question'] = $question; 
	}

	protected function createQuestionImage() {
		$fileName 	= $this->currentData['file'];
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
		$answer = $this->currentData['capital'];
		$answer = $this->formatCheck($answer);

		$this->answerData['answer'] = $answer;
	}

	protected function formatCheck($text) {
		if ($text === 'Suedkorea') $text = 'Südkorea';
		if ($text === 'Tuerkei')   $text = 'Türkei';
		if ($text === 'Pjoengjang') $text = 'Pjöngjang';
		return $text;
	}

	protected function createFakeAnswers() {
		$key = $this->key -1;
		$numberOne = ($key +2 > 45) ? $key -2 : $key +2;
		$key = $this->key -1;
		$numberTwo = ($key -1 < 0) ? $key +3 : $key -1;
		$key = $this->key -1;
		$numberThree = ($key +4 > 45) ? $key -3 : $key +4;
		$this->answerData['fake1'] = $this->formatCheck($this->getAnswer($numberOne));
		$this->answerData['fake2'] = $this->formatCheck($this->getAnswer($numberTwo));
		$this->answerData['fake3'] = $this->formatCheck($this->getAnswer($numberThree));
	}

	protected function getAnswer($key) {
		return $this->data[$key]['capital'];
	}


	protected function createCategories() {
		$this->categoriesData = array(1,9); 
	}

	
}
