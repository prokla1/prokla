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
				'label' 		=> 	'Usuários',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'index',
				'title'			=>	'Todos os Usuários',
	        ),
			array(
				'label' 		=> 	'Usuários Paginados secao',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'list',
				'title'			=>	'Todos os Usuários',
	        ),
			array(
				'label' 		=> 	'Cadastrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'create',
				'title'			=>	'Cadastre-se',
	        ),
			array(
				'label' 		=> 	'Contato',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'index',
				'action'		=> 	'contato',
				'title'			=>	'Entre em contato conosco',
	        ),
			array(
				'label' 		=> 	'Meu Perfil',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'index',
				'title'			=>	'Meu perfil',
	        ),
			array(
				'label' 		=> 	'Logout',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'logout',
				'title'			=>	'Logout',
	        ),
 
    );
 
return $pages;
 
?>