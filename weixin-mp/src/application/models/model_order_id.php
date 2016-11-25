<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_order_id extends MY_Model {
	const TABLE = 'rsdk_order_id';

	public function __construct() {
		parent::__construct();
		
		$this->_table_name = self::TABLE;
		/*
		$this->_keys = array(
			'order_id',
		);
		
		$this->_field_default_values = array(
			'create_time' => 0,
			'trade_type' => '',
			'user_info' => '',
		);
		
		$this->_fields = array_merge($this->_keys, array_keys($this->_field_default_values));
		 *
		 */
	}
	
	public function create_order_id($params) {
		// 未传此参数时默认为安卓，其他ios\3th由客户端传
		$os = $params['os']===FALSE ? 'and' : $params['os'];
		
		$filter_data = array(
			'create_time' => $params['create_time'],
			'trade_type' => $params['trade_type'],
			'zone_id' => $params['zone_id'],
			'game_user_id' => $params['game_user_id'],
			'platform_user_id' => $params['platform_user_id'],
			'product_id' => $params['product_id'],
			'product_type' => $params['product_type'],
			'cost' => $params['cost'],
			'num' => $params['num'],
			'os' => $os,
		);
		
		if($params['private_data'] !== FALSE) {
			$filter_data['private_data'] = $params['private_data'];
		}
		
		$this->db->insert(self::TABLE, $filter_data);
		
		return $this->db->insert_id();
	}
	
	public function get_order($order_id) {
		$this->db->from(self::TABLE)
				->where('order_id', $order_id);
		return $this->db->get()->row_array();
	}
}
