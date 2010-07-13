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
									'type'		 => array('PL', 'LG', 'PW')
									);
									


	/**
	 * constructor
	 * 
	 * @author Martin Kapfhammer
	 * @param Model_Score $score
	 * @param String $questionType
 	 */
	public function __construct(Model_Score $score, $questionType) {
		$this->score 		= $score;
		$this->questionType = $questionType;
	}


	/**
 	 * returns the resulttype
	 *
	 * the following exists:
	 * 		LG -> play a learn game
	 * 		PA -> play again now
	 * 		PW -> play wrong questions in learn mode
	 * 		PL -> play later (2 month) 
	 * 		PT -> play a txt game
	 * 
	 * @author Martin Kapfhammer
	 * @return String 
	 */
	public function getType() {
		$percentage = $this->calculatePercentage();
		foreach ($typeForPercentage['percentage'] as $index => $p) {
			if ($percentage >== $p) {
				$type = $typeForPercentage['type'][$index];
				break;
			}
		}
		if ($type === 'PL' && $this->questionType === 'MC') {
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
	public function getResultText() {
		$this->getType();
		return 'Super gemacht';
	}

	protected function calculatePercentage() {
		return $score->getRightAnswers() / $score->getPlayedQuestions();	
	}
}
