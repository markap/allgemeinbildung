<?php

/**
 * creates the result at the end of a game 
 * 
 * @package models
 */
class Model_ResultCreator {
	

	/**
	 * @var Model_Score
	 */
	protected $score;


	/**
	 * @var string
	 */
	protected $questionType;

	
	/**
	 * @var float
	 */
	protected $percentage;

	/**
	 * @var array
	 *
	 * the following exists:
	 * 		LG -> play a learn game
	 * 		PW -> play wrong questions in learn mode
	 * 		PL -> play later (2 month) 
	 * 		PT -> play a txt game
	 * 
	 */
	protected $typeForPercentage = array(
									'percentage' => array(0.9, 0.5, 0.0),
									'type'		 => array('PL', 'PW', 'LG')
									);

	/**
	 * @var array
	 */
	protected $textForType = array(
								'LG' => 'Das kannst du sicher besser. Versuche dieses Game bald im Lernmodus zu spielen!',
								'PW' => 'Keine schlechte Leistung. Spiele deine falschen Fragen im Lernmodus, um noch besser zu werden!',
								'PL' => 'Super, auf diese Leistung kannst du stolz sein. Dieses Game kannst du sehr gut!',
								'PT' => 'Super, auf diese Leistung kannst du stolz sein. Versuche dieses Game im Direkteingabemodus zu spielen, um noch besser zu werden!'
								);
									


	/**
	 * constructor
	 * calculates percentage
	 * 
	 * @author Martin Kapfhammer
	 * @param Model_Score $score
	 * @param String $questionType
 	 */
	public function __construct(Model_Score $score, $questionType) {
		$this->score 		= $score;
		$this->questionType = $questionType;
		$this->calculatePercentage();
	}


	/**
 	 * returns the resulttype
	 *
	 * the following exists:
	 * 		LG -> play a learn game
	 * 		PW -> play wrong questions in learn mode
	 * 		PL -> play later (2 month) 
	 * 		PT -> play a txt game
	 * 
	 * @author Martin Kapfhammer
	 * @return String 
	 */
	public function getType() {
		foreach ($this->typeForPercentage['percentage'] as $_index => $_percentage) {
			if ($this->percentage >= $_percentage) {
				$type = $this->typeForPercentage['type'][$_index];
				break;
			}
		}
		if ($type === 'PL' && strtoupper($this->questionType) === 'MC') {
			$type = 'PT';
		}
		return $type;
	}


	/**
	 * returns the result text
	 * 
	 * @author Martin Kapfhammer
	 * @return String 
	 */
	public function getText() {
		$text 	 = number_format($this->percentage * 100, 2) . ' % der Fragen sind richtig beantwortet. ';
		$type 	 = $this->getType();
		$text 	.= $this->textForType[$type];
		return $text;
	}


	/**
	 * calculates the percentage of right and wrong questions
	 *
	 * @author Martin Kapfhammer
	 */
	protected function calculatePercentage() {
		$this->percentage =  $this->score->getRightAnswers() 
								/ $this->score->getPlayedQuestions();	
	}


	/**
	 * returns the result percentage
	 * 
	 * @author Martin Kapfhammer
	 * @return float 
	 */
	public function getPercentage() {
		return number_format($this->percentage * 100, 2);
	}
}
