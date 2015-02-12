<?php
/*
 *	Author: Ufuk Bozdemir
 */
 
require_once 'abstract/ActionAbstract.php';

class UB_Controller_Load extends ActionAbstract {

	protected $_controllerLocation;
	
	public function __construct($controllerLoc) {
		$this->_controllerLocation = $controllerLoc;
	}
	
	public function dispatch() {
		$uri = $this->getUri();
		
		$controller = ucwords($uri['controller']) . 'Controller';
		$action = $uri['action'] . 'Action';
		
		$routes = $this->_routes($uri['controller']);
		
		if (is_array($routes)) {
			$controller	= $routes['controller'] . 'Controller';
			$action = $routes['action'] . 'Action';
		}
		
		require_once $this->_controllerLocation . "/" . $controller . ".php";
		
		$controller = new $controller();
		$controller->{$action}();
	}
	
	public function getUri() {
		$params = explode('/', substr($_SERVER['REQUEST_URI'], 1));

		$controller = ($params[0] != null) ? $params[0] : 'index';
		$action = isset($params[1]) ? $params[1] : 'index';
		
		return array('controller' => $controller, 'action' => $action);
	}
}