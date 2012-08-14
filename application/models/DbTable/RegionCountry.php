<?php

class Application_Model_DbTable_RegionCountry extends Zend_Db_Table_Abstract
{

    protected $_name = 'region_country';


    protected $_dependentTables = array('Application_Model_DbTable_RegionState');
}

