<?php
/*
 *	Author: Ufuk Bozdemir
 */
 
abstract class ActionAbstract {
	protected function _routes($controller) {
		$routes = Initializer::routes($controller);
		
		if (!empty($routes)) {
			return $routes;
		}
		
		return false;
	}
}