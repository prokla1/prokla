<?php

class Application_Form_AdsNew extends Zend_Form
{

    public function init()
    {
        $this->setName('new_ads')
        	->setAction('/me/new-ads')
        	->setMethod('post');

        $titulo = new Zend_Form_Element_Text('title');
        $titulo->setLabel('Titulo:')
		        ->setRequired(true)
		        ->addFilter('StringTrim')
		        ->addValidator('NotEmpty')
		        ->setAttrib('placeholder', 'Titulo')
		        ->setAttrib('required name', 'title');

        //$titulo->removeDecorator("HtmlTag");
        //$titulo->removeDecorator("Label");
        //$titulo->removeDecorator("Errors");
        
        
        $texto = new Zend_Form_Element_Textarea('text');
        $texto->setLabel('Texto:')
              	->setRequired(true)
              	->addValidator('NotEmpty')
				->addValidator('stringLength', true, array(0, 1000))
		        ->setAttribs(array(
			        		'required name'	=>	'text', 
			        		'placeholder'	=>	'Texto',
		        			'rows'			=>	'10',
		        			'cols'			=>	'150',
		        			));


        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Preço:')
		        ->setAttrib('placeholder', '0,00')
		        ->setRequired(true)
		        ->setAttribs(array('required name' => 'price', 'maxlength' => '12'))
		        ->addFilter('StripTags')
		        ->addFilter('StringTrim')
		        ->addFilter('pregReplace', array('match' => '/\s+/', 'replace' => ''))
		        ->addFilter('LocalizedToNormalized')
		        ->addValidator('stringLength', true, array(1, 12))
		        ->addValidator('float', true, array('locale' => 'pt_BR'))
		        ->addValidator('greaterThan', true, array('min' => 0));
        
        
		$image = new Zend_Form_Element_File('image');
		$image->setLabel('Foto principal')
				->setDestination(APPLICATION_PATH.'/../public/ads-image')
				->setDescription('Em seguida poderá inserir mais fotos.');
		$image->addValidator(new Zend_Validate_File_Extension(array('jpeg','jpg','gif','png')));
		

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Salvar')
        		->setAttrib('id', 'submitbutton');
        
        
        $this->addElements(array($titulo, $texto, $price, $image, $submit));
    }


}

