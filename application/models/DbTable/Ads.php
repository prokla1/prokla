<?php

class Application_Model_DbTable_Ads extends Zend_Db_Table_Abstract
{

    protected $_name = 'ads';

    protected $_primary = 'id';
    
    protected $_dependentTables = array('Application_Model_DbTable_Images');

    protected $_referenceMap = array(
    		'UsersAds' => array(
    				'refTableClass' => 'Application_Model_DbTable_Users',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_user')
    		)
    );
    
}

