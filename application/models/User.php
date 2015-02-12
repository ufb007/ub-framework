<?php
/*
 *	Author: Ufuk Bozdemir
 */

class User {
	private $sessionId;
	
	public function __construct() {
		
	}
	
	public function getAllUsers() {
		try {
			$db = Initializer::initDB();
		
			$select = $db->select();
			
			$select->from(array('u' => 'users'), array('id', 'name', 'surname', 'timestamp'));
			
			$result = $select->fetchAllObj();

			return $result;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function _authenticate() {
		
	}
}