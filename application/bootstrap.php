<?php
/*
 *	Author: Ufuk Bozdemir
 */
 
session_start();

require_once 'Initializer.php';

set_include_path('../library');
set_include_path('../application/models' . PATH_SEPARATOR . 'controllers' . PATH_SEPARATOR . '../application/helpers' . PATH_SEPARATOR . get_include_path());

error_reporting(E_ALL);
ini_set('display_errors', 1);

$frontController = new UB_Controller_Load('../application/controllers');

$frontController->dispatch();