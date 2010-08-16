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
					  'qtype'	 => $result['qtype'],
					  'type'	 => $result['type'],
					  'result'	 => $result['result'],
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
		$orderBy = array('date DESC', 'resultid DESC');
		$result = $this->fetchAll('userid = ' . $userId, $orderBy);
		if (!$result) {
			return false;
		}
		return $result->toArray();
	}


	/**
	 * checks if for this game and user exist a result 
	 *
	 * @author Martin Kapfhammer
	 * @param integer $gameId
	 * @param integer $userId
	 * @return boolean 
	 */ 
	public function existResultForGameAndUser($gameId, $userId) {
		$stmt = $this->select()
					 ->where('userid = ?', $userId)
					 ->where('gameid = ?', $gameId);
		$row = $this->fetchRow($stmt);
		return ($row) ? true : false;
	}


	/**
	 * returns the result for this game and user 
	 *
	 * @author Martin Kapfhammer
	 * @param integer $gameId
	 * @param integer $userId
	 * @return array|boolean 
	 */ 
	public function getResultForGameAndUser($gameId, $userId) {
		$stmt = $this->select()
					 ->where('userid = ?', $userId)
					 ->where('gameid = ?', $gameId)
					 ->order('date DESC')
					 ->order('resultid DESC');
		$row = $this->fetchAll($stmt);
		return ($row) ? $row->toArray() : false;	
	}


	/**
	 * get the result for a resultId
	 *
	 * @author Martin Kapfhammer
	 * @param integer $resultId
	 * @param integer $userId
	 * @return array|boolean 
 	 */
	public function getGameResultForResultId($resultId, $userId) {
		$stmt = $this->select()
					 ->where('userid = ?', $userId)
					 ->where('resultid = ?', $resultId);
		$row = $this->fetchRow($stmt);
		return ($row) ? $row->toArray() : false;
	}


	/**
	 * gets the game result for a user
	 * by type and date
	 *
	 * @author Martin Kapfhammer
	 * @param integer $userId
	 * @return array
	 */
	public function getGames($userId) {
		$db = $this->getAdapter();

		$where = 'gr.userid = ' . $userId . ' AND 
					DATE_ADD(gr.date, INTERVAL 3 DAY) <= CURDATE() AND
					DATE_ADD(gr.date, INTERVAL 3 MONTH) >= CURDATE() AND
					gr.type IN ("LG", "PW", "PN", "PT")';
					
		$orWhere = 'gr.userid = ' . $userId . ' AND 
					DATE_ADD(gr.date, INTERVAL 2 MONTH) <= CURDATE() AND
					DATE_ADD(gr.date, INTERVAL 4 MONTH) >= CURDATE() AND
					gr.type = "PL"';

		$sqlMustPlay = 'select gl.gameid, gl.name, gl.qtype, gr.date, gr.type, gr.result
					from gameResult gr, gameList gl 
					where gr.gameid = gl.gameid AND (' . $where
					. ' OR  ' . $orWhere . ')';

		$sqlNotPlayed = 'select gameid, name, null as qtype, null as date, null as type, null as result
					from gameList
					where gameid NOT IN (
						select gameid
						from gameResult
						where userid = ' . $userId . ')
					limit 5';

		$sql = '(' . $sqlMustPlay . ') union (' . $sqlNotPlayed . ') order by rand()';

		$stmt = $db->query($sql);
					
		$row = $stmt->fetchAll();
		return ($row) ? $row : false;
	}


	public function updateLGGameResult($userId, $gameId, $questionType) {
		$data = array('type = PN');
		$where = array('userId = ' . $userId,
					   'gameId = ' . $gameId,
					   'qtype =  ' . $questionType,
					   'type = LG',
					   'DATE_ADD(date, INTERVAL 1 DAY) <= CURDATE()',
					   'DATE_ADD(date, INTERVAL 1 MONTH) >= CURDATE()'
					);
		$this->update($data, $where);
	}


	public function updatePWGameResult($userId, $resultId, $questionType) {
		$data = array('type = PN');
		$where = array('userId = ' . $userId,
					   'resultId = ' . $resultId,
					   'qtype =  ' . $questionType,
					   'type = PW',
					   'DATE_ADD(date, INTERVAL 1 DAY) <= CURDATE()',
					   'DATE_ADD(date, INTERVAL 1 MONTH) >= CURDATE()'
					);
		$this->update($data, $where);
	}

}
