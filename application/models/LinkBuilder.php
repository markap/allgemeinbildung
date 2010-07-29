<?php

/**
 * creates the links for games 
 * 
 * @package models
 */
class Model_LinkBuilder {

	private static $instance = null;



	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}	
		return self::$instance;
	}


	public function getGameLink($gameId, $questionType) {
		return "/game/index/play/" 
				. md5('nextgame!') 
				."/g/" . $gameId 
				. "/qtyp/". $questionType 
				. "/sh/1";

}

	public function getLGLink($gameId, $questionType) {
 		return "/game/index/play/" 
				. md5('nextgame!') 
				. "/g/" . $gameId 
				. "/tl/" . md5('toLearn!') 
				. "/qtyp/" . $questionType;
	}	

}
