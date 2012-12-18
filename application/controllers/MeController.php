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

        $user = Zend_Auth::getInstance()->getStorage()->read();
        $this->user_id = $user->id;  //armazena o ID do usuario para todo o controller utilizar
        
        
        $adsIds = new Application_Model_AdsMapper();
        $this->ids_ads_by_user = $adsIds->selectIdsByUser( $this->user_id ); //ids de todos Ads do User
        
    }

    public function indexAction()
    {
    	// captura o "user" salvo na session do Zend_Auth (session)
    	//$user = Zend_Auth::getInstance()->getStorage()->read();
    	//$this->view->user = $user;
    	
    	/*Cria um novo modelo do usuario, atravez do ID que esta salvo na sessao*/
    	$user = new Application_Model_UserMapper();
    	$userModel = new Application_Model_User();
    	$this->view->user = $user->find($this->user_id, $userModel);

    }

    public function myAdsAction()
    {
    	$page = $this->_getParam('page', 1);
    	
    	$model = new Application_Model_AdsMapper();
    	$ads = Zend_Paginator::factory ( $model->findAllAdsUser($this->user_id) );
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
    				$id_ads = $mapper->save($ads, $this->user_id);
    				
    				$this->flashMessenger->addMessage("O anúncio foi criado com sucesso!");
	    			$this->_helper->redirector->goToRoute( array('controller' => 'me', 'action'=> 'edit-ads', 'id' => $id_ads));
	    			 
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
    	
    	if(!in_array($id_ads, $this->ids_ads_by_user))  //verifica se o ID do anuncio(ADS) pertence realmente ao USER
    	{
    		echo "Este anúncio não te pertence";
    		exit;
    	}
    	
    	$adsModel = new Application_Model_DbTable_Ads();
    	$ads = $adsModel->fetchRow($adsModel->select()->where(
										    			'id = ?', $id_ads,
										    			'id_user = ?', $this->user_id 
										    			));
    	//$ads = $adsModel->fetchRow("id = $id_ads");
    	//$images = $ads->findDependentRowset("Application_Model_DbTable_Images");
    	$form = new Application_Form_AdsEdit();
    	$form->populate($ads->toArray());
    	$this->view->form = $form;
    	 
    	$this->view->ad = $ads;
    	$this->view->images = $ads->findDependentRowset("Application_Model_DbTable_AdsImages");
    }


    

    public function newAdsPhotoUploadAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	
    	
    	if(!in_array($this->_getParam('ads', 0), $this->ids_ads_by_user))  //verifica se o ID do anuncio(ADS) pertence realmente ao USER
    	{
    		echo "Ads: ". $this->_getParam('ads');
    		print_r($_REQUEST);
    		echo "<pre>";
    		print_r($this->ids_ads_by_user);
    		echo "<pre>";
    		echo "Este anúncio não te pertence";
    		exit;
    	}
    	 
    
    	if ($this->_request->isPost()) {
    		$msg = array();
    		 
    		$path = APPLICATION_PATH . '/../public/ads-image/';
    		$valid_formats = array("jpg", "png", "JPG", "PNG", "jpeg", "JPEG");
    
    		$qts = @count($_FILES['photoimg']['name']);
    
    		if($qts > 15){
    			$msg[] = array(
    					'status'	=>	'fail',
    					'url'		=>	null,
    					'msg'		=>	'Máximo de 15 imagens'
    			);
    		}else {
    
    			for($i=0; $i < $qts; $i++){
    	    
    				$name = $_FILES['photoimg']['name'][$i];
    				$tmp = $_FILES['photoimg']['tmp_name'][$i];
    	    
    				@list($txt, $ext) = explode(".", $name);
    				if(in_array($ext,$valid_formats))
    				{
    					$ads = $this->_getParam('ads', 0);
    					$actual_image_name = $ads . '_' . uniqid() . '.'.strtolower($ext);
    					 
    					if(move_uploaded_file($tmp, $path.$actual_image_name))
    					{
    						$imagesMapper = new Application_Model_AdsImagesMapper();
    						
    						$title = $this->_getParam('tile', '');
    						$description = $this->_getParam('description', '');
    						$id_image = $imagesMapper->save($actual_image_name, $ads, $cover, $title, $description);   /************* VALIDAR O ID DO ANUNCIO, SE PERTENCE AO USUARIO QUE ESTA ENVIANDO O POST */
    
    						$thumb500px = new Application_View_Helper_EasyThumbnail($path.$actual_image_name, $path.$actual_image_name, 500);
    						if ($thumb500px) {
    							$msg[] = array(
    									'status'	=>	'ok',
    									'url'		=>	$actual_image_name,
    									'id_image'	=>	$id_image,
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

    
    public function deleteImageAdsAction()
    {
    	$id_image = $this->_getParam('idImage', null);
    	$imageMapper = new Application_Model_AdsImagesMapper();
    	
    	$id_ads = $imageMapper->selectIdAds($id_image); // pega o ID do anuncio desta imagem, para garantir que nao delete outra imagem
    	if(@!in_array($id_ads->id_ads, $this->ids_ads_by_user))  //verifica se o ID do anuncio(ADS) pertence realmente ao USER
    	{
    		$msg = array(
    				'status'	=>	'fail',
    				'msg'		=>	'Esta imagem não te pertence.'
    		);
    		$this->_helper->json($msg);
    		exit;
    	}
    	
    	$msg = array();
    	try {
	    	$imageMapper->deleteImage($id_image);
	    	$msg = array(
	    			'status'	=>	'ok',
	    			'msg'		=>	'Deletado com sucesso'
	    	);
	    	$url_image = $this->_getParam('urlImage', 0);
	    	
		    	@unlink(dirname(dirname(__DIR__)) .'/public/ads-image/'.$url_image.'');
		    	@unlink(dirname(dirname(__DIR__)) .'/public/ads-image/100px/'.$url_image);
	    	
    	} catch (Exception $e) {
    		$msg = array(
    				'status'	=>	'fail',
    				'msg'		=>	$e->getMessage()
    		);
    	}
    	$this->_helper->json($msg);
    	 
    }

    
    
    public function deleteAdsAction()
    {

    	if(!in_array($this->_getParam('id', 0), $this->ids_ads_by_user))  //verifica se o ID do anuncio(ADS) pertence realmente ao USER
    	{
    		echo "Este anúncio não te pertence";
    		exit;
    	}

    	try {
	    	$adsMapper = new Application_Model_AdsMapper();
	    	$adsMapper->deleteAds($this->_getParam('id', 0));
	    	
	    	$this->flashMessenger->addMessage("O anúncio foi deletado com sucesso!");
	    	$this->_helper->redirector->goToRoute( array('controller' => 'me', 'action'=> 'my-ads'));
    	} catch (Exception $e) {
	    	$this->flashMessenger->addMessage("Falha ao deletar o anuncio!");
	    	$this->_helper->redirector->goToRoute( array('controller' => 'me', 'action'=> 'edit-ads', 'id' => $this->_getParam('id', 0)));
    	}
    
    }
    
      
}









