<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select game-category relation data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_GameCategoryRelation extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'gameCategoryRelation';


	/**
	 * returns all categories as string for a gameId
	 * 
	 * @author Martin Kapfhammer
 	 *
	 * @param string $gameId
	 * @return array $categories
	 */
	public function getCategories($gameId) {
		$categoryIds = $this->getCategoryIds($gameId);
		$categoryDb  = new Model_DbTable_Category();
		$categories  = array();	
		foreach ($categoryIds as $categoryId) {
			$category 		= $categoryDb->getCategory($categoryId);
			$categories[] 	= $category['name'];
		}
		return $categories; 
	}


	/**
 	 * return categoryids for a gameId
	 *
	 * @author Martin Kapfhammer
	 * @param string $gameId
	 * @throws Model_Exception_QuestionNotFound
 	 * @return array $ret category ids
	 */
	public function getCategoryIds($gameId) {
		$where = array('gameid = ' . $gameId);
		$results = $this->fetchAll($where);
		if (!$results) {
			throw new Model_Exception_QuestionNotFound('gamecategoryrelation', $gameId);
		}

		$ret = array();
		foreach ($results->toArray() as $result) {
			$ret[] = $result['catid'];
		}
		return $ret;
	}

	public function getGameIds($categoryIds) {
		$stmt = $this->select();
		$stmt->from(array('r' => 'gameCategoryRelation'),
					array('r.gameid'))
			 ->join(array('g' => 'gameList'),
						  'r.gameid = g.gameid',
						  array())
			 ->where('r.catid  IN (' . $categoryIds . ')');
		$results 	 = $this->fetchAll($stmt)->toArray();
		$gameIds = array();
		foreach ($results as $result) {
			$gameIds[] = $result['gameid'];
		}
		return $gameIds;
	}

}
