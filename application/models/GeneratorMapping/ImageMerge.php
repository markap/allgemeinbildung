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
		$this->createBorderAndText();
		$this->createMaxHeightAndWidth();
		$this->template = imagecreatetruecolor($this->maxWidth *2, $this->maxHeigth *2);
	}

	protected function createImages($images) {
		foreach ($images as $name) {
			$this->images[] = new Model_GeneratorMapping_Image($name, self::PATH);
		}
	}

	protected function createBorderAndText() {
		$image = $this->images[0];
		$image->addBorder(0, 5, 5, 0);
		$image->addText('A');
		$image = $this->images[1];
		$image->addBorder(0, 0, 5, 5);
		$image->addText('B');
		$image = $this->images[2];
		$image->addBorder(5, 5, 0, 0);
		$image->addText('C');
		$image = $this->images[3];
		$image->addBorder(5, 0, 0, 5);
		$image->addText('D');
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
		$this->maxWidth  = $width[0];
		$this->maxHeigth = $height[0];
	}

	public function merge() {
		$this->addImage(0, 0, 0);
		$this->addImage(1, $this->maxWidth, 0);
		$this->addImage(2, 0, $this->maxHeigth);
		$this->addImage(3, $this->maxWidth, $this->maxHeigth);
		return $this;
	}

	public function save($path) {
		imagejpeg($this->template, $path);
		imagedestroy($this->template);
	}


	protected function addImage($key, $x, $y) {
		$image = $this->images[$key];
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
