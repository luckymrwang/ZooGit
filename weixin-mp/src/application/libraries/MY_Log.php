<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// 扩展Log，将log级别调整下
class MY_Log extends CI_Log {
	public function __construct() {
		parent::__construct();

		//updated log levels according to the correct order
		$this->_levels	= array('ERROR' => '1', 'INFO' => '2',  'DEBUG' => '3', 'ALL' => '4');
	}
}