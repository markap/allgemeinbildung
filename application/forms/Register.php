<?php

/**
 * Form Class for the user register
 * @package forms
 */
class Form_Register extends Zend_Form {

	/**
	 * inits the form
	 *
	 * @author Martin Kapfhammer
	 */
	public function init() {

  		//username 
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Benutzername')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim');

        //password
        $pass = new Zend_Form_Element_Password('password');
        $pass->setLabel('Passwort')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim');

		 //password repeat
        $passRepeat = new Zend_Form_Element_Password('password_repeat');
        $passRepeat->setLabel('Passwortwdh')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim');

		//mail 
        $mail = new Zend_Form_Element_Text('mail');
        $mail->setLabel('Email')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim');

		//mail repeat
        $mailRepeat = new Zend_Form_Element_Text('mail_repeat');
        $mailRepeat->setLabel('Emailwdh')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim');

        //submit
        $submit = new Zend_Form_Element_Submit('Registrieren');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($username, $pass, $passRepeat, $mail, $mailRepeat, $submit));
	}



}


