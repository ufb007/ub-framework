<?php
/*
 *	Author: Ufuk Bozdemir
 */

class UB_Debug {
	public static function dump($var) {
		echo '<pre>';
		print_r($var);
		echo '<pre>';
	}
}