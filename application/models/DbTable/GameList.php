<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select games
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_GameList extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'gameList';


	public function getGames() {
		$orderBy = array('RAND()');
		return $this->fetchAll(1, $orderBy)->toArray();
	}

	public function getGame($gameId) {
		$game = $this->fetchRow('gameid = ' . $gameId);
		if (!$game) {
			throw new Model_Exception_GameNotFound($gameId);
		}
		return $game->toArray();
	}

	public function getQuestionIds($gameId) {
		$game = $this->getGame($gameId);
		$questionIdsString = $game['questionids'];
		$questionIds	   = explode(',', $questionIdsString);
		return $questionIds;
	}

	public function countQuestionIds($gameId) {
		$questionIds = $this->getQuestionIds($gameId);
		return count($questionIds);
	}

	public function getQuestionType($gameId) {
		$game = $this->getGame($gameId);
		return $game['qtype'];
	}


	public function getGamesForCategories() {
	}
}
