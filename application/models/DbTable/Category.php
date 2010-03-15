<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select category data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_Category extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'category';


	/**
	 * returns a category for a special id
	 * 
	 * @author Martin Kapfhammer
 	 *
	 * @param string $categoryId
	 * @throws Model_Exception_QuestionNotFound
	 * @return array $category
	 */
	public function getCategory($categoryId) {
		$category = $this->fetchRow('categoryid = '. $categoryId);
		if (!$category) {
			throw new Model_Exception_QuestionNotFound('category', $categoryId);
		}
		return $category->toArray();
	}

}
