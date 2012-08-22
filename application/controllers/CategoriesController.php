<?php

class CategoriesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$categories = new Application_Model_DbTable_CategoryName();
    	$categoriesView = $categories->getCategories();
    	$this->view->categories = $categoriesView;
    	//$this->_helper->json($categoriesView);
    }


}

