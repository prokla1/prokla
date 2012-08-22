<?php

class Application_Model_DbTable_CategoryAttributesOptions extends Zend_Db_Table_Abstract
{

    protected $_name = 'category_attributes_options';

    protected $_primary = 'id';
    
    protected $_referenceMap = array(
    		'AttributeNamesOptions' => array(
    				'refTableClass' => 'Application_Model_DbTable_CategoryAttributesName',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_category_attributes_name')
    		)
    );
    

}

