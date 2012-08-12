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

        // Using both captcha and captchaOptions:
        $captcha = new Zend_Form_Element_Captcha('foo', 
        		array(
        		'label' => "Escreva",
        		'captcha' => 'image',
        		'captchaOptions' => array(
        				'captcha' => 'image',
        				'wordLen' => 6,
        				'timeout' => 300,
        		),
        ));

        

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Criar')
        		->setAttrib('id', 'submitbutton');
        
        
        $this->addElements(array($titulo, $texto, $submit));
    }


}

