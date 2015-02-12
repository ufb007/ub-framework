<?php
/*
 *	Author: Ufuk Bozdemir
 */

class UB_Db_Query {
	protected $_select = "SELECT ";
	protected $_fields;
	protected $_from;
	protected $_innerJoin;
	protected $_leftJoin;
	protected $_where;
	protected $_order;
	protected $_group;

	public function __construct() {

	}

	public function __get($var) {
		switch($var) {
			case 'innerJoin':
					
				break;
		}
	}
	
	protected function _resetFields() {
		$properties = get_object_vars($this);
		
		foreach ($properties as $key => $property) {
			if ($key == '_select') {
				$this->{$key} = "SELECT ";	
			} else {
				unset($this->{$key});
			}
		}
	}
	
	public function from(array $tableName, array $fields = null) {		
		$this->_resetFields();
		
		$this->_fields = array();
		
		if (!empty($fields)) {
			foreach ($fields as $field) {
				$this->_fields[] = $field;
			}
		}
		
		foreach ($tableName as $key => $value) {
			$this->_from = "FROM `$value` AS $key ";
		}
	}
	
	public function innerJoin(array $tableName, $on, array $fields) {
		$this->_innerJoin = array();
		
		if (!empty($fields)) {
			foreach ($fields as $key => $field) {
				if (is_string($key)) {
					$this->_fields[] = "$field AS $key";
				} else {
					$this->_fields[] = $field;
				}
			}
		}
		
		foreach ($tableName as $key => $value) {
			$this->_innerJoin[] = "INNER JOIN $value AS $key ON $on ";
		}
	}
	
	public function leftJoin(array $tableName, $on, array $fields) {
		$this->_leftJoin = array();
		
		if (!empty($fields)) {
			foreach ($fields as $field) {
				$this->_fields[] = $field;
			}
		}
		
		foreach ($tableName as $key => $value) {
			$this->_leftJoin[] = "LEFT JOIN $value AS $key ON $on";
		}
	}
	
	public function where($where) {
		$this->_where = array();
		
		$this->_where[] = "WHERE $where ";
	}
	
	public function order($order) {
		$this->_order = "ORDER BY $order";
	}
	
	public function group($group) {
		$this->_group = "GROUP BY $group";
	}
	
	public function fetchRowObj() {
		$select = $this->_combine();

		$db = Initializer::initDB();

		$query = mysqli_query($db->con, $select);
		
		$row = mysqli_fetch_assoc($query);
		
		$objectRows = new stdClass();
		
		foreach ($row as $key => $value) {
			$objectRows->{$key} = $value;
		}

		return $objectRows;
	}
	
	public function insert($tableName, array $fields) {
		try {
			$insertQuery = "INSERT INTO `$tableName` (";
			
			$count = 0;
			
			foreach ($fields as $key => $value) {
				$insertQuery .= "`$key`";
				
				if ($count != (count($fields) - 1)) {
					$insertQuery .= ",";
				}
				
				$count++;
			}
			
			$insertQuery .= ") VALUES(";
			
			$count = 0;
			
			foreach ($fields as $key => $value) {
				preg_match('/NOW()/', $value, $matches);
				if ($matches) {
					$insertQuery .= "$value";
				} else {			
					if (is_string($value)) {
						$insertQuery .= "'$value'";
					} else {
						$insertQuery .= "$value";
					}
				}
				
				if ($count != (count($fields) - 1)) {
					$insertQuery .= ",";
				}
				
				$count++;
			}
			
			$insertQuery .= ")";
			
			return $this->_insert($insertQuery);
			
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function fetchAllObj() {
		$select = $this->_combine();

		$db = Initializer::initDB();

		$query = mysqli_query($db->con, $select);
		
		$rows = array();
		
		while ($row = mysqli_fetch_assoc($query)) {
			$rows[] = $row;
		}
		
		$objectRows = array();
		
		foreach ($rows as $rowKey => $value) {
			$objectRows[$rowKey] = new stdClass();
			
			foreach ($value as $key => $value) {
				$objectRows[$rowKey]->{$key} = $value;
			}
		}

		return $objectRows;
	}
	
	protected function _insert($query = null) {
		try {
			return mysqli_query($query);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	protected function _combine() {
		$query = '';
		$fields = '';
		
		if (empty($this->_fields)) {
			$fields = '*';
		} else {
			$fields = implode(', ', $this->_fields);
		}
		
		$this->_fields = $fields . ' ';
		
		$properties = get_object_vars($this);
		
		foreach ($properties as $key => $property) {
			if (!empty($property)) {
				if (is_array($property)) {
					foreach ($property as $p) {
						$query .= $p;
					}
				} else {
					$query .= $property;
				}
			}
		}
		
		return $query;
	}
}