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
		$this->removeOutOfTimeResults();
		$this->shuffleResults();
	}

	protected function getResults() {
		$this->result = $this->resultDb->getGames($this->userId);
	}
	

	protected function removeDoubleResults() {
		$newResult 	= $this->result;
		$length		= count($this->result);
		for ($i = 0; $i < $length; $i++) {
			$j = $i + 1;
			$result = $this->result[$i];
			for ($j; $j < $length; $j++) {
				$resultToCompare = $this->result[$j];	
				if ($result['gameid'] === $resultToCompare['gameid']) {
					unset($newResult[$j]);
				}
			}
		}
		$this->result = $newResult;
	}

	protected function removeOutOfTimeResults() {

		$newResult = $this->result;
		$today 	= new Zend_Date();
		$date   = new Zend_Date();
		$date2  = new Zend_Date();
		foreach ($this->result as $key => $result) {
			$type 	= $result['type'];
			if (in_array($type, array("LG", "PW", "PN", "PT"))) {
				$date->set($result['date']);
				$date->add(3, Zend_Date::MONTH);
				if ($date->get() < $today->get()) {
					unset($newResult[$key]);
				}
			} else if ($type === "PL") {
				$date->set($result['date']);
				$date->add(2, Zend_Date::MONTH);
				$date2->set($result['date']);
				$date2->add(4, Zend_Date::MONTH);
				if (!($date->get()  <= $today->get() && $date2->get() >= $today->get())) {
					unset($newResult[$key]);
				}

			}
		}
		$this->result = $newResult;
	}

	public function shuffleResults() {
		shuffle($this->result);
	}

	public function getNext() {
		return $this->result;
	}
}
