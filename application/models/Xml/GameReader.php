<?php

/**
 * used to write xml data for the games
 *
 * @package models
 * @subpackage Xml
 */
class Model_Xml_GameReader extends Model_Xml_XmlReader {

	public function getGame($id) {
		$path = '/content/game[@id='.$id.']';
		return $this->xml->xpath($path);
	}
}

