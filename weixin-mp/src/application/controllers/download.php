<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->config('meta_config');
		
	}
	
	public function index(){
		$game_name = $this->input->get_post('game');
		$meta = $this->config->item($game_name);
		
		$view_data['title'] = $meta['download']['title'];
		$view_data['description'] = $meta['download']['description'];
		$view_data['keywords'] = $meta['download']['keywords'];
		$this->load->view("reg/$game_name/download", $view_data);
	}
	
	public function player_reg(){
		$game_name = $this->input->get_post('game');
		$weixin_id = MY_Gift::get_weixin_id_by_game_name($game_name);
		$meta = $this->config->item($game_name);
		$random_data = mt_rand(0, 65536);
		$params = array(
			'game_name' => $game_name,
			'wx_id' => $weixin_id,
			'random_data' => $random_data,
		);
		$sign = MY_Sign::get_sign($game_name, $params);
		
		$view_data['title'] = $meta['download']['title'];
		$view_data['description'] = $meta['download']['description'];
		$view_data['keywords'] = $meta['download']['keywords'];
		$view_data['weixin_id']= $weixin_id;
		$view_data['sign']= $sign;
		$view_data['random_data']= $random_data;
		$this->load->view("reg/$game_name/reg", $view_data);
	}
}

