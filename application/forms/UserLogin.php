<?php

class Application_Form_UserLogin extends Zend_Form
{

    public function init()
    {
        $this->setName('login');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator('EmailAddress')
              ->setValue('Email');
              

        
        $senha = new Zend_Form_Element_Password('password');
        $senha->setLabel('Senha:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setValue('Senha');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Logar')
               ->setAttrib('id', 'submitbutton');

        $this->addElements(array($email, $senha, $submit));
    }


}

