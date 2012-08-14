<?php

class Application_Model_DbTable_RegionMicroregion extends Zend_Db_Table_Abstract
{

    protected $_name = 'region_microregion';

    protected $_referenceMap = array(
    		'StateCountry' => array(
    				'refTableClass' => 'Application_Model_DbTable_RegionState',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_state')
    		)
    );
}

