<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_gifts extends MY_Model {
	const TABLE = 'gifts';
	public $table = self::TABLE;

	public function __construct() {
		parent::__construct();
		$this->_table_name = self::TABLE;
		
		$this->_field_default_values = array(
			'random_part' => 0,
			'type' => 0,
			'sub_type' => 0,
			'status' => 0,
		);
		
		$this->_fields = array_keys($this->_field_default_values);
	}
	
	public function create_gift_num($game_name, $gift_arr) {
		$db = $this->get_db($game_name);
		$db->insert(self::TABLE, $gift_arr);
		
		$insert_id = $db->insert_id();
		$db->select('*')
			->from(self::TABLE)
			->where('id', $insert_id);
		$ret = $db->get()->result_array();
		unset($ret[0]['open_id']);
		return $ret[0];
	}
	
	public function check_game_gift_num($game_name, $gift_num_arr) {
		$db = $this->get_db($game_name);
		$db->select('*')
			->from(self::TABLE)
			->where($gift_num_arr);
		$ret = $db->get()->result_array();
		if(empty($ret))
			return '-21';
		if($ret[0]['status'] == 1)
			return '-22';
		
		return '1';
	}
	
	public function check_gift_num_by_open_id($game_name, $open_id, $gift_type, $gift_sub_type) {
		$db = $this->get_db($game_name);
		$db->select('*')
			->from(self::TABLE)
			->where('open_id',"$open_id")
			->where('type',$gift_type)
			->where('sub_type',$gift_sub_type);
		$ret = $db->get()->result_array();
		return $ret;
	}
	
	public function change_gift_status($game_name, $gift_num_arr) {
		$db = $this->get_db($game_name);
		$db->where($gift_num_arr);
		$db->update(self::TABLE, array('status'=>1));
		return TRUE;
	}
	
	public function get_user_mobile($game_name, $gift_num_arr) {
		$db = $this->get_db($game_name);
		$db->select('open_id')
			->from(self::TABLE)
			->where($gift_num_arr);
		$ret = $db->get()->row_array();
		return $ret;
	}
}