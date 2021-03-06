<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select question-category relation data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_HasCategory extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'hasCategory';


	/**
	 * returns all categories as string for a questionid
	 * 
	 * @author Martin Kapfhammer
 	 *
	 * @param string $questionId
	 * @return array $categories
	 */
	public function getCategories($questionId) {
		$categoryIds = $this->getCategoryIds($questionId);
		$categoryDb  = new Model_DbTable_Category();
		$categories  = array();	
		foreach ($categoryIds as $categoryId) {
			$category 		= $categoryDb->getCategory($categoryId);
			$categories[] 	= $category['name'];
		}
		return $categories; 
	}


	/**
 	 * return categoryids for a questionid
	 *
	 * @author Martin Kapfhammer
	 * @param string $questionId
	 * @throws Model_Exception_QuestionNotFound
 	 * @return array $ret question ids
	 */
	public function getCategoryIds($questionId) {
		$where = array('questionid = ' . $questionId);
		$results = $this->fetchAll($where);
		if (!$results) {
			throw new Model_Exception_QuestionNotFound('hascategory', $questionId);
		}

		$ret = array();
		foreach ($results->toArray() as $result) {
			$ret[] = $result['categoryid'];
		}
		return $ret;
	}

	public function insertRelation($questionId, array $categories) {
		foreach ($categories as $category) {
			$data = array('questionid' => $questionId,
						  'categoryid' => $category);
			$this->insert($data);
		}
	}

	public function getQuestionIds($categoryId) {
		$stmt = $this->select();
		$stmt->from(array('h' => 'hasCategory'),
					array('h.questionid'))
			 ->join(array('q' => 'question'),
						  'h.questionid = q.questionid',
						  array())
			 ->where('h.categoryid = ' . $categoryId)
			 ->where('q.active = "Y"');
		$results 	 = $this->fetchAll($stmt)->toArray();
		$questionIds = array();
		foreach ($results as $result) {
			$questionIds[] = $result['questionid'];
		}
		return $questionIds;
	}

	public function countQuestions($categoryId) {
		$stmt = $this->select();
		$stmt->from(array('h' => 'hasCategory'),
					array('COUNT(h.questionid) as question'))
			 ->join(array('q' => 'question'),
						  'h.questionid = q.questionid',
						  array())
			 ->where('h.categoryid = ' . $categoryId)
			 ->where('q.active = "Y"');
		$result = $this->fetchAll($stmt)->toArray();
		return $result[0]['question'];
	}

	public function updateRelation($questionId, array $oldVals, array $newVals) {
		// compare both arrays	
		$insertVals = array_diff($newVals, $oldVals);
		$deleteVals = array_diff($oldVals, $newVals);
		$this->insertRelation($questionId, $insertVals);
		$this->deleteRelation($questionId, $deleteVals);
	}

	protected function deleteRelation($questionId, array $categories) {
		foreach ($categories as $category) {
			$where = array('questionid' => $questionId,
						   'categoryid' => $category);
			$this->delete($where);
		}
	}

}
