<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gift extends MY_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Model_gifts');
		$this->load->model('Model_gift_content');
		$this->load->model('Model_players');
		$this->load->helper('url');
		$this->load->config('meta_config');
	}
	
	public function gift_consume() {
		$game_name = $this->input->get_post('game_name');
		$gift_num = $this->input->get_post('gift_num');
		$user_info = $this->input->get_post('user_info');
		$status = $this->input->get_post('status');
		$sign = $this->input->get_post('sign');
		
		$params = array(
			'game_name' => $game_name,
			'gift_num' => $gift_num,
			'status' => $status,
			'sign' => $sign,
		);
		if(!empty($user_info)){
			$params['user_info'] = $user_info;
		}
		
		// 签名验证
		$err_msg = $this->check_md5_sign($game_name, $params);
		if(!empty($err_msg)) {
			echo $err_msg;
			return;
		}
		
		// 严格控制礼包码的格式
		if(substr_count($gift_num,'-') != 4) {
			echo json_encode(array('ret'=>-1,'msg'=>'无效激活码'));
			return;
		}
		
		$split_gift_num = explode('-', $gift_num);
		$decode_id = Base62::decode($split_gift_num[1]);
		$decode_random_part = Base62::decode($split_gift_num[2]);
		$gift_num_arr = array(
			'id' => $decode_id,
			'random_part' => $decode_random_part,
			'type' => $split_gift_num[3],
			'sub_type' => $split_gift_num[4],
		);
		
		if($status == '1') {
			// 存储注册玩家信息，方便分析
			if($gift_num_arr['type'] == 2 && !empty($user_info)) {
				$ret = $this->Model_gifts->get_user_mobile($game_name, $gift_num_arr);
				$mobile = array("mobile"=>$ret['open_id']);
				$user_infos = array_merge(json_decode($user_info,TRUE),array("consume_time"=>time()));
				$this->Model_players->save_user_info_by_mobile($game_name, $user_infos, $mobile);
			}
			$ret = $this->Model_gifts->change_gift_status($game_name, $gift_num_arr);
			return;
		}
		
		$is_consume = $this->Model_gifts->check_game_gift_num($game_name, $gift_num_arr);
		if($is_consume != '1') {
			if($is_consume == '-21')
				echo json_encode(array('ret'=>-21,'msg'=>'该激活码不存在','data'=>array()));
			if($is_consume == '-22')
				echo json_encode(array('ret'=>-22,'msg'=>'该激活码已经被使用','data'=>array()));
			return;
		}
		
		unset($gift_num_arr['id']);
		unset($gift_num_arr['random_part']);
		$gift_res = $this->Model_gift_content->get_game_gift_content($game_name, $gift_num_arr);
		if(empty($gift_res)) {
			echo json_encode(array('ret'=>-3,'msg'=>'该激活码不存在对应的礼包','data'=>array()));
			return;
		}
		
		$gift_content = json_decode($gift_res['content'], TRUE);
		foreach($gift_content as $key=>$item) {
			$content[] = array('item_id'=>$item['item_id'],'item_count'=>$item['item_count']);
		}
		$type = $gift_res['type'];
		$sub_type = $gift_res['sub_type'];

		$gift_content = array('ret'=>0,'msg'=>'Success','data'=>array('type'=>$type,'sub_type'=>$sub_type,'content'=>$content));
		$json_ret = json_encode($gift_content);
		echo $json_ret;
	}
	
	public function get_gift_content() {
		$game_name = $this->input->get_post('game_name');
		$type = $this->input->get_post('type');
		$sub_type = $this->input->get_post('sub_type');
		$sign = $this->input->get_post('sign');
		
		$params = array(
			'game_name' => $game_name,
			'type' => $type,
			'sub_type' => $sub_type,
			'sign' => $sign,
		);
		
		// 签名验证
		$err_msg = $this->check_md5_sign($game_name, $params);
		if(!empty($err_msg)) {
			echo $err_msg;
			return;
		}
		
		unset($params['sign']);
		unset($params['game_name']);
		$gift_content = $this->Model_gift_content->get_game_gift_content($game_name, $params);
		if(empty($gift_content)) {
			echo json_encode(array('error'=>'查询的礼包不存在'));
			return;
		}
		
		echo $gift_content['content'];
	}
	
	public function set_gift_content() {
		$game_name = $this->input->get_post('game_name');
		$type = $this->input->get_post('type');
		$sub_type = $this->input->get_post('sub_type');
		$content = $this->input->get_post('content');
		$sign = $this->input->get_post('sign');
		
		$params = array(
			'game_name' => $game_name,
			'type' => $type,
			'sub_type' => $sub_type,
			'content' => $content,
			'sign' => $sign,
		);
		
		// 签名验证
		$err_msg = $this->check_md5_sign($game_name, $params);
		if(!empty($err_msg)) {
			echo $err_msg;
			return;
		}
		
		//验证content
		$items = json_decode($content, TRUE);
		if(!$items || !isset($items[0])){
			echo json_encode(array('msg'=>'Gift Set Formate Wrong'));
			return ;
		}
		
		unset($params['sign']);
		unset($params['game_name']);
		$ret = $this->Model_gift_content->upsert($game_name, $params);
		if($ret){
			echo urldecode(json_encode(array('msg'=>urlencode('礼包设置成功'))));
		}else{
			echo urldecode(json_encode(array('msg'=>urlencode('礼包设置失败'))));
		}
	}
	
	public function get_gift_types() {
		$game_name = $this->input->get_post('game_name');
		$sign = $this->input->get_post('sign');
		
		$params = array(
			'game_name' => $game_name,
			'sign' => $sign,
		);
		
		// 签名验证
		$err_msg = $this->check_md5_sign($game_name, $params);
		if(!empty($err_msg)) {
			echo $err_msg;
			return;
		}
		
		unset($params['sign']);
		unset($params['game_name']);
		$ret = $this->Model_gift_content->get_game_gift_type($game_name);
		$distinct_type = $this->array_unique($ret);
		
		$temp = array();
		foreach($distinct_type as $item) {
			list($type_value, $sub_type_value) = array_values($item);
			$temp[$type_value] = array_key_exists($type_value, $temp) ? array_merge($temp[$type_value],(array)$sub_type_value) : (array)$sub_type_value;
		}
		
		$type_arr = array();
		foreach($temp as $type_value => $sub_type_value)
			$type_arr[] = array('type'=>$type_value, 'sub_type'=>$sub_type_value);
		
		echo json_encode($type_arr);
	}
	
	// 二维数组去掉重复值
	public function array_unique($array2D){
		foreach ($array2D as $k=>$v){
			$v = join(",",$v);
			$temp[$k] = $v;
		}
		$temp = array_unique($temp);
		foreach ($temp as $k => $v){
			$array=explode(",",$v);
			$disc_arr[$k]["type"] =$array[0];   
			$disc_arr[$k]["sub_type"] =$array[1];
		}
		return $disc_arr;
	}
	
	public function save_register_info() {
		$wx_id = $this->input->get_post('weixin_id');
		$mobile = $this->input->get_post('mobile');
		$qq = $this->input->get_post('qq');
		$sex = $this->input->get_post('sex');
		$age = $this->input->get_post('age');
		$sign = $this->input->get_post('sign');
		$random_data = $this->input->get_post('random_data');
		
		$game_names = MY_Gift::get_config_item('game_wx_id', 'gift_mark_config');
		$game_name = $game_names[$wx_id]['game_name'];
		$params = array(
			'game_name' => $game_name,
			'wx_id' => $wx_id,
			'random_data' => $random_data,
			'sign' => $sign,
		);
		// 签名验证
		$err_msg = $this->check_md5_sign($game_name, $params);
		if(!empty($err_msg)) {
			echo $err_msg;
			return;
		}
		
		$meta = $this->config->item($game_name);
		$gift_type = MY_Gift_Num::get_gift_type($wx_id, 'register');
		$players_msg = array(
						'mobile' => $mobile,
						'qq' => $qq,
						'sex' => $sex,
						'age' => $age,
						'create_time' => time(),
					);
		
		$ret = $this->Model_players->check_users_info($gift_type['game_name'], $players_msg);
		if($ret['status'] == '0') {
			$view_data['weixin_id'] = $wx_id;
			$view_data['sign']= $sign;
			$view_data['random_data']= $random_data;
			$view_data['title'] = $meta['download']['title'];
			$view_data['description'] = $meta['download']['description'];
			$view_data['keywords'] = $meta['download']['keywords'];
			$view_data['msg'] = '注册失败！该手机号已被注册。';
			$this->load->view("reg/$game_name/reg", $view_data);
			return;
		}
		
		// 短信发注册礼包码:先发短信再保存玩家信息
		$register_gift_num = $this->register_gift_num($gift_type['game_name'], $gift_type['gift_prefix'],$gift_type['type'],$gift_type['sub_type'],$mobile);
		$tpl_id = $game_names[$wx_id]['tpl_id'];
		$ret_json = MY_Api::mobile_message_send($register_gift_num, $mobile, $tpl_id);
		$ret_arr = json_decode($ret_json, TRUE);
		if($ret_arr['code'] == 0) {
			$this->Model_players->save_users_info($gift_type['game_name'], $players_msg);
			$view_data['msg'] = '恭喜您，注册成功！';
			$view_data['weixin_id'] = $wx_id;
			$view_data['sign']= $sign;
			$view_data['random_data']= $random_data;
			$view_data['title'] = $meta['download']['title'];
			$view_data['description'] = $meta['download']['description'];
			$view_data['keywords'] = $meta['download']['keywords'];
			$this->load->view("reg/$game_name/reg", $view_data);
			return;
		}
		
		$view_data['msg'] = '注册失败！无效手机号。';
		$view_data['weixin_id'] = $wx_id;
		$view_data['sign']= $sign;
		$view_data['random_data']= $random_data;
		$view_data['title'] = $meta['download']['title'];
		$view_data['description'] = $meta['download']['description'];
		$view_data['keywords'] = $meta['download']['keywords'];

		$this->load->view("reg/$game_name/reg", $view_data);
	}
	
	private function register_gift_num($game_name, $gift_prefix, $type, $sub_type, $mobile) {
		$sensitive_words_arr = MY_Gift::get_config_item('sensitive_words', 'sensitive_words_config');
		do {
			$is_sensitive_word = FALSE;
			$gift_num = $this->get_gift_num($game_name, $gift_prefix, $type, $sub_type, $mobile);
			foreach($sensitive_words_arr as $k=>$word) {
				if(strpos($gift_num, $word) === FALSE)
					continue;
				$is_sensitive_word = TRUE;
			}
		} while($is_sensitive_word);
		
		return $gift_num;
	}
	
	public function get_gift_num($game_name, $gift_prefix, $type, $sub_type, $mobile) {
		// 产生1~5位随机数
		$random_part = self::create_random_part();
		$gift_arr = array('random_part'=>$random_part,'open_id'=>$mobile,'type'=>$type,'sub_type'=>$sub_type);
		$ret_gift = $this->Model_gifts->create_gift_num($game_name, $gift_arr);
		$base62_id = Base62::encode($ret_gift['id']);
		$base62_random_part = Base62::encode($ret_gift['random_part']);
		$gift_num = $gift_prefix."-".$base62_id."-".$base62_random_part."-".$ret_gift['type']."-".$ret_gift['sub_type'];
		
		return $gift_num;
	}
	
	public function create_random_part() {
		$random_part = mt_rand(0, 65536);
		return $random_part;
	}
	
	public function check_md5_sign($game_name, $params) {
		$ret = MY_Sign::check_sign($game_name, $params);
		if(!$ret) {
			$err_msg = "Calculated and sent signatures do not match";
			return json_encode(array('error'=>$err_msg));
		}
		return;
	}
}
