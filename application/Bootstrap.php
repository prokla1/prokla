<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	/**
	 * Sistema de tradução
	 */
	protected function _initTranslate()
	{
		$languages = array('en', 'pt_BR');
		$local_session = new Zend_Session_Namespace();
		if (isset($_GET['l']) && in_array($_GET['l'], $languages)) {
			$locale = new Zend_Locale($_GET['l']); 
			$local_session->locale = $_GET['l']; 
		} else if (empty($local_session->locale)){
			try {
		    	$locale = new Zend_Locale('browser');
				//$locale = new Zend_Locale(Zend_Locale::BROWSER); //Zend_Registry::get('Zend_Locale');
		  	} catch (Zend_Locale_Exception $e) {
		    	$locale = new Zend_Locale('en');  
		  	}
		} else {
			$locale = new Zend_Locale($local_session->locale);
		}
		
		$translate = new Zend_Translate(
				array(
						'adapter' => 'array',
						'content' => APPLICATION_PATH . '/languages/' . $locale . '/arrays.php',
						'locale'  => $locale,
				)
		);	
		
		// Set up ZF's translations for validation messages.
		$translate_msg = new Zend_Translate(
				array(
						'adapter' => 'array',
						'content' => APPLICATION_PATH . '/languages/' . $locale . '/Zend_Validate.php',
						'locale' => $locale
						)
		);
		
		// Add translation of validation messages
		$translate->addTranslation($translate_msg);
		Zend_Form::setDefaultTranslator($translate);
		
		// Save it for the rest of application to use
		Zend_Registry::set('Zend_Translate', $translate);
	}
	
	
	
	/**
	 * cria o navigation, menu de navegação conforme os arquivos que contem os arrays() dos links
	 */	
	protected function _initNavigation()
	{
		$nav_default = new Zend_Config(require(APPLICATION_PATH . '/layouts/navigation/default.php'));// read in the array menu
		$navigation_default = new Zend_Navigation($nav_default);
		Zend_Registry::set('default',$navigation_default);// initialize the navigation object with the array
	
		$nav_logged = new Zend_Config(require(APPLICATION_PATH . '/layouts/navigation/logged.php'));
		Zend_Registry::set('logged',new Zend_Navigation($nav_logged));
	}
	
	
	
	/* assim o library/Helpers/.. funciona
	protected function _initAutoload()
	{
		$loader = Zend_Loader_Autoloader::getInstance();
		$loader->setFallbackAutoloader(true);
	}
	*/
	


	/**
	 * Init Paginator
	 * seta como default o layout para paginação
	 */
	protected function _initPaginator()
	{
		Zend_Paginator::setDefaultScrollingStyle('Sliding');
		Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
	}
	

}

