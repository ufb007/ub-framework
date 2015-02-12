<?php
/*
 *	Author: Ufuk Bozdemir
 */
 
require_once 'abstract/ActionAbstract.php';

class UB_Controller_Action extends ActionAbstract {
	protected $_controller;
	protected $_action;
	protected $view;
	
	public function __construct() {
		$this->_controller = $this->getController();
		$this->_action = $this->getAction();
		
		$this->view = new stdClass();
	}
		
	protected function getAllParams($type = null) {
		$getParams = explode('/', substr($_SERVER['REQUEST_URI'], 1));
		
		$params = array();
		
		for ($i = 2; $i < (count($getParams) - 1); $i++) {
			$params[$getParams[$i]] = $getParams[$i + 1];
		}
		
		return $params;
	}
	
	protected function getController() {
		$getParams = explode('/', substr($_SERVER['REQUEST_URI'], 1));
		
		$routes = $this->_routes($getParams[0]);
		$controller = $getParams[0];
		
		if (is_array($routes)) { 
			$controller = $routes['controller'];
		}
		
		return ($controller != null) ? $controller : 'index';
	}
	
	protected function getAction() {
		$getParams = explode('/', substr($_SERVER['REQUEST_URI'], 1));
		
		$routes = $this->_routes($getParams[0]);
		$action = isset($getParams[1]) ? $getParams[1] : null;
		
		if (is_array($routes)) { 
			$action = $routes['action'];
		}
				
		return isset($action) ? $action : 'index';
	}
	
	protected function getParam($name) {
		
	}
	
	public function __get($var) {
		return $this->view->{$var};
	}
	
	public function __set($name, $value) {
		$this->view->{$name} = $value;
	}
	
	protected function dispatchView($layout = null, array $head = null) {
		$bodyTpl = '../application/views/' . $this->_controller . '/' . $this->_action . '.tpl';
		
		if ($layout != null) {
			require_once '../application/' . $layout . '.tpl';
		} else {
			require_once $bodyTpl;
		}
	}
}