<?php

/**
 * text object
 * provides some strings
 *
 * @package models
 */
class Model_Text {

	public static function get($key) {
		$key  = strtoupper($key);
		$text = array(
				'MC'  => 'Multiple Choice',
				'TXT' => 'Direkteingabe',
				'LG'  => 'Spiele dieses Game im Lernmodus!',
				'PW'  => 'Spiele deine falschen Fragen im Lernmodus!',
				'PL'  => 'Spiele dieses Game, um es weiterhin im Gedächtnis zu behalten!',
				'PT'  => 'Spiele dieses Game im Direkteingabemodus!',
				'PN'  => 'Spiele dieses Game jetzt, um dich zu verbessern!'
				);
		return $text[$key];

	}
}
