<?php

/**
 * creates the whats next game ids 
 *
 * use:
 * 		LG -> play a learn game
 * 		PW -> play wrong questions in learn mode
 * 		PL -> play later (2 month) 
 * 		PT -> play a txt game
 *		PN -> play now again
 *		unplayed games
 * 
 * @package models
 */
class Model_WhatsNext {

	protected $userId;	
	protected $result = array();

	public function __construct($userId) {
		$this->userId = $userId;
		$this->getResults();
var_dump($this->result);
		$this->removeDoubleResults();
var_dump($this->result);
		$this->getUnplayedGames();
	}

	public function getResults() {
		$resultDb = new Model_DbTable_GameResult();
		$this->result = $resultDb->getGames($this->userId);
	}
	
	public function getUnplayedGames() {
		//userid
	}

	public function removeDoubleResults() {
		$unsetIds = array();
		for ($i = 0; $i < count($this->result); $i++) {
			$j = $i + 1;
			$result = $this->result[$i];
			for ($j; $j < count($this->result); $j++) {
				$resultToCompare = $this->result[$j];	
				if ($result['gameid'] === $resultToCompare['gameid']) {
					$unsetIds[] = $j;
				}
			}
		}
		foreach ($unsetIds as $unsetId) {
			unset($this->result[$unsetId]);
		}
	}
}
