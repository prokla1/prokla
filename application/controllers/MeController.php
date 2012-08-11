<?php

class MeController extends Zend_Controller_Action
{

    /**
     * Modulo " Me " é protegido, apenas usuario logado tem acesso
     *
     *
     *
     */
    public function init()
    {
        if ( !Zend_Auth::getInstance()->hasIdentity() )
    		return $this->_helper->redirector->goToRoute( array('controller' => 'users', 'action'=> 'login'));
    	
    }

    public function indexAction()
    {
    	
    	// captura o "user" salvo na session do Zend_Auth (session)
    	$user = Zend_Auth::getInstance()->getStorage()->read();
    	$this->view->user = $user;

    }

    public function myAdsAction()
    {
        // action body
        /*
        $ads = new Application_Model_AdsMapper();
        $user = Zend_Auth::getInstance()->getStorage()->read();
        $ads->findAllAdsUser($user->id);
        $this->view->ads = $ads;
        */
    	

    	$page = $this->_getParam('page', 1);
    	
    	$model = new Application_Model_AdsMapper();
    	$user = Zend_Auth::getInstance()->getStorage()->read();
    	$ads = Zend_Paginator::factory ( $model->findAllAdsUser($user->id) );
    	$ads->setCurrentPageNumber ( $this->_getParam( 'page', 1 ) )
    	->setItemCountPerPage ( 5 )
    	->setPageRange(10);
    	$this->view->paginator = $ads;
    	
    	
        /*
        $page = $this->_getParam('page', 1);
        
        $adsModel = new Application_Model_AdsMapper();
        // Returns an instance of the class Zend_Db_Table_Select
        $user = Zend_Auth::getInstance()->getStorage()->read();
        $ads = $adsModel->findAllAdsUser($user->id);
        
        // Returns a rowset
        // $users = $userModel->getAll();
        
        // First option to use Zend_Paginator_Adapter_DbTableSelect
        $adapter = new Zend_Paginator_Adapter_DbTableSelect($ads);
        // $adapter->setRowCount($customCount);
        $paginator = new Zend_Paginator($adapter);
        
        // Second option to use Zend_Paginator_Adapter_DbTableSelect
        // $paginator = new Zend_Paginator($users);
        // Note: You cannot customize the count in this option
        
        $paginator->setCurrentPageNumber($page)
        ->setItemCountPerPage(5)
        ->setPageRange(5);
        
        $this->view->assign('paginator', $paginator);
        */
    }


}



