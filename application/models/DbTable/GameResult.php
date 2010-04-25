<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select game result data
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_GameResult extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'gameResult';


	/**
	 * inserts a result for a user
	 *
	 * @author Martin Kapfhammer
	 * @param integer $userId
	 * @param integer $gameId
	 * @param array $result
	 */
	public function insertResult($userId, $gameId, $result) {
		$data = array('gameid' 	 => $gameId,
					  'rightids' => $result['right'],
					  'wrongids' => $result['wrong'],
					  'score'	 => $result['score'],
					  'userid'	 => $userId,
					  'date'     => date('Y-m-d')
					);
		$this->insert($data);
	}


	/**
	 * gets the game result for a user
	 *
	 * @author Martin Kapfhammer
	 * @param integer $userId
	 */
	public function getGameResult($userId) {
		// TODO
		// gamename, eltzter score, highscore, 
		$orderBy = array('date ASC');
		$result = $this->fetchAll('userid = ' . $userId, $orderBy);
		if (!$result) {
			return false;
		}
		return $result->toArray();
	}

}
