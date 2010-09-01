<?php

/**
 * extends the abstract superclass for mapping for new questions 
 * for the possibility to generate images
 *
 * @package models
 */
abstract class Model_GeneratorMapping_AbstractImageQuestionMapping
				extends Model_GeneratorMapping_AbstractQuestionMapping {

	protected $imageAnswers 		= array('Bild A', 'Bild B', 'Bild C', 'Bild D');
	protected $isTestImageCreation	= true;

	const TEST_IMG_PATH		= 'tmp/'; 
	const IMG_PATH			= 'img/question/'; 

	public function setTestCreation($isTest) {
		$this->isTestImageCreation = $isTest;
		return $this;
	}	

	public function getImagePath($test) {
		return ($test) ? self::TEST_IMG_PATH : self::IMG_PATH;
	}


	protected function getImageName() {
		if ($this->isTestImageCreation) {
			$imageName = $this->getCurrentId();
			$path 	   = self::TEST_IMG_PATH;	
		} else {
        	$imageName  = Model_DbTable_Helper::getInstance()->getImageNumber(); 
			$path		= self::IMG_PATH;
		}
		$imageName = $imageName . '.jpg';
		return array('name' => $imageName, 
					 'path' => $path,
					 'full' => $path . $imageName);
	}


	protected function existTmpImage($tmpName) {
		return (file_exists(self::TEST_IMG_PATH . $name)) ? true : false;
	}


	protected function moveImage($tmpName, $newName) {
		rename(self::TEST_IMG_PATH . $tmpName, self::IMG_PATH . $newName);	
	}
}
