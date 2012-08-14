<?php

class Application_Model_UserMapper
{
	protected $_dbTable;
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_Users();
		}
		return $this->_dbTable;
	}
	
	/**
	 * Salva o usuario
	 * Envia o objeto "User" e ele é salvo no banco
	 * @param Application_Model_User $user
	 * @throws Exception
	 */
	public function save(Application_Model_User $user)
	{
		$data = array(
				'name' => $user->getName(),
				'email' => $user->getEmail(),
				'password' => $user->getPassword(),
		);
		 	
		// id == null -> insert
		if (null === ($id = $user->getId())) {
			unset($data['id']);

			// is unique eamil?
			if($this->isUniqueEmail($user->getEmail())){
				return $this->getDbTable()->insert($data);
			}
			else {
				throw new Exception('Este email já esta cadastrado.');
			}
			
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}


	/**
	 * Verifica se o email existe no email, para nao repetir
	 * @param String $email
	 * @return boolean
	 */
	public function isUniqueEmail($email){
		$where = $this->getDbTable()
				->getDefaultAdapter()
				->quoteInto('email = ?', $email);
	
		return (count($this->getDbTable()->fetchAll($where)) == 0) ? true : false;
	}


	/**
	 * Procura um "User" pelo ID
	 * @param unknown_type $id
	 * @param Application_Model_User $user
	 * @return void|Application_Model_User
	 */
	public function find($id, Application_Model_User $user)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$user->setOptions($row->toArray());
		//print_r($row->toArray());
		return $user;
	}	
	
	/**
	 * Retorna todos os "USER" no banco
	 * @return multitype:Application_Model_User
	 */
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$result   = array();
		foreach ($resultSet as $row) {
			
			$user = new Application_Model_User($row->toArray()); //metodo __construct ->recebe os valores por ARRAY
			$result[] = $user;
		}
		return $result;
	}
	
	/**
	 * Retorna todos os USER no banco, para paginacao
	 * @return Ambigous <Zend_Db_Select, Zend_Db_Select>
	 */
	public function findAllUsers() {
		return $this->getDbTable()->select()->order(array('id DESC'));
	}
	

}

