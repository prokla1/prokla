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
				'label' 		=> 	'Meu Perfil',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'index',
				'title'			=>	'Meu perfil',
	        ),
			array(
				'label' 		=> 	'Meus Anúncios',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'my-ads',
				'title'			=>	'Meus Anúncios',
	        ),
			array(
				'label' 		=> 	'Novo Anúncio',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'new-ads',
				'title'			=>	'Novo Anúncio',
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