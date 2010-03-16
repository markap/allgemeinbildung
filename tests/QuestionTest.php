<?php
require_once 'PHPUnit/Framework.php';
require_once '/home/www/allgemeinbildung/application/models/Question.php';

class QuestionTest extends PHPUnit_Framework_TestCase {
	
	protected $question;

	protected function setUp() {
		include './bootstrap.php';
	}

	public function init1() {
		$this->quesiton = new Model_Question(1);
	}

}
