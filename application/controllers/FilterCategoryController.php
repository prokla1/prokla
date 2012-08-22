<?php

class FilterCategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

    	$data = array();
    	$origin = $this->_getParam('origin');
    	$value = $this->_getParam('id', 0);
    	
    	$data['subs'] = array();
    	$data['attribute'] = array();


    	/** ======== pega subcategorias ======== */
    	$getDbTable = new Application_Model_DbTable_CategoryName();
    	$resultSet = $getDbTable->select()
    				->from('category_name', array('id', 'name'))
    				->where('sub = ?', $value)
    				->order('name ASC');
    	$rowSet = $getDbTable->fetchAll($resultSet);
    	$data['subs'] = $rowSet->toArray();
    	
    	
    	/** ======== pega atributos ======== */
    	$attributeDbTable = new Application_Model_DbTable_CategoryAttributesName();
    	$attributes = $attributeDbTable->select()
    				->where('id_category_name = ?', $value)
    				->order('name ASC');
		
		$rowSet = $attributeDbTable->fetchAll($attributes);
		$optionsArray   = array();
		$cont = 0;
		foreach ($rowSet as $row) {
			$data['attribute'][$cont] = $row->toArray();
			$data['attribute'][$cont]['options'] = $row->findDependentRowset("Application_Model_DbTable_CategoryAttributesOptions")->toArray();
			$cont++;
		}
    	
    	$this->_helper->json($data);
    }
    


    
    
}

