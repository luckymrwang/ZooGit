<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_players extends MY_Model {
	const TABLE = 'players';
	public $table = self::TABLE;

	public function __construct() {
		parent::__construct();
		$this->_table_name = self::TABLE;
		
		$this->_keys = array(
			'mobile',
		);
		
		$this->_field_default_values = array(
			'qq' => 0,
			'sex' => '',
			'age' => '',
			'create_time' => 0,
			'userid' => 0,
			'big_app_id' => 0,
			'zid' => 0,
			'ulvl' => '-1',
			'viplvl' => '-1',
			'consume_time' => 0,
		);
		
		$this->_fields = array_merge($this->_keys, array_keys($this->_field_default_values));
	}
	
	public function check_users_info($game_name, $players_msg) {
		$db = $this->get_db($game_name);
		$db->select('*')
			->from(self::TABLE)
			->where('mobile', $players_msg['mobile']);
		$ret = $db->get()->result_array();
		if(!empty($ret))
			return array('status'=>0);
		
		return array('status'=>1);
	}
	
	public function save_users_info($game_name, $players_msg) {
		$db = $this->get_db($game_name);
		$db->insert(self::TABLE, $players_msg);
		return TRUE;
	}
	
	public function save_user_info_by_mobile($game_name, $user_info, $mobile) {
		$db = $this->get_db($game_name);
		$db->where($mobile);
		$db->update(self::TABLE, $user_info);
		return TRUE;
	}
	
	public function get_use_gift_msg($game_name, $big_app_id, $st, $et) {
		$db = $this->get_db($game_name);
		$db->select('*')
			->from(self::TABLE)
			->where("create_time BETWEEN '$st' AND '$et'")
			->where('big_app_id', $big_app_id);
		$ret = $db->get()->result_array();
		
		return $ret;
	}
}