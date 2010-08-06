<?php

class CommunityController extends Zend_Controller_Action
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


}

