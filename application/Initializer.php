<?php
/*
 *	Author: Ufuk Bozdemir
 */

require_once '../library/UB/Controller/Load.php';
require_once '../library/UB/Controller/Action.php';
require_once '../library/UB/Db.php';

class Initializer {
	
	private static $_db;
	private static $_config;
	private static $_routes;
	
	public function __construct() {
		
	}
	
	public static function initDB() {
		if (self::$_db != null) {
			return self::$_db;
		}
		
		$db = mysqli_connect(self::config()->dbHost, self::config()->dbUser, self::config()->dbPass, self::config()->dbName);
		if (!$db) {
		    die('Could not connect: ' . mysqli_error());
		}

		self::$_db = new UB_Db($db);
		
		return self::$_db;
	}
	
	public static function config() {
	    if (self::$_config != null) {
            return self::$_config;
        }
		
        $host = $_SERVER['HTTP_HOST'];
        
		$iniArray = parse_ini_file('config/config.ini', true);

		self::$_config = new stdClass();
		
		foreach ($iniArray[$host] as $key => $content) {
			self::$_config->$key = $content;
		}
		
		return self::$_config;
	}
	
	public static function routes($route) {
        $iniArray = parse_ini_file('config/routes.ini', true);
        
        if (!empty($iniArray[$route])) {
        	 self::$_routes = $iniArray[$route];
        	 
        	 return self::$_routes;
        }
      
		return self::$_routes = null;
	}
	
	public function getAllParams() {
		
	}
	
	public function getParam($name) {
		
	}
}