<?php

class Application_Model_Ads
{
	protected $_id;
	protected $_id_user;
	protected $_title;
	protected $_text;
	protected $_price;
	protected $_created;
	
	
	/**
	 * Retorna os atributos protected em array
	 * @return array dos valores protected
	 */
	public function getArray(){
		$array = array();
		foreach ($this as $key => $value) {
			$array[substr($key, 1)] = $value;
		}
		return $array;
	}

	/**
	 * metodo contrutor, chama a classe e envia um array com
	 * os dados, ex:  new Ads(array())
	 * @param array $options
	 */
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Ads property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Ads property {$name}");
		}
		return $this->$method();
	}
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @return the $_id_user
	 */
	public function getId_user() {
		return $this->_id_user;
	}

	/**
	 * @param field_type $_id_user
	 */
	public function setId_user($_id_user) {
		$this->_id_user = $_id_user;
	}

	/**
	 * @return the $_title
	 */
	public function getTitle() {
		return $this->_title;
	}

	/**
	 * @param field_type $_title
	 */
	public function setTitle($_title) {
		$this->_title = $_title;
	}

	/**
	 * @return the $_text
	 */
	public function getText() {
		return $this->_text;
	}

	/**
	 * @param field_type $_text
	 */
	public function setText($_text) {
		$this->_text = $_text;
	}
	/**
	 * @return the $_price
	 */
	public function getPrice() {
		return $this->_price;
	}

	/**
	 * @param field_type $_price
	 */
	public function setPrice($_price) {
		$this->_price = $_price;
	}
	/**
	 * @return the $_image
	 */
	public function getImage() {
		return $this->_image;
	}

	/**
	 * @param field_type $_image
	 */
	public function setImage($_image) {
		$this->_image = $_image;
	}
	/**
	 * @return the $_created
	 */
	public function getCreated() {
		return $this->_created;
	}

	/**
	 * @param field_type $_created
	 */
	public function setCreated($_created) {
		$this->_created = $_created;
	}




	

}

