<?php

/**
 * mapping bundesland - 4img 
 *
 * @package models
 */
class Model_GeneratorMapping_Bundesland4ImageQuestionMapping extends Model_GeneratorMapping_AbstractQuestionMapping {

	protected $answerKey;

	protected function createQuestionTitle() {
		$land    = $this->answerOrg['answer'];
		$question = 'In welchen Bild steht das Fähnchen auf ' . $land . ' ?';
		$this->questionData['question'] = $question;
	}

	protected function createQuestionImage() {
		$otherIds 		= $this->getThreeOtherIds();
		$questionImage 	= $this->questionOrg['image'];

		$images	  = array();
		foreach ($otherIds as $id) {
			$images[] = $this->getImage($id);
		}
		$images = array_merge(array($questionImage), $images);
		shuffle($images);
		$this->answerKey = array_search($questionImage, $images);

        $imageMerger = new Model_GeneratorMapping_ImageMerge($images);
		//$newImageName  = Model_DbTable_Helper::getInstance()->getImageNumber();
        $imageMerger->merge()->save('tmp/' . $this->getCurrentId() . '.jpg');
		
		$this->questionImage = $this->getCurrentId() . '.jpg';	
	}

	protected function getImage($questionId) {
		$question = $this->questionDb->getQuestion($questionId);
		return $question['image'];
	}


	protected function createAnswer() {
		$this->answerData['answer'] = $this->imageAnswers[$this->answerKey];
	}

	protected function createFakeAnswers() {
		$pool = $this->imageAnswers;
		$key  = array_search($this->answerData['answer'], $pool);
		unset($pool[$key]);
		shuffle($pool);
		
		$this->answerData['fake1'] = $pool[0];
		$this->answerData['fake2'] = $pool[1];
		$this->answerData['fake3'] = $pool[2];
	}

}
