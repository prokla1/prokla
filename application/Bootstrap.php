<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	
	/**
	 * cria o navigation, menu de navegação conforme os arquivos que contem os arrays() dos links
	 */	
	protected function _initNavigation()
	{
		$nav_default = new Zend_Config(require(APPLICATION_PATH . '/layouts/navigation/default.php'));// read in the array menu
		Zend_Registry::set('default',new Zend_Navigation($nav_default));// initialize the navigation object with the array
	
		$nav_logged = new Zend_Config(require(APPLICATION_PATH . '/layouts/navigation/logged.php'));
		Zend_Registry::set('logged',new Zend_Navigation($nav_logged));
	}
	
	


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

