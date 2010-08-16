<?php

/**
 * creates the links for games 
 * with the whats next logic
 * 
 * @package models
 */
class Model_WhatsNextLinkBuilder extends Model_LinkBuilder {



	public function getLink(array $result) {
		$link = null;
		switch ($result['type']) {
			case 'LG': $link = $this->getLGLink($result['gameid'], 
												$result['qtype']);
			break;

			case 'PL':
			case 'PN': $link = $this->getGameLink($result['gameid'], 
												  $result['qtype']);
			break;
			
			case 'PT': $link = $this->getGameLink($result['gameid'], 
												  'txt');
			break;

			case 'PW': $link = $this->getPlayResultLink($result['gameid'],
														'N',
														$result['qtype']);
			break;

		}	
		return $link;
	}	

}
