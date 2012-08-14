<?php

class Application_Model_AdsMapper
{
	protected $_dbTable;
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_Ads();
		}
		return $this->_dbTable;
	}
	
	/**
	 * Salva o anuncio
	 * Envia o objeto "Ads" e ele é salvo no banco
	 * @return Retorna o ID do anuncio
	 * @param Application_Model_Ads $ads
	 * @throws Exception
	 */
	public function save(Application_Model_Ads $ads, $id_user)
	{
		$url_image = $ads->getImage();
		$data = array(
				'text'		=>	$ads->getText(),
				'title'		=>	$ads->getTitle(),
				'id_user'	=>	$id_user,
				'price'		=>	$ads->getPrice(),
				'image'		=>	(empty($url_image)) ? 'null.jpg' : $ads->getImage(),
		);
		
		// id == null -> insert
		if (null === ($id = $ads->getId())) {
			unset($data['id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $ads->getId()));
			return $ads->getId();
		}
	}



	/**
	 * Procura um "Ads" pelo ID
	 * @param unknown_type $id
	 * @param Application_Model_Ads $ads
	 * @return void|Application_Model_Ads
	 */
	public function find($id, Application_Model_Ads $ad)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$ad->setOptions($row->toArray());
		return $ad;
	}	
	
	/**
	 * Retorna todos os "Ads" no banco
	 * @return multitype:Application_Model_Ads
	 */
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$result   = array();
		foreach ($resultSet as $row) {
			
			$ads = new Application_Model_Ads($row->toArray()); //metodo __construct ->recebe os valores por ARRAY
			$result[] = $ads;
		}
		return $result;
	}

	/**
	 * Retorna todos os Ads no banco, para paginacao
	 * @return Ambigous <Zend_Db_Select, Zend_Db_Select>
	 */
	public function findAllAds() {
		return $this->getDbTable()->select()
					->order(array('id DESC'));
	}
	

	/**
	 * Retorna todos os Ads no banco conforme o User, para paginacao
	 * @return Ambigous <Zend_Db_Select, Zend_Db_Select>
	 */
	public function findAllAdsUser($id_user) {
		return $this->getDbTable()->select()
					->where('id_user = ?', $id_user)
					->order(array('id DESC'));
	}
	


	/**
	 * Deleta o anuncio ADS, Cascate on Images
	 * @return Ambigous <Zend_Db_Select, Zend_Db_Select>
	 */
	public function deleteAds($id_ads) {
		return $this->getDbTable()->delete(array('id = ?' => $id_ads));
	}
	

	/**
	 * Retorna os IDs dos anuncios (Ads) do usuario
	 * Usado para validacao, para ele nao poder editar outros anuncios
	 * @param unknown_type $id_user
	 * @return array Ids dos Ads do User
	 */
	public function selectIdsByUser($id_user){
		$resultSet = $this->getDbTable()
							->select()
							->from('ads', array('id'))
							->where('id_user = ?', $id_user);
		
		$rowSet = $this->getDbTable()->fetchAll($resultSet);
		$result   = array();
		foreach ($rowSet as $row) {
			$result[] = $row->id;
		}
		return $result;
	}
}

