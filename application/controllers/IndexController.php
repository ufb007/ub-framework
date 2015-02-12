<?php
/*
 *	Author: Ufuk Bozdemir
 */

require_once 'User.php';
require_once 'UB/Debug.php';

class IndexController extends UB_Controller_Action {
	protected $_details;

	public function __construct() {
		parent::__construct();

		$this->_details = array(
			'title'		=> 'UB Framework - Simple framework',
			'keywords'	=> '' 
		);
	}

	public function indexAction() {
		$this->view->showthis = 'UB Framework - Simple framework still in very early stages. Need to write documentation but feel free to have a look.';
		
	    /*$user = new User();
		$results = $user->getAllUsers();
		UB_Debug::dump($results);*/

		$this->dispatchView('layouts/main-layout', $this->_details);
	}

	public function loginAction() {
		$this->_details['title'] = 'Login - UB Framework';

		$this->dispatchView('layouts/main-layout', $this->_details);
	}
}