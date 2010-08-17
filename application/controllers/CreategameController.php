<?php

class CreategameController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		Model_ControllerDeprecated::redirectToIndex($this);
    }

    public function indexAction()
    {
        // action body
    }

    public function saveaddingAction()
    {
		echo $this->_getParam('qtype');
		echo $this->_getParam('game');
    }


}



