<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Use_gift_msg extends MY_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Model_gifts');
		$this->load->model('Model_players');
	}
	
	public function get_use_gift() {
		$game_name = $this->input->get_post('game_name');
		$big_app_id = $this->input->get_post('big_app_id');
		$start_date = $this->input->get_post('start_date');
		$end_date = $this->input->get_post('end_date');
		
		$st = strtotime($start_date);
		$et = strtotime($end_date.'+1 day')-1;
		$use_gift_arr = $this->Model_players->get_use_gift_msg($game_name, $big_app_id, $st, $et);
		if(empty($use_gift_arr)) {
			echo json_encode(array('err_code'=>'1','err_msg'=>'empty record'));
			return;
		}
		echo json_encode($use_gift_arr);
	}
}