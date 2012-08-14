<?php

class Application_Model_ImagesMapper
{
	protected $_dbTable;
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_Images();
		}
		return $this->_dbTable;
	}
	
	/**
	 * Salva a imagem
	 * Envia o objeto "Images" e ele é salvo no banco
	 * @return Retorna o ID da imagem
	 * @param Application_Model_Images $images
	 * @throws Exception
	 */
	public function save($url, $id_ads)
	{
		$data = array(
				'id_ads'	=>	$id_ads,
				'url'		=>	$url,
				'status'	=>	'1'
		);
		return $this->getDbTable()->insert($data);
	}



	/**
	 * Procura uma "Image" pelo ID_ADS
	 * @param unknown_type $id
	 * @param Application_Model_Images $images
	 * @return void|Application_Model_Images
	 */
	public function find($id, Application_Model_Images $images)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$images->setOptions($row->toArray());
		return $images;
	}	
	


	/**
	 * Retorna todos as Images no banco conforme o Ads, para paginacao
	 * @return Ambigous <Zend_Db_Select, Zend_Db_Select>
	 */
	public function findAllImagesAds($id_ads) 
	{
		$resultSet = $this->getDbTable()->select()
					->where('id_ads = ?', $id_ads);
		
		$rowSet = $this->getDbTable()->fetchAll($resultSet);
		$result   = array();
		foreach ($rowSet as $row) {
			$image = new Application_Model_Images($row->toArray()); //metodo __construct ->recebe os valores por ARRAY
			$result[] = $image;
		}
		return $result;
	}
	
	
}

