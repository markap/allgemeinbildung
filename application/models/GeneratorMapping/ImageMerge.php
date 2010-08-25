<?php 

/**
 * @package model/GeneratorMapping
 */

class Model_GeneratorMapping_ImageMerge {

	protected $images 	 = array();

	protected $maxWidth  = null;
	protected $maxHeigth = null;
	protected $template  = null;

	const PATH			= 'img/question/';

	public function __construct(array $images) {
		$this->createImages($images);
		$this->createMaxHeightAndWidth();
		$this->template = imagecreatetruecolor($this->maxWidth *2-5, $this->maxHeigth *2-5);
	}

	protected function createImages($images) {
		foreach ($images as $name) {
			$this->images[] = new Model_GeneratorMapping_Image($name, self::PATH);
		}
	}

	protected function createMaxHeightAndWidth() {
		$width  = array();
		$height = array();
		foreach ($this->images as $resource) {
			$width[]  = $resource->getWidth();	
			$height[] = $resource->getHeight();	
		}
		rsort($width);
		rsort($height);
		$this->maxWidth  = $width[0] +5;
		$this->maxHeigth = $height[0] +5;
	}

	public function merge() {
		$this->addImage(0, 0, 0, 'A');
		$this->addImage(1, $this->maxWidth, 0, 'B');
		$this->addImage(2, 0, $this->maxHeigth, 'C');
		$this->addImage(3, $this->maxWidth, $this->maxHeigth, 'D');

		imagejpeg($this->template, '/tmp/tada.jpg');
		imagedestroy($this->template);

	}


	protected function addImage($key, $x, $y, $text) {
		$image = $this->images[$key];
		$image->addBorder();
		$image->addText($text);
		imagecopy($this->template, $image->getResource(),
    		$x, 
    		$y,
    		0,
    		0,
			$image->getWidth(),
			$image->getHeight());

		imagedestroy($this->images[$key]->getResource());

	}
}
