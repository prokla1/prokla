<?php

class MeController extends Zend_Controller_Action
{

    /**
     * Modulo " Me " é protegido, apenas usuario logado tem acesso
     */
    public function init()
    {
        if ( !Zend_Auth::getInstance()->hasIdentity() ) // se nao tiver logado, enviar pra pagina de login
    		return $this->_helper->redirector->goToRoute( array('controller' => 'users', 'action'=> 'login'));
    	
        $this->flashMessenger = $this->_helper->getHelper('FlashMessenger');
        if ($this->flashMessenger->hasMessages()) 
        	$this->view->messages = $this->flashMessenger->getMessages();
        
    }

    public function indexAction()
    {
    	// captura o "user" salvo na session do Zend_Auth (session)
    	$user = Zend_Auth::getInstance()->getStorage()->read();
    	$this->view->user = $user;

    }

    public function myAdsAction()
    {
    	$page = $this->_getParam('page', 1);
    	
    	$model = new Application_Model_AdsMapper();
    	$user = Zend_Auth::getInstance()->getStorage()->read();
    	$ads = Zend_Paginator::factory ( $model->findAllAdsUser($user->id) );
    	$ads->setCurrentPageNumber ( $this->_getParam( 'page', 1 ) )
	    	->setItemCountPerPage ( 5 )
	    	->setPageRange(10);
    	$this->view->paginator = $ads;
    }

    public function newAdsAction()
    {
    	$form = new Application_Form_AdsNew();
    	
    	if ($this->getRequest()->isPost()) { // verifica se foi enviado por POST
    		
    		if ($form->isValid($this->getRequest()->getPost())) { // verifica se o form é válido
    			
    			if ($form->image->isUploaded()){
	    			$originalFilename = pathinfo($form->image->getFileName());
	    			$newFilename = 'ads-' . uniqid() . '.' . $originalFilename['extension'];
	    			$form->image->addFilter('Rename', $newFilename);

    			}

    			
    			// model
    			$ads = new Application_Model_Ads($form->getValues());

    			// mapper
    			$mapper  = new Application_Model_AdsMapper();
    			 
    			try {

    				// cria o thumb com 500px e 100px
    				$path = APPLICATION_PATH . '/../public/ads-image/';
    				$thumb500px = new Application_View_Helper_EasyThumbnail($path.$newFilename, $path.$newFilename, 500);
    				$thumb100px = new Application_View_Helper_EasyThumbnail($path.$newFilename, $path."/100px/".$newFilename, 100);
    				
    				// insert Ads
    				$user = Zend_Auth::getInstance()->getStorage()->read();
    				$id_ads = $mapper->save($ads, $user->id);
    				
    				$this->flashMessenger->addMessage("O anúncio foi criado com sucesso![[ {$id_ads} ]]");
	    			$this->_helper->redirector->goToRoute( array('controller' => 'me', 'action'=> 'new-ads-photo', 'id' => $id_ads));
	    			 
    			} catch (Exception $e) {
    				$this->flashMessenger->addMessage($e->getMessage());
    			}
    			 
    		}
    	}  	
    	
    	$this->view->form = $form;
    }

    public function newAdsPhotoAction()
    {
    	$adsMapper = new Application_Model_AdsMapper();
    	$adModel = new Application_Model_Ads();
    	$ad = $adsMapper->find($this->_getParam('id', '0'), $adModel);
    	$this->view->ad = $adsMapper->find($this->_getParam('id', '0'), $adModel);  
    }

    public function editAdsAction()
    {
    	/*
    	$adsMapper = new Application_Model_AdsMapper();
    	$adModel = new Application_Model_Ads();
    	$ad = $adsMapper->find($this->_getParam('id', '0'), $adModel);
    	$this->view->ad = $adsMapper->find($this->_getParam('id', '0'), $adModel);
    	
    	$form = new Application_Form_AdsEdit();
    	$form->populate($ad->getArray());
    	$this->view->form = $form;
    	*/
    	
    	
    	$id_ads = $this->_getParam('id', '0');
    	
    	$user = Zend_Auth::getInstance()->getStorage()->read();
    	$id_user = $user->id;
    	 
    	$adsModel = new Application_Model_DbTable_Ads();
    	$ads = $adsModel->fetchRow($adsModel->select()->where(
										    			'id = ?', $id_ads,
										    			'id_user = ?', $id_user 
										    			));
    	//$ads = $adsModel->fetchRow("id = $id_ads");
    	$images = $ads->findDependentRowset("Application_Model_DbTable_Images");
    	 
    	$this->view->ad = $ads;
    	$this->view->images = $images;
    }


    

    public function newAdsPhotoUploadAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    
    	if ($this->_request->isPost()) {
    		$msg = array();
    		 
    		$path = APPLICATION_PATH . '/../public/ads-image/';
    		$valid_formats = array("jpg", "png", "JPG", "PNG", "jpeg", "JPEG");
    
    		$qts = count($_FILES['photoimg']['name']);
    
    		if($qts > 15){
					$msg[] = array(
    					'status'	=>	'fail',
    					'url'		=>	null,
    					'msg'		=>	'Máximo de 15 imagens'
    				);
    		}else {
    
	    		for($i=0; $i < $qts; $i++){
	    				
	    			$name = $_FILES ['photoimg']['name'][$i];
	    			$tmp = $_FILES ['photoimg']['tmp_name'][$i];
	    				
	    			@list($txt, $ext) = explode(".", $name);
	    			if(in_array($ext,$valid_formats))
	    			{
	    				$actual_image_name = uniqid()."_".str_replace(" ", "_", $txt).".".$ext;
	    
	    				if(move_uploaded_file($tmp, $path.$actual_image_name))
	    				{
	    					$imagesMapper = new Application_Model_ImagesMapper();
	    					$imagesMapper->save($actual_image_name, $this->_getParam('ads', 0));   /************* VALIDAR O ID DO ANUNCIO, SE PERTENCE AO USUARIO QUE ESTA ENVIANDO O POST */
	    					
	    					$thumb500px = new Application_View_Helper_EasyThumbnail($path.$actual_image_name, $path.$actual_image_name, 500);
	    					if ($thumb500px) {
	    						$msg[] = array(
	    								'status'	=>	'ok',
	    								'url'		=>	$actual_image_name,
	    								'msg'		=>	'Sucesso: '. $name
	    								);
	    						$thumb100px = new Application_View_Helper_EasyThumbnail($path.$actual_image_name, $path."/100px/".$actual_image_name, 100);
	    					}else {
	    						$msg[] = array(
	    								'status'	=>	'fail',
	    								'url'		=>	$actual_image_name,
	    								'msg'		=>	$thumb500px->getErrorMsg()
	    						);
	    					}
	    				}else {
	    						$msg[] = array(
	    								'status'	=>	'fail',
	    								'url'		=>	null,
	    								'msg'		=>	'Falha no envio de: '.$name
	    						);
	    				}
	    			}else{
						$msg[] = array(
	    					'status'	=>	'fail',
	    					'url'		=>	null,
	    					'msg'		=>	'Formato Inválido: '.$name
	    				);
	    			}
	    		 
	    		}
    		}
   
    	}
    	$this->_helper->json($msg);
    }
    
    
}









