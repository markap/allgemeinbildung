<?php

/**
 * mapping bundeskanzler - partei 
 *
 * @package models
 */
class Model_GeneratorMapping_BundeskanzlerParteiQuestionMapping extends Model_GeneratorMapping_AbstractQuestionMapping {

	protected function createQuestionTitle() {
		$kanzler   = $this->answerOrg['answer'];
		$answerId  = $this->answerOrg['answerid'];
		if ($answerId === 47) {
			$question = 'In welcher Partei ist die deutsche Bundeskanzlerin ' . $kanzler . ' ?';
		} else {
			$question = 'In welcher Partei war der deutsche Bundeskanzler ' . $kanzler . '?';
		}
		$this->questionData['question'] = $question;
	}


	protected function createAnswer() {
		$answerId  = $this->answerOrg['answerid'];
		switch ($answerId) {
			case 40:
			case 41:
			case 42:
			case 45:
			case 47:
				$answer = 'CDU';
			break;
			case 43:
			case 44:
			case 46:
				$answer = 'SPD';
			break;
		}
		$this->answerData['answer'] = $answer;
	}

	protected function createFakeAnswers() {
		$pool = array('CDU', 'CSU', 'SPD', 'FDP');
		$key  = array_search($this->answerData['answer'], $pool);
		unset($pool[$key]);
		shuffle($pool);
		
		$this->answerData['fake1'] = $pool[0];
		$this->answerData['fake2'] = $pool[1];
		$this->answerData['fake3'] = $pool[2];
	}

}
