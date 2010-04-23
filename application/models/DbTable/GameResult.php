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

	public function insertResult($userId, $gameId, $questionIds) {
		$data = array('gameid' => $gameId,
					  'rightids' => $questionIds['right'],
					  'wrongids' => $questionIds['wrong'],
					  'userid'	 => $userId,
					  'date'     => date('Y-m-d')
					);
		$this->insert($data);
	}

	public function getGameResult($userId) {
		$orderBy = array('date ASC');
		$result = $this->fetchAll('userid = ' . $userId, $orderBy);
		if (!$result) {
			return false;
		}
		return $result->toArray();
	}

}
