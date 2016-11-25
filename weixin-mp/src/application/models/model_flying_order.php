<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Model_flying_order extends MY_Model {
	const TABLE = 'flying_orders';

	public function __construct() {
		parent::__construct();
	}
	
	public function get_orders($zone_id, $game_user_id) {
		$this->db->from(self::TABLE)
				->where('zone_id', $zone_id)
				->where('game_user_id', $game_user_id);
		return $this->db->get()->result_array();
	}
	
	// 返回1表示插入ok，返回0表示插入失败
	public function insert_order($order_id, $zone_id, $game_user_id) {
		$this->db->insert(self::TABLE, array(
			'order_id' => $order_id,
			'zone_id' => $zone_id,
			'game_user_id' => $game_user_id,
		));
		return $this->db->affected_rows();
	}
	
	public function delete_order($order_id) {
		$this->db->delete(self::TABLE, array('order_id'=>$order_id));
	}
}
