<?php

/**
 * mapping bundespraesi - partei 
 *
 * @package models
 */
class Model_GeneratorMapping_BundespraesiParteiQuestionMapping extends Model_GeneratorMapping_AbstractQuestionMapping {

	protected function createQuestionTitle() {
		$praesi    = $this->answerOrg['answer'];
		$answerId  = $this->answerOrg['answerid'];
		if ($answerId === 228) {
			$question = 'In welcher Partei ist der deutsche Bundespräsident ' . $praesi . ' ?';
		} else {
			$question = 'In welcher Partei war der deutsche Bundespräsident ' . $praesi . '?';
		}
		$this->questionData['question'] = $question;
	}


	protected function createAnswer() {
		$answerId  = $this->answerOrg['answerid'];
		switch ($answerId) {
			case 152:
			case 154:
			case 228:
			case 150:
			case 151:
			case 147:
				$answer = 'CDU';
			break;
			case 153:
			case 148:
				$answer = 'SPD';
			break;
			case 146:
			case 149:
				$answer = 'FDP';
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
