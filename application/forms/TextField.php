<?php

/**
 * Form Class for one textfield and button 
 * @package forms
 */
class Form_TextField extends Zend_Form {

	/**
	 * inits the form
	 *
	 * @author Martin Kapfhammer
	 */
	public function init() {

  		//username 
        $field = new Zend_Form_Element_Text('textfield');
        $field->setLabel('Name des Games')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty');

        //submit
        $submit = new Zend_Form_Element_Submit('OK');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($field, $submit));
	}



}


