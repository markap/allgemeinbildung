<?php 

/**
 * @package model/GeneratorMapping
 */

class Model_GeneratorMapping_GenerateLoop {

	public static function getQuestionIds() {
		$file = file('tmp/file.txt');
		foreach ($file as $key => $entry) {
    		if (trim($entry) === "") {
    			unset($file[$key]);
    		}
		} 
		$number = count($file);
		$questionIds = array();
		for ($i = 0; $i < $number; $i++) $questionIds[] = 33;
		return $questionIds;
	}
}
