<?php

/** 
 * Form class for creating new questions 
 * @package forms
 */
class Form_CreateQuestion extends Zend_Form {

    /**
     * inits the form
     * 
     * @author Martin Kapfhammer 
     */
    public function init() {

        $this->setMethod('post');
		$this->setAttrib('enctype', 'multipart/form-data');

		// Question element
        $question = new Zend_Form_Element_Text('question');
        $question->setLabel('Frage:')
                 ->setRequired(true)
                 ->addFilter('StringTrim')
                 ->addFilter('StripTags');

		// Question hint element
        $hint = new Zend_Form_Element_Text('hint');
        $hint->setLabel('Hinweiß bei Direkteingabe:')
                 ->setRequired(true)
                 ->addFilter('StringTrim')
                 ->addFilter('StripTags');

		// Answer element
        $answer = new Zend_Form_Element_Text('answer');
        $answer->setLabel('Die richtige Antwort:')
               ->setRequired(true)
               ->addFilter('StringTrim')
               ->addFilter('StripTags');

		// Fake Answer 1
        $fake1 = new Zend_Form_Element_Text('fake1');
        $fake1->setLabel('Erste falsche Antwort:')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addFilter('StripTags');

		// Fake Answer 2 
        $fake2 = new Zend_Form_Element_Text('fake2');
        $fake2->setLabel('Zweite falsche Antwort:')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addFilter('StripTags');

		// Fake Answer 3 
        $fake3 = new Zend_Form_Element_Text('fake3');
        $fake3->setLabel('Dritte falsche Antwort:')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addFilter('StripTags');

		// category 
		$category = new Zend_Form_Element_Multiselect('category');
		$category->setLabel('Kategorie(n) wählen:');

		// level 
		$level = new Zend_Form_Element_Select('level');
		$level->setLabel('Schwierigkeitsstufe wählen:');

		// Image upload
		$image = new Zend_Form_Element_File('image');
		$image->setLabel('Bild zur Frage:')
			  ->setDestination(APPLICATION_PATH . '/../public/img/question')
			  ->addValidator('Count', false, 1)
			  ->addValidator('Size', false, 204800)
			  ->addValidator('Extension', false, 'jpg,png,gif');

		// use already uploaded image 
        $imageText = new Zend_Form_Element_Text('imageText');
        $imageText->setLabel('Bereits existierendes Bild verwenden:')
              	  ->setRequired(true)
              	  ->addFilter('StringTrim')
              	  ->addFilter('StripTags');

		// Submit Element
		$submit = new Zend_Form_Element_Submit('Frage Speichern');
		$submit->setAttrib('id', 'submitbutton');
		


		$this->addElements(array($question,
								 $hint,
								 $answer, 
								 $fake1, 
								 $fake2, 
								 $fake3, 
								 $image, 
								 $imageText, 
								 $category, 
								 $level,
								 $submit
								));


    }
}

