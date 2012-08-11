<?php

class Application_Form_UserCreate extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        $this->setAttrib('enctype', 'multipart/form-data');
        

        // Add an nome element
        $this->addElement('text', 'name', array(
        		'label'			=> 'Seu Nome:',
        		'required'		=> true,
        		'value'			=>	'Nome'
        ));
        
        
        // Add an email element
        $this->addElement('text', 'email', array(
        		'label'			=> 'Seu email:',
        		'required'		=> true,
        		'filters'		=> array('StringTrim'),
        		'value'			=>	'Email',
        		'validators'	=> array(
        				'EmailAddress',
        		)
        ));
        

        // Add an email element
        $this->addElement('text', 'password', array(
        		'label'			=> 'Crie uma Senha:',
        		'required'   	=> true,
        		'filters'    	=> array('StringTrim'),
        		'value'			=> 'senha qualquer'
        ));
        


        // Add the submit button
        $this->addElement('submit', 'submit', array(
        		'ignore'   => true,
        		'label'    => 'Cadastrar',
        ));
        
        
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
        		'ignore' => true,
        ));
    	
    }


}

