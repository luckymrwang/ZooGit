<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	protected $dbs = array();
	protected $mongodbs = array();
	
	// 子类去填充
	protected $_table_name; // mysql table name
	protected $_keys; // key fields array
	protected $_fields; // array
	protected $_field_default_values;

	public function __construct() {
		parent::__construct();
		
		$this->load->helper('common');
	}
	
	public function __destruct() {
		foreach($this->dbs as $db) {
			$db->close();
		}
	}
	
	public function get_db($game_name) {
		$this->dbs[$game_name] = $this->load->database($game_name, TRUE);

		// Hack CI里的profile
		$ci = &get_instance();
		$ci->rayjoy_wx_data[] = $this->dbs[$game_name];
		
		return $this->dbs[$game_name];
	}
	
	public function last_query() {
		return $this->db->last_query();
	}
	
	public function error_message() {
		return $this->db->_error_message();
	}
	
	public function error_number() {
		return $this->db->_error_number();
	}
	
	protected function _keys_prepared($data) {
		$wheres = array();
		foreach($this->_keys as $key_field) {
			if(!array_key_exists($key_field, $data)) {
				return false;
			}
			$wheres[$key_field] = $data[$key_field];
		}
		return $wheres;
	}
	
	// 子类可覆盖这几个方法，得到upsert/insert/update之前处理特殊数据或一些其他操作的机会
	// 注意这些类的$data前边的&符号不要丢了
	protected function _before_upsert($game_name, &$data) {
		return;
	}
	protected function _before_insert($game_name, &$data) {
		return;
	}
	protected function _before_update($game_name, &$data) {
		return;
	}
	
	public function upsert($game_name, $data) {
		$wheres = $this->_keys_prepared($data);
		if($wheres === false)
			return false;
		
		$db = $this->get_db($game_name);
		$cnt = $db->from($this->_table_name)->where($wheres)->count_all_results();
		if($cnt === 1) {
			$filted_data = array();
			foreach($this->_fields as $field) {
				if(array_key_exists($field, $data)) {
					$filted_data[$field] = $data[$field];
				}
			}
			return $db->update($this->_table_name, $filted_data, $wheres);
		} else {
			$filted_data = array();
			foreach($this->_field_default_values as $field=>$default_value) {
				$filted_data[$field] = array_key_exists($field, $data) ? $data[$field] : $default_value;
			}
			return $db->insert($this->_table_name, array_merge($wheres, $filted_data));
		}
	}
}
