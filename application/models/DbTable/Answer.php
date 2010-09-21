<?php

/**
 * Table-Data-Gateway-Pattern Implementation
 * used to write and select answer data 
 *
 * @package models
 * @subpackage DbTable
 */
class Model_DbTable_Answer extends Zend_Db_Table_Abstract {

	/**
	 * Table name 
	 * @var string 
	 */
	protected $_name = 'answer';


	/**
	 * returns a answer for a special id
	 * 
	 * @author Martin Kapfhammer
 	 *
	 * @param string $answerId
	 * @throws Model_Exception_QuestionNotFound
	 * @return array $answer
	 */
	public function getAnswer($answerId) {
		$answer = $this->fetchRow('answerid = '. $answerId);
		if (!$answer) {
			throw new Model_Exception_QuestionNotFound('answer', $answerId);
		}
		return $answer->toArray();
	}


	/**
	 * get next answerid
	 * increment maxvalue of answers
	 *
 	 * @author Martin Kapfhammer
	 * @return integer 
	 */
	public function getNextAnswerId() {
		$select = $this->select();
		$select->from($this, array('MAX(answerid) as answerid'));
		$result = $this->fetchAll($select);
		$formattedResult = $result->toArray();
		return ++$formattedResult[0]['answerid'];
	}

	public function insertAnswer(array $postValues, $answerId) {
		if (!isset($postValues['image'])) $postValues['image'] = 0;
		if (!isset($postValues['text'])) $postValues['text'] = '';
		$data = array('answerid' => $answerId,
					  'answer'	 => $postValues['answer'],
					  'fake1'	 => $postValues['fake1'],
					  'fake2'	 => $postValues['fake2'],
					  'fake3'	 => $postValues['fake3'],
					  'image'	 => $postValues['image'],
					  'text'	 => $postValues['text'] 
					);
		$this->insert($data);
	}

	public function updateAnswer($answerId, array $postValues) {
		$data = array('answer'	 => $postValues['answer'],
					  'fake1'	 => $postValues['fake1'],
					  'fake2'	 => $postValues['fake2'],
					  'fake3'	 => $postValues['fake3']
					);
		$where = array('answerid = ' . $answerId);
		$this->update($data, $where);
	}
}
