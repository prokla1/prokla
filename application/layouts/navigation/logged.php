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
				'label' 		=> 	'Meu Perfil',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'index',
				'class'			=>	'menu_top',
				'title'			=>	'Meu perfil',
	        ),
			array(
				'label' 		=> 	'Meus Anúncios',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'my-ads',
				'class'			=>	'menu_top',
				'title'			=>	'Meus Anúncios',
	        ),
			array(
				'label' 		=> 	'Novo Anúncio',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'new-ads',
				'class'			=>	'menu_top',
				'title'			=>	'Novo Anúncio',
	        ),
			array(
				'label' 		=> 	'Logout',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'logout',
				'class'			=>	'menu_top',
				'title'			=>	'Logout',
	        ),
 
    );
 
return $pages;
?>