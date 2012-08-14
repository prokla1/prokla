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

    public function showAction()
    {
    	$id_ads = $this->_getParam('id', '0');
    	
    	$adsModel = new Application_Model_DbTable_Ads();
    	//$ads = $adsModel->fetchRow($adsModel->select()->where('id = ?', $id_ads));
    	$ads = $adsModel->fetchRow("id = $id_ads");
    	$images = $ads->findDependentRowset("Application_Model_DbTable_Images");
    	
    	$this->view->ad = $ads;
    	$this->view->images = $images;
    	
    	/*
    	$ads = new Application_Model_AdsMapper();
    	$ad = new Application_Model_Ads();
    	$this->view->ad = $ads->find($id_ads, $ad);
    	
		$this->view->images = $ads->findDependentRowSet("Application_Model_ImagesMapper");
    	
    	*/
    	/*
    	$images = new Application_Model_ImagesMapper();
    	$this->view->images = $images->findAllImagesAds($id_ads);
    	*/
    	
    }

    public function searchAction()
    {
        // action body
    }


}







