<?php

/**
 * used to write xml data 
 *
 * @package models
 * @subpackage Xml
 */
class Model_Xml_XmlReader {

	/**
 	 * path to xml files
	 * @var string
	 */
	protected $xmlPath = null;

	/**
	 * @var SimpleXMLElement
	 */
	protected $xml	   = null;

	
	/**
	 * constructor
	 * sets the xmlPath
	 *
	 * @author Martin Kapfhammer
	 * @param string $applicationPath
	 */
	public function __construct($applicationPath) {
		$this->xmlPath = $applicationPath . '/../data/xml/';
	}


	/**
	 * loads the xml file
	 *
 	 * @author Martin Kapfhammer
	 * @param string $file
	 * @throw Model_Exception_FileNotFound
	 * @return Model_Xml_XmlReader $this
	 */
	public function loadXml($file) {
		$xmlFile = $this->xmlPath . $file;
		if (file_exists($xmlFile)) {
   			$this->xml = simplexml_load_file($xmlFile);
		} else {
			throw new Model_Exception_FileNotFound($xmlFile);	
		}
		return $this;
	}
}

