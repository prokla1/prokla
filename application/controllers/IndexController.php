<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
$locale = new Zend_Locale();

// Return all default locales
$found = $locale->getDefault();
print_r($found);

// Return only browser locales
$found2 = $locale->getDefault(Zend_Locale::BROWSER,TRUE);
print_r($found2);
    	
    	 
    }


}

