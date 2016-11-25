<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_prize_gift_num extends MY_Model {
	const TABLE = 'prize_gift_num';

	function __construct() {
		parent::__construct();
		$this->_keys = array(
			'id',
		);
		
		$this->_field_default_values = array(
			'gift_num' => '',
			'type' => '',
			'status' => 0,
		);
		
		$this->_fields = array_merge($this->_keys, array_keys($this->_field_default_values));
		
	}
	
	function upsert_gift_num($game_name, $data){
		$wheres = $this->_keys_prepared($data);
		if($wheres === FALSE)
			return FALSE;
		$db = $this->get_db($game_name);
		$db->select("*")
			->from(self::TABLE)
			->where($wheres);
		$infos = $db->get()->row_array();

		if(!empty($infos)){
			$filted_data = array();
			foreach($this->_fields as $field) {
				if(array_key_exists($field, $data)) {
					$filted_data[$field] = $data[$field];
				}
			}

			return $db->update(self::TABLE, $filted_data, $wheres);
		} else {
			$filted_data = array();
			foreach($this->_field_default_values as $field=>$default_value) {
				$filted_data[$field] = array_key_exists($field, $data) ? $data[$field] : $default_value;
			}
			
			return $db->insert(self::TABLE, array_merge($wheres, $filted_data));
		}
	}
	
	public function get_gift_num($game_name, $item){
		$db = $this->get_db($game_name);
		$db->select('*')
			->from(self::TABLE)
			->where($item)
			->where('status', 0)
			->limit(1, 0);
		return $db->get()->row_array();
	}
	
	public function get_fixed_gift_num($game_name) {
		$db = $this->get_db($game_name);
		$db->select('gift_num')
			->from(self::TABLE)
			->where('status', 0);
		return $db->get()->result_array();
	}
}