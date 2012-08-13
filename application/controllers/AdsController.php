<?php

class AdsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        
    	$id = $this->_getParam('id', 0);
    	if ($id == 0)
    		$this->_forward('list');  //direciona pra outro ACTION
    		//return $this->_helper->redirector('perfil');
    	
    }

    public function listAction()
    {
    	$page = $this->_getParam('page', 1);
    	
    	$model = new Application_Model_AdsMapper();
    	$ads = Zend_Paginator::factory ( $model->findAllAds() );
    	$ads->setCurrentPageNumber ( $this->_getParam( 'page', 1 ) )
    		->setItemCountPerPage ( 5 )
    		->setPageRange(10);
    	$this->view->paginator = $ads;
	}


}



