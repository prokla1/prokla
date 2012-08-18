<?php

class FilterRegionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	// action body
    }


    public function getRegionAction()
    {
    	$data = array();
    	$origin = $this->_getParam('origin');
    	$value = $this->_getParam('value', 0);
    	
    	
    	if ($origin == 'region-country'){
    		$destiny = 'region-state';
    		
    		$getDbTable = new Application_Model_DbTable_RegionState();
    		$resultSet = $getDbTable->select()
			    		->from('region_state', array('id', 'name'))
			    		->where('id_country = ?', $value)
					    ->order(array('name ASC'));
    		
    		$rowSet = $getDbTable->fetchAll($resultSet);
    		$data['values'] = $rowSet->toArray();
    		
    		

    	}elseif ($origin == 'region-state'){
    		$destiny = 'region-microregion';

    		$getDbTable = new Application_Model_DbTable_RegionMicroregion();
    		$resultSet = $getDbTable->select()
	    		->from('region_microregion', array('id', 'name', 'acronym'))
	    		->where('id_state = ?', $value)
	    		->order(array('name ASC'));
    		
    		$rowSet = $getDbTable->fetchAll($resultSet);
    		$data['values'] = $rowSet->toArray();
    		
    		
    		if ( count($data['values']) == 0){
    			$destiny = 'region-city';
    			
    			$getDbTable = new Application_Model_DbTable_RegionCity();
    			$resultSet = $getDbTable->select()
	    			->from('region_city', array('id', 'name'))
	    			->where('id_state = ?', $value)
	    			->order(array('name ASC'));
    			
    			$rowSet = $getDbTable->fetchAll($resultSet);
    			$data['values'] = $rowSet->toArray();    			
    		}
    		
    		

    	}elseif ($origin == 'region-microregion'){
    		$destiny = 'region-city';
    			
    		$getDbTable = new Application_Model_DbTable_RegionCity();
    		$resultSet = $getDbTable->select()
	    			->from('region_city', array('id', 'name'))
	    			->where('id_microregion = ?', $value)
	    			->order(array('name ASC'));
    			
    		$rowSet = $getDbTable->fetchAll($resultSet);
    		$data['values'] = $rowSet->toArray();  
    		
    			
    	}else {
    		$destiny = 'region-country';
    	}
    	
    	
    	$data['destiny'] = $destiny;
    	$this->_helper->json($data);
    }
    


    
    
}

