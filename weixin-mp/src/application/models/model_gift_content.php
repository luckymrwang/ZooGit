<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_gift_content extends MY_Model {
	const TABLE = 'gift_content';
	public $table = self::TABLE;

	public function __construct() {
		parent::__construct();
		$this->_table_name = self::TABLE;
		
		$this->_keys = array(
			'type',
			'sub_type',
		);
		
		$this->_field_default_values = array(
			'content' => 0,
		);
		
		$this->_fields = array_merge($this->_keys, array_keys($this->_field_default_values));
	}
	
	public function get_game_gift_content($game_name, $params) {
		$db = $this->get_db($game_name);
		$db->select('*')
			->from(self::TABLE)
			->where($params);
		$ret = $db->get()->row_array();
		if(empty($ret))
			return NULL;
		return $ret;
	}
	
	public function get_game_gift_type($game_name) {
		$db = $this->get_db($game_name);
		$db->select("*")
			->from(self::TABLE);
		$ret = $db->get()->result_array();
		return $ret;
	}
}