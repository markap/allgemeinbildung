<?php

/**
 * mapping brd - capital 
 *
 * @package models
 */
class Model_GeneratorMapping_BRDCapitalQuestionMapping extends Model_GeneratorMapping_AbstractImageQuestionMapping {

	protected $key = 0;

	protected $data = array();

	protected $currentData;

	protected function init() {
		$this->key = 0;

		$files = $this->getFolderContent(true);
		
		foreach ($files as $key => $fileName) {
			$explodeRaute = explode('#', $fileName);
			$explodePoint = explode('.', $explodeRaute[4]);
			$this->data[$key] = array('answer' 		=> $explodeRaute[1],
									  'fake1'		=> $explodeRaute[2],
									  'fake2'		=> $explodeRaute[3],
									  'question'	=> $explodeRaute[0],
									  'fake3' 		=> $explodePoint[0],
									  'filename' 	=> $fileName
									);
		}
		
	}

	protected function initEach() {
		$this->currentData = $this->data[$this->key];
		$this->key++;
	}

	protected function createQuestionTitle() {
		$question = 'Wie lautet die Haupstadt des Bundeslands ' . $this->formatCheck($this->currentData['question']) . '?';
		$this->questionData['question'] = $question; 
	}

	protected function createQuestionImage() {
		$fileName 	= $this->currentData['filename'];
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
		$answer = $this->currentData['answer'];
		$answer = $this->formatCheck($answer);

		$this->answerData['answer'] = $answer;
	}

	protected function formatCheck($text) {
		if ($text === 'Muenchen') $text = 'München';
		if ($text === 'Thueringen')   $text = 'Thüringen';
		if ($text === 'Nuernberg') $text = 'Nürnberg';
		if ($text === 'Koeln') $text = 'Köln';
		if ($text === 'Saarbruecken') $text = 'Saarbrücken';
		if ($text === 'Luebeck') $text = 'Lübeck';
		if ($text === 'Neumuenster') $text = 'Neumünster';
		return $text;
	}

	protected function createFakeAnswers() {
		$this->answerData['fake1'] = $this->formatCheck($this->currentData['fake1']);
		$this->answerData['fake2'] = $this->formatCheck($this->currentData['fake2']);
		$this->answerData['fake3'] = $this->formatCheck($this->currentData['fake3']);
	}




	
}
