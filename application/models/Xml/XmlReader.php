<?php

/**
 * used to write xml data 
 *
 * @package models
 * @subpackage Xml
 */
class Model_DbTable_XmlReader {

	public function loadXml() {
if (file_exists("artikel.xml")) {
   $xml = simplexml_load_file("artikel.xml");

var_dump($xml);
}
else {
   exit("Konnte Datei nicht laden. ");
}

	}
}
