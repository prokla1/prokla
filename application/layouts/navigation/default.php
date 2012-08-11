<?php
 
$pages = array(
			array(
				'label' 		=> 	'Início',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'index',
				'action'		=> 	'index',
				'class'			=>	'home',
				'title'			=>	'Página Inicial',
				'image'			=>	'/public/img/eua.png'
	        ),
			array(
				'label' 		=> 	'Cadastrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'create',
				'title'			=>	'Cadastre-se',
	        ),
			array(
				'label' 		=> 	'Login',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'login',
				'title'			=>	'Login',
	        ),
 
    );
 
return $pages;
 
?>