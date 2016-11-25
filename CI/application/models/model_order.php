<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_order extends MY_Model {
	const TABLE = 'orders';

	public function __construct() {
		parent::__construct();
		
		$this->_table_name = self::TABLE;
		
		$this->_fields = array(
			'order_id',
			'platform_order_id',
			'game_order_id',
			'game_user_id',
			'nick_name',
			'platform_user_id',
			'cost',
			'num',
			'product_id',
			'product_type',
			'trade_type',
			'money_type',
			'status',
			'error_msg',
			'create_time',
			'update_time',
			'datestr',
			'extra_num',
			'user_level',
			'vip_level',
			'os',
			'if_first_buy',
			'zone_id',
			'order_state_month',
			'ext_int1',
			'ext_int2',
			'ext_vchar1',
			'ext_vchar2',
			'ext_vchar3',
			'ip', //ip:每一笔充值的ip
			'reg_time',
			'login_time',
			'own_gold', //发生后的用户身上剩余金币数
			'log_type', //1：消费，2：赠送，0或者空：充值
			'point',
			'free_point',
		);
	}
	
	public function insert($params) {
		foreach(array_keys($params) as $field) {
			if(!in_array($field, $this->_fields)) {
				unset($params[$field]);
			}
		}
			
		$this->db->insert(self::TABLE, $params);
		return $this->db->affected_rows();
	}
	
	public function update($order_id, $data) {
		foreach(array_keys($data) as $field) {
			if(!in_array($field, $this->_fields)) {
				unset($data[$field]);
			}
		}

		$this->db->where('order_id', $order_id)->update(self::TABLE, $data);
		return $this->db->affected_rows();
	}
	
	public function get_order($order_id) {
		$this->db->where('order_id', $order_id);
		return $this->db->get(self::TABLE)->row_array();
	}
	
	public function get_period_orders($start_time, $end_time) {
		$this->db->where("create_time BETWEEN '$start_time' AND '$end_time'");
		return $this->db->get(self::TABLE)->result_array();
	}
	
	public function get_period_sum($start_time, $end_time) {
		// 以下命名不规范，但是为了兼容旧版本
		$this->db->select('count(*) AS count')
				->select('SUM(cost) AS sumcost')
				->select('SUM(num) AS sumnum')
				->where("create_time BETWEEN '$start_time' AND '$end_time'");
		return $this->db->get(self::TABLE)->result_array();
	}
	
	public function get_orders_by_order_ids($order_ids) {
		$this->db->where_in('order_id', $order_ids);
		return $this->db->get(self::TABLE)->result_array();
	}
}
