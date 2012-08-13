<?php

class Application_Form_AdsNew extends Zend_Form
{

    public function init()
    {
        $this->setName('new_ads');

        $titulo = new Zend_Form_Element_Text('title');
        $titulo->setLabel('Titulo:')
              	->setRequired(true)
              	->addFilter('StringTrim')
             	->addValidator('NotEmpty')
        		->setAttrib('placeholder', 'Titulo');
              

        
        $texto = new Zend_Form_Element_Textarea('text');
        $texto->setLabel('Texto:')
              	->setRequired(true)
              	->addValidator('NotEmpty')
				->addValidator('stringLength', true, array(0, 250))
				->setAttrib('placeholder', 'Texto');


		$image = new Zend_Form_Element_File('image');
		$image->setLabel('Foto principal')
				->setDestination(APPLICATION_PATH.'/../public/ads-image')
				->setDescription('Em seguida poderá inserir mais fotos.');
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Criar')
        		->setAttrib('id', 'submitbutton');
        
        
        $this->addElements(array($titulo, $texto, $image, $submit));
    }


}

