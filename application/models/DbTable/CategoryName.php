<?php

class Application_Model_DbTable_CategoryName extends Zend_Db_Table_Abstract
{

    protected $_name = 'category_name';
    protected $_parents = array();
    

    

    function getCategories($id = 0, $parents = array())
    {
    	$categorySet = $this->select()
		    	->where('sub = ?', $id )
		    	->order(array('name ASC'));
    	$rowSet = $this->fetchAll($categorySet);
    
    
    	foreach ($rowSet as $row)
    	{
    		$newParents = array();
    		$newParents['id'] = $row->id;
    		$newParents['name'] = $row->name;
    		$newParents['sub'] = $row->sub;
    		$newParents['subs'] = Application_Model_DbTable_CategoryName::getCategories($row->id);
    		 
    		
    		$parents[] = $newParents;
    	}
    
    	return $parents;
    }
}

