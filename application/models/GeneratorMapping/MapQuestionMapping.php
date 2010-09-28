<?php

/**
 * map mapping 
 *
 * @package models
 */
class Model_GeneratorMapping_MapQuestionMapping extends Model_GeneratorMapping_AbstractQuestionMapping {

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
			$this->data[$key] = array('name' 	=> $explode[0],
									  'lat' 	=> $explode[1],
									  'lon' 	=> $explode[2]
									);
		}
		
	}

	protected function createCategories() {
		$this->categoriesData = array(1);
	}

	protected function initEach() {
		$this->currentData = $this->data[$this->key];
		$this->key++;
	}

	protected function createQuestionTitle() {
		$this->questionData['question'] = $this->currentData['name']; 
	}

	protected function createAnswer() {
		$this->answerData['answer'] = $this->currentData['lat'] . '#' . $this->currentData['lon']; 
	}

	protected function formatCheck($str) {return $str;}


	protected function createFakeAnswers() {
		$this->answerData['fake1'] = '#map#'; 
		$this->answerData['fake2'] = ' '; 
		$this->answerData['fake3'] = ' '; 
	}


	protected function createAnswerImage() {
		$this->answerData['image'] = 'default.jpg';
	}

	protected function createAnswerText() {
		$this->answerData['text'] = '';
	}

	
}
