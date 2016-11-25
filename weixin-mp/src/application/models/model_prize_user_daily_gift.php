<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_prize_user_daily_gift extends MY_Model {
	const TABLE = 'prize_user_daily_gift';

	function __construct() {
		parent::__construct();
		$this->_keys = array(
			'open_id',
			'date',
		);
		
		$this->_field_default_values = array(
			'user_tel' => '',
			'total_cnt' => 2,
			'remain_cnt' => 2,
			'prize' => '',
		);
		
		$this->_fields = array_merge($this->_keys, array_keys($this->_field_default_values));
		
	}
	
	function upsert_user_daily_gift($game_name, $data){
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
	
	public function get_user_daily_gift($game_name, $item){
		$db = $this->get_db($game_name);
		$query = $db->get_where(self::TABLE, $item);
		return $query->row_array();
	}
	
	public function get_one_user_all_gifts($game_name, $item){
		$db = $this->get_db($game_name);
		$db->select('date, prize')
			->from(self::TABLE)
			->where($item)
			->order_by('date desc');
		return $db->get()->result_array();
	}
	
	public function check_user_tel($game_name, $item){
		$db = $this->get_db($game_name);
		$db->select("*")
			->from(self::TABLE)
			->where($item)
			->where('user_tel !=', 0);
		return $db->get()->row_array();
	}
	
	public function get_all_user_openids($game_name, $date){
		$db = $this->get_db($game_name);
		$db->select('open_id')
			->from(self::TABLE)
			->where('date', $date)
			->order_by('open_id asc')
			->limit('1000', 0);
		return $db->get()->result_array();
	}
	
	public function delete_unrelopenids($game_name, $openids){
		$db = $this->get_db($game_name);
		return $db->where_in('open_id', $openids)->delete(self::TABLE);
	}
	
}