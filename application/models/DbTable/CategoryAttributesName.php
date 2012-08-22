<?php

class Application_Model_DbTable_CategoryAttributesName extends Zend_Db_Table_Abstract
{

    protected $_name = 'category_attributes_name';

    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_CategoryAttributesOptions');


}

