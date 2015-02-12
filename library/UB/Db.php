<?php
/*
 *	Author: Ufuk Bozdemir
 */
 
require_once 'Db/Query.php';

class UB_Db {
	protected $_from;
	protected $_where;
	protected $_order;
	protected $_innerJoin;
	protected $_leftJoin;
	protected $_queries;
	
	public function __construct($db) {
		$this->_queries = new UB_Db_Query();
		$this->con = $db;
	}
	
	public function select() {
		return $this->_queries;
	}
	
	public function insert($tableName, array $fields) {
		return $this->_queries->insert($tableName, $fields);
	}
}