<?php
 
$pages = array(
			array(
				'label' 		=> 	'Anúncios',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'ads',
				'action'		=> 	'list',
				'class'			=>	'menu_top',
				'title'			=>	'Anúncios',
	        ),
			array(
				'label' 		=> 	'Cadastrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'create',
				'class'			=>	'menu_top',
				'title'			=>	'Cadastrar',
	        ),
			array(
				'label' 		=> 	'Login',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'login',
				'class'			=>	'menu_top',
				'title'			=>	'Login',
	        ),
 
    );
 
return $pages;
?>