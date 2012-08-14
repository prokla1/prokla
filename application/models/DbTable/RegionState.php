<?php

class Application_Model_DbTable_RegionState extends Zend_Db_Table_Abstract
{

    protected $_name = 'region_state';

    protected $_dependentTables = array('Application_Model_DbTable_RegionCity');
    
    protected $_referenceMap = array(
    		'StateCountry' => array(
    				'refTableClass' => 'Application_Model_DbTable_RegionCountry',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_country')
    		)
    );
}

