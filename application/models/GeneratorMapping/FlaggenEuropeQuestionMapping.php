<?php

/**
 * mapping flaggen - europe 
 *
 * @package models
 */
class Model_GeneratorMapping_Bundesland4ImageQuestionMapping extends Model_GeneratorMapping_AbstractImageQuestionMapping {

	protected function createQuestionTitle() {
		$this->questionData['question'] = 'Zu welchem Land gehört die Flagge?';
	}

	protected function createQuestionImage() {
		$answer = $this->answerOrg['answer'];
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
		$imageData	 = $this->getImageName();
		$imageMerger->merge()->save($imageData['full']);
		
		$this->questionImage = $imageData['name']; 
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
