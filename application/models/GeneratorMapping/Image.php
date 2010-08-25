<?php 

/**
 * @package model/GeneratorMapping
 */

class Model_GeneratorMapping_Image {

	protected $resource;

	public function __construct($name, $path) {
		$this->createResource($name, $path);
	}

	public function createResource($name, $path) {
		$nameArr = explode('.', $name);
		$format  = strtolower($nameArr[1]);

		$resource  = null;
		$imageName = $path . $name;
		switch ($format) {
			case 'jpg':
			case 'jpeg':
				$resource = imagecreatefromjpeg($imageName); 
				break;
			case 'gif':
				$resource = imagecreatefromgif($imageName); 
				break;
			case 'png':
				$resource = imagecreatefrompng($imageName); 
				break;
		}
		$this->resource = $resource;
	}

	public function getResource() {
		return $this->resource;
	}

	public function getWidth() {
		return imagesx($this->resource);
	}

	public function getHeight() {
		return imagesy($this->resource);
	}


 	public function addBorder() {

        $newWidth  = $this->getWidth() + 5;
        $newHeigth = $this->getHeight() + 5;
        $newImage  = imagecreatetruecolor($newWidth, $newHeigth);


        $borderColor = imagecolorallocate($newImage, 0, 0, 0);
        imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeigth, $borderColor);

		imagecopy($newImage, $this->getResource(),
					0,
					0,
					0,
					0,
					$this->getWidth(),
					$this->getHeight()
		);

		$this->resource = $newImage;
    }

	public function addText($text) {
		$font  = 50;

		switch ($text) {
			case 'A':
				$x = 20; 
				$y = 70; 
				break;
			case 'B':
				$x = $this->getWidth() - 70;;
				$y = 70; 
				break;
			case 'C':
				$x = 70; 
				$y = $this->getHeight() - 20;
				break;
			case 'D':
				$x = $this->getWidth() - 70; 
				$y = $this->getHeight() - 20;
				break;
		}	

        $black = imagecolorallocate($this->resource, 0, 0, 0);
		imagettftext($this->resource, 
					$font, 0, $x, $y, $black, 'font/arial.ttf',$text);
	}

}
