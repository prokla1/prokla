<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
    	$form = new Application_Form_UserCreate();
    	
    	if ($this->getRequest()->isPost()) { // verifica se foi enviado por POST
    		
    		if ($form->isValid($this->getRequest()->getPost())) { // verifica se o form é válido
    	
    			// model
    			$user = new Application_Model_User($form->getValues());
    			 
    			// mapper
    			$mapper  = new Application_Model_UserMapper();
    			 
    			try {
    				// insert user
    				$mapper->save($user);
    				$this->view->message = "Usuário foi salvo com sucesso!";
    			} catch (Exception $e) {
    				$this->view->assign('message', $e->getMessage());
    			}
    			 
    			// direciona para alguma pagina de confirmacao ou informando o erro
    			//return $this->_helper->redirector('index');
    		}
    	}   	
    	
    	
    	$this->view->form = $form;
    }
    
    
    
    
    
    public function loginAction()
    {
    	$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
    	$this->view->messages = $this->_flashMessenger->getMessages();
    	
    	$form = new Application_Form_UserLogin();
    	$this->view->form = $form;
    	 
    	//Verifica se existem dados de POST
    	if ( $this->getRequest()->isPost() ) {
    		$data = $this->getRequest()->getPost();
    		 
    		//Formulário corretamente preenchido?
    		if ( $form->isValid($data) ) {
    
    			$email = $form->getValue('email');
    			$senha = $form->getValue('password');
    
    			$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    			 
    			//Inicia o adaptador Zend_Auth para banco de dados
    			$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    			$authAdapter->setTableName('users')
    			->setIdentityColumn('email')
    			->setCredentialColumn('password')
    			->setCredentialTreatment('MD5(?)');
    			 
    			//Define os dados para processar o login
    			$authAdapter->setIdentity($email)
    			->setCredential($senha);
    			 
    			//Efetua o login
    			$auth = Zend_Auth::getInstance();
    			$result = $auth->authenticate($authAdapter);
    			 
    			//Verifica se o login foi efetuado com sucesso
    			// is the user a valid one?
    			if ( $result->isValid() ) {
    
    				//Armazena os dados do usuário em sessão,    				 
    				$info = $authAdapter->getResultRowObject();
    				$storage = $auth->getStorage();
    				 
    				// http://php.net/manual/pt_BR/function.get-object-vars.php
    				// retorna um objet em array, que é usado no __construct do USER
    				$user = new Application_Model_User(get_object_vars($info));
    				$storage->write($user);
    				 
    				//Redireciona para o Controller protegido
    				return $this->_helper->redirector->goToRoute( array('controller' => 'me'), null, true);
    				 
    			} else {
    
    				//Dados inválidos
    				$this->_helper->FlashMessenger('Usuário ou senha inválidos! Email: '.$email.' - Senha: '.$senha.'');
    				$this->_redirect('/users/login');
    
    			}
    		} else {
    
    			//Formulário preenchido de forma incorreta
    			$form->populate($data);
    			 
    		}
    	}
    	 
    	 
    }
    
    public function logoutAction()
    {
    	$auth = Zend_Auth::getInstance();
    	$auth->clearIdentity();
    	return $this->_helper->redirector('index');
    }
    
    


}



