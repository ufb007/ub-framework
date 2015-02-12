<?php
/*
 *	Author: Ufuk Bozdemir
 */
 
class BaseModel {
	protected $_id;
	protected $_loadedResults;
	
	public function __construct($id = null) {
		if ($id != null) {
			$this->_id = $id;
		}
	}
	
	public function __get($name) {
		$var = '_' . $name;
		
		if (property_exists($this, $var)) {
			$this->_init();
			
			return $this->$var;
		}
	}
}