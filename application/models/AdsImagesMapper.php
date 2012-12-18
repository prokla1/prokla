<?php

class Application_Model_AdsImagesMapper
{
	protected $_dbTable;
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_AdsImages();
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
	public function save($url, $id_ads, $cover, $title, $description)
	{
		$data = array(
				'id_ads'	=>	$id_ads,
				'cover'		=>	$cover,
				'url'		=>	$url,
				'title'		=>	$title,
				'description'	=>	$description,
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
			$image = new Application_Model_AdsImages($row->toArray()); //metodo __construct ->recebe os valores por ARRAY
			$result[] = $image;
		}
		return $result;
	}

	
	/**
	 * Deleta a imagem conforme o ID
	 * @param unknown_type $id_image
	 * @return number
	 */
	public function deleteImage($id_image) {
		return $this->getDbTable()->delete(array('id = ?' => $id_image));;
	}
	
	

	/**
	 * Retorna os IDs dos anuncios (Ads) para saber se a imagem pertence a um anuncio do usuario
	 * @param unknown_type $id_user
	 * @return array Ids dos Ads do User
	 */
	public function selectIdAds($id_image){
		$resultSet = $this->getDbTable()
				->select()
				->from('images', array('id_ads'))
				->where('id = ?', $id_image);
	
		$rowSet = $this->getDbTable()->fetchRow($resultSet); //fetchAll($resultSet);
		/*print_r($rowSet);
		exit;
		
		$result   = array();
		foreach ($rowSet as $row) {
			$result[] = $row->id;
		}*/
		return $rowSet;
	}
	
}

