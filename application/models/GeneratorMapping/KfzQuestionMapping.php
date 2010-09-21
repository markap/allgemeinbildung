<?php

/**
 * mapping kfz 
 *
 * @package models
 */
class Model_GeneratorMapping_KfzQuestionMapping extends Model_GeneratorMapping_AbstractQuestionMapping {

	protected $key = 0;

	protected $data = array();

	protected $currentData;

	protected function init() {
		$this->key = 0;

		$file = file('tmp/file.txt');
		foreach ($file as $key => $entry) {
    		if (trim($entry) === "") {
    			unset($file[$key]);
    		}
		} 

		foreach ($file as $key => $entry) {
			$explode = explode('#', $entry);
			$this->data[$key] = array('kfz' 	=> $explode[0],
									  'name' 	=> $explode[1],
									  'img' 	=> $explode[2]
									);
		}
		
	}

	protected function initEach() {
		$this->currentData = $this->data[$this->key];
		$this->key++;
	}

	protected function createQuestionTitle() {
		$question = 'Wofür steht das folgende Kfz-Kennzeichen: ' . $this->currentData['kfz'];
		$this->questionData['question'] = $question; 
	}

	protected function createAnswer() {
		$answer = $this->currentData['name'];
		$this->answerData['answer'] = $answer;
	}

	protected function formatCheck($str) {return $str;}


	protected function createFakeAnswers() {
		$sum = count($this->questionIds) -1;
		$key = $this->key -1;
		$numberOne = ($key +2 > $sum) ? $key -2 : $key +2;
		$key = $this->key -1;
		$numberTwo = ($key -1 < 0) ? $key +3 : $key -1;
		$key = $this->key -1;
		$numberThree = ($key +4 > $sum) ? $key -3 : $key +4;
		$this->answerData['fake1'] = $this->formatCheck($this->getAnswer($numberOne));
		$this->answerData['fake2'] = $this->formatCheck($this->getAnswer($numberTwo));
		$this->answerData['fake3'] = $this->formatCheck($this->getAnswer($numberThree));
	}

	protected function getAnswer($key) {
		return $this->data[$key]['name'];
	}

	protected function createAnswerImage() {
		$img = null;
		switch (trim($this->currentData['img'])) {
			case 'BY': $img = '32.jpg'; break;
			case 'BW': $img = '33.png'; break;
			case 'BR': $img = '46.gif'; break;
			case 'R': $img = '37.jpg'; break;
			case 'H': $img = '35.png'; break;
			case 'SH': $img = '39.jpg'; break;
			case 'SA': $img = '41.png'; break;
			case 'S': $img = '40.jpg'; break;
			case 'SAA': $img = '38.jpg'; break;
			case 'T': $img = '47.png'; break;
			case 'N': $img = '42.png'; break;
			case 'NRW': $img = '44.png'; break;
			case 'HB': $img = '48.gif'; break;
			case 'HH': $img = '43.jpg'; break;
			case 'MP': $img = '36.png'; break;
			default: $img = '32.jpg';
		}
		$this->answerData['image'] = $img;
	}

	protected function createAnswerText() {
		$img = null;
		switch (trim($this->currentData['img'])) {
			case 'BY': $img = 'Bayern'; break;
			case 'BW': $img = 'Baden-Württemberg'; break;
			case 'BR': $img = 'Brandenburg'; break;
			case 'R': $img = 'Rheinland-Pfalz'; break;
			case 'H': $img = 'Hessen'; break;
			case 'SH': $img = 'Schleswig-Holstein'; break;
			case 'SA': $img = 'Sachsen-Anhalt'; break;
			case 'S': $img = 'Sachsen'; break;
			case 'SAA': $img = 'Saarland'; break;
			case 'T': $img = 'Thüringen'; break;
			case 'N': $img = 'Niedersachsen'; break;
			case 'NRW': $img = 'Nordrhein-Westfalen'; break;
			case 'HB': $img = 'Bremen'; break;
			case 'HH': $img = 'Hamburg'; break;
			case 'MP': $img = 'Mecklenburg-Vorpommern'; break;
			default: $img = 'Bayern';
		}
		$text = 'Dieser Ort liegt in ' . $img;

		$this->answerData['text'] = $text;
	}

	
}
