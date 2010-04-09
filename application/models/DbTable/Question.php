<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select question data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_Question extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'question';


	/**
	 * returns a question for a special id
	 * 
	 * @author Martin Kapfhammer
 	 *
	 * @param string $questionId
	 * @param boolean $test use active or unactive questions
	 * @throws Model_Exception_QuestionNotFound
	 * @return array $question
	 */
	public function getQuestion($questionId, $test = false) {
		$active = ($test === false) ? 'Y' : 'N';
		$question = $this->fetchRow('questionid = '. $questionId . ' and active = "'. $active .'"');
		if (!$question) {
			throw new Model_Exception_QuestionNotFound('question', $questionId);
		}
		return $question->toArray();
	}


	/**
	 * counts the question
	 *
 	 * @author Martin Kapfhammer
	 * @return integer 
	 */
	public function countQuestions() {
		$select = $this->select();
		$select->from($this, array('COUNT(*) as question'))
			   ->where('active = "Y"');
		$result = $this->fetchAll($select);
		$formattedResult = $result->toArray();
		return $formattedResult[0]['question'];
	}

	
	/**
	 * returns all available creationdates
	 *
	 * @author Martin Kapfhammer
	 * @return array
	 */
	public function getDates() {
		$select = $this->select();
		$select->distinct()
			   ->from($this, array('creationdate'))
			   ->order('creationdate ASC');
		$result = $this->fetchAll($select);
		return $result->toArray(); 
	}

	public function insertQuestion(array $postValues, $answerId, $fileName, $userId) {
		$data = array('question' => $postValues['question'],
					  'hint'	 => $postValues['hint'],
					  'answerid' => $answerId,
					  'image' 	 => $fileName,
					  'level'	 => $postValues['level'],
					  'creationdate' => date('Y-m-d'),
					  'author'   => $userId,
					  'active'   => 'N'
					);
		return $this->insert($data);
	}

	public function findImages($searchTerm) {
		$stmt = $this->select();
		$stmt->distinct()
			 ->from(array('q' => 'question'),
					array('q.image'))
			 ->where('q.question like "%' . $searchTerm . '%"');
		$result = $this->fetchAll($stmt)->toArray();
		return $result;
	}

	public function getQuestionIds($active = 'Y') {
		$stmt = $this->select();
		$stmt->from($this, array('questionid'))
			 ->where('active = "' . $active . '"')
			 ->order('creationdate DESC')
			 ->order('questionid DESC');
		$result = $this->fetchAll($stmt)->toArray();
		$questionIds = array();
		foreach ($result as $questionId) {
			$questionIds[] = $questionId['questionid'];
		}
		return $questionIds;
	}

	public function setActive($questionId) {
		$data  = array('active' => 'Y');
		$where = array('questionid' => $questionId);
		$this->update($data, $where);
	}

}
