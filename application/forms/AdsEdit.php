<?php

class Application_Form_AdsEdit extends Zend_Form
{

    public function init()
    {
        $this->setName('new_ads')
        	->setAction('/me/new-ads')
        	->setMethod('post');


        $id = new Zend_Form_Element_Hidden('id');
        
        $id_user = new Zend_Form_Element_Hidden('id_user');
        
        $created = new Zend_Form_Element_Hidden('created');
         
        
        $titulo = new Zend_Form_Element_Text('title');
        $titulo->setLabel('Titulo:')
		        ->setRequired(true)
		        ->addFilter('StringTrim')
		        ->addValidator('NotEmpty')
		        ->setAttrib('placeholder', 'Titulo')
		        ->setAttrib('required name', 'title');
        
        
        $texto = new Zend_Form_Element_Textarea('text');
        $texto->setLabel('Texto:')
              	->setRequired(true)
              	->addValidator('NotEmpty')
				->addValidator('stringLength', true, array(0, 250))
		        ->setAttribs(array('required name' => 'text', 'placeholder' => 'Texto'));


        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Preço:')
		        ->setRequired(true)
		        ->setAttribs(array('required name' => 'price', 'maxlength' => '12'))
		        ->addFilter('StripTags')
		        ->addFilter('StringTrim')
		        ->addFilter('pregReplace', array('match' => '/\s+/', 'replace' => ''))
		        ->addFilter('LocalizedToNormalized')
		        ->addValidator('stringLength', true, array(1, 12))
		        ->addValidator('greaterThan', true, array('min' => 0));
        
        
		$image = new Zend_Form_Element_File('image');
		$image->setLabel('Foto principal')
				->setDestination(APPLICATION_PATH.'/../public/ads-image')
				->setDescription('Em seguida poderá inserir mais fotos.');
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Salvar')
        		->setAttrib('id', 'submitbutton');
        
        
        $this->addElements(array($titulo, $texto, $price, $image, $submit, $id, $id_user, $created));

    }


}

