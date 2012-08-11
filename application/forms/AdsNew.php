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
              ->setValue('Titulo');
              

        
        $texto = new Zend_Form_Element_Textarea('text');
        $texto->setLabel('Texto:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setValue('Texto');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Criar')
               ->setAttrib('id', 'submitbutton');

        $this->addElements(array($titulo, $texto, $submit));
    }


}

