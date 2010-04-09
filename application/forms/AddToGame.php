<?php

/** 
 * Form class for adding questions to games 
 * @package forms
 */
class Form_AddToGame extends Zend_Form {

    /**
     * inits the form
     * 
     * @author Martin Kapfhammer 
     */
    public function init() {

        $this->setMethod('post');
		$this->setAttrib('enctype', 'multipart/form-data');

		// game 
		$game = new Zend_Form_Element_Select('game');
		$game->setLabel('Game wählen:')
			 ->setMultiOptions(array(1 => 'Default'));

		// questiontype 
		$qtype = new Zend_Form_Element_Select('qtype');
		$qtype->setLabel('Fragetyp wählen:')
			 ->setMultiOptions(array('Zufall', 'Multiple Choice', 'Direkteingabe'));

		$this->addElements(array($game, $qtype));
    }
}

