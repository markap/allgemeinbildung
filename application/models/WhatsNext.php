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
	protected $resultDb;

	public function __construct($userId) {
		$this->resultDb = new Model_DbTable_GameResult();
		$this->userId = $userId;
		$this->getResults();
		$this->removeDoubleResults();
	}

	protected function getResults() {
		$this->result = $this->resultDb->getGames($this->userId);
	}
	

	protected function removeDoubleResults() {
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

	public function getNext() {
		return $this->result;
	}
}
