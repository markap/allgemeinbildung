<?php

/**
 * mapping flaggen - asia 
 *
 * @package models
 */
class Model_GeneratorMapping_FlaggenAsiaQuestionMapping extends Model_GeneratorMapping_AbstractImageQuestionMapping {

	protected function createQuestionTitle() {
		$this->questionData['question'] = 'Zu welchem Land gehört die Flagge?';
	}

	protected function createQuestionImage() {
		$fileName 	= $this->answerOrg['answer'] . '.png';
		$fileName   = $this->formatCheck($fileName);
	
		$exist 		= $this->existTmpImage($fileName);
		if (!$exist) {
			throw new Exception('Nicht gefunden: ' . $fileName);
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

	protected function formatCheck($text) {
		if ($text === 'Südkorea.png') $text = 'Suedkorea.png';
		if ($text === 'Türkei.png')   $text = 'Tuerkei.png';
		return $text;
	}


	protected function createCategories() {
		$this->categoriesData = array(5,6); 
	}
}
