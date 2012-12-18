<?php

class Application_Model_DbTable_AdsImages extends Zend_Db_Table_Abstract
{

    protected $_name = 'ads_images';
    
    protected $_primary = 'id';
    
    protected $_referenceMap = array(
    		'AdsImages' => array(
    				'refTableClass' => 'Application_Model_DbTable_Ads',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_ads')
    		)
    );


}

