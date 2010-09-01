<?php

/**
 * mapping flaggen - europe 
 *
 * @package models
 */
class Model_GeneratorMapping_FlaggenEuropeQuestionMapping extends Model_GeneratorMapping_AbstractImageQuestionMapping {

	protected function createQuestionTitle() {
		$this->questionData['question'] = 'Zu welchem Land gehört die Flagge?';
	}

	protected function createQuestionImage() {
		$fileName 	= $this->answerOrg['answer'] . '.png';
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
}
