<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examination extends MY_Controller {
	const Access_token = 'XpWJt-_QPyzb85h0orVxwJ4teuQMVg2PoE5MVUwmO27RFISWT1d_WhsimXAOk7CmD7QhqJgypIRdrk7YwqiifrijeRsUWnvpAfOQQAKFGLc';
	private $appId = 'wxd377c6c99078f542';
	private $appSecret = 'db202c1e94a32efb06b374d1808e6a86';
	private $redirectdomain = 'http://opsnode.raysns.com/weixin_wcl/';

	public function __construct() {
		parent::__construct();

		$this->layout = 'layout/classic';
		$this->layout_data['title'] = 'Examination';
//		$this->layout_data['sidebar_file'] = '_week_report';
		
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->model('Model_prize_user_daily_gift');
		$this->load->model('Model_prize_gift_num');
	}

	public function get_user_open_id(){
		// 删除旧session
		$this->session->unset_userdata(array(
			'game_name' => '',
			'open_id' => '',
		));

		$game_name = $this->input->get_post('game_name');
		$code = $this->input->get_post('code');
		if(!empty($code)) {
			$appid = 'wxd377c6c99078f542';
			$secret = 'db202c1e94a32efb06b374d1808e6a86';

			$openid_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";

			$ch = curl_init($openid_url);
			curl_setopt($ch, CURLOPT_TIMEOUT, 100);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$ret_raw = curl_exec($ch);
			curl_close($ch);

			$ret = json_decode($ret_raw, true);
			$open_id = $ret['openid'];

			$this->session->set_userdata(array(
				'game_name' => $game_name,
				'open_id' => $open_id,
			));
		}
		redirect("scratch_card/index");
	}

	public function index(){
//		if(!$this->is_weixin()){
//			echo "请使用微信访问本网址";
//			return;
//		}

//		$from = $this->input->get_post('from');
//		if(!empty($from)){
//			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
//			header("Location:$url");
//			return;
//		}
//		
//		$game_name = $this->session->userdata('game_name');
//		$item['open_id'] = $this->session->userdata('open_id');
//
////		if(empty($game_name) || empty($item['open_id'])){
////			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
////			header("Location:$url");
////			return;
////		}
//
//		$item['date'] = date('Y-m-d', time());
//		// $this->Model_prize_user_daily_gift->upsert_user_daily_gift($game_name, $item);
//		
//		// $user_infos = $this->Model_prize_user_daily_gift->get_user_daily_gift($game_name, $item);
//		// $view_data['remaining_cnt'] = $user_infos['remain_cnt'];
		$view_data['remaining_cnt'] = 0;
//		$view_data['game_name'] = $game_name;
//		$view_data['open_id'] = $item['open_id'];
//		$view_data['random_tels'] = $this->get_random_tels();
//		$view_data['signPackage'] = $this->getSignPackage();
		$this->render("examination/main.php", $view_data);
	}
	
	public function get_scratch_gift($game_name){
		$prize_infos = MY_Gift::get_config_item('prize_infos', 'scratch_card_config');
		
		$gift_info = '';
		while(empty($gift_info)){
			$random_num = mt_rand(0, self::Gifts_num);
			if(empty($prize_infos[$game_name]))
				return FALSE;
			
			foreach($prize_infos[$game_name] as $key => $val){
				$split_area = explode("~", $val['area']);
				if($random_num >= $split_area[0] && $random_num <= $split_area[1]){
					$gift_info = $this->Model_prize_gift_num->get_gift_num($game_name, array('type' => $val['type']));
					break;
				}
			}
		}
		return array('gift_info' => $gift_info);
	}
	
	public function ajax_get_scratch_gift(){
		//刮奖活动已结束
		echo json_encode(array('tag' => 3));
		return;

		$game_name = $this->session->userdata('game_name');
		$item['open_id'] = $this->session->userdata('open_id');

		if(empty($game_name) || empty($item['open_id'])){
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
			header("Location:$url");
			return;
		}

		$item['date'] = date('Y-m-d', time());
		$user_infos = $this->Model_prize_user_daily_gift->get_user_daily_gift($game_name, $item);

		if($user_infos['remain_cnt'] == 0){
			if($user_infos['total_cnt'] != 5){
				echo json_encode(array('tag' => 1));  //分享获得更多刮奖机会
			} else {
				echo json_encode(array('tag' => 2));  //啊哦，今天没有机会刮奖了，欢迎明天再来
			}
			return;
		}
		
		$gift_infos = $this->get_scratch_gift($game_name);
		
		if(!empty($gift_infos)){
			$this->gift_consume($game_name, $item, $gift_infos['gift_info']);
			$gift_infos['tag'] = 0;
			$gift_infos['remain_cnt'] = $user_infos['remain_cnt'];
			echo json_encode($gift_infos);
		}
	}
	
	public function gift_consume($game_name, $item, $gift_info){
		$user_infos = $this->Model_prize_user_daily_gift->get_user_daily_gift($game_name, $item);

		$prize = array();
		$prize = json_decode($user_infos['prize'], TRUE);
		$gift_flip = array_flip($prize);
		//获取固定的5个礼包码
		$fixed_gift_num = $this->Model_prize_gift_num->get_fixed_gift_num($game_name);
		foreach($fixed_gift_num as $k=>$gift_num) {
			if(!array_key_exists($gift_num['gift_num'], $gift_flip)) {
				$prize[] = $gift_num['gift_num'];
				break;
			}
		}
		//$prize[] = $gift_info['gift_num'];
		
		$item['prize'] = json_encode($prize);
		$item['remain_cnt'] = $user_infos['remain_cnt'] - 1;
		$this->Model_prize_user_daily_gift->upsert_user_daily_gift($game_name, $item);
		
		//$this->Model_prize_gift_num->upsert_gift_num($game_name, array('id' => $gift_info['id'], 'status' => 1));
	}
	
	public function get_more_scratch_cnt(){
		//刮奖活动已结束
		echo "刮奖活动已结束,欢迎下次再来";
		return;

		$game_name = $this->session->userdata('game_name');
		$item['open_id'] = $this->session->userdata('open_id');

		if(empty($game_name) || empty($item['open_id'])){
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
			header("Location:$url");
			return;
		}

		$item['date'] = date('Y-m-d', time());
		$user_infos = $this->Model_prize_user_daily_gift->get_user_daily_gift($game_name, $item);
		
		if($user_infos['total_cnt'] == 5){
			echo "今日获取刮奖次数已上限";
			return;
		}
		
		$item['total_cnt'] = $user_infos['total_cnt'] + 1;
		$item['remain_cnt'] = $user_infos['remain_cnt'] + 1;
		$this->Model_prize_user_daily_gift->upsert_user_daily_gift($game_name, $item);
		return;
	}
	
	public function scan_my_all_gifts(){
		if(!$this->is_weixin()){
			echo "请使用微信访问本网址";
			return;
		}

		$from = $this->input->get_post('from');
		if(!empty($from)){
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
			header("Location:$url");
			return;
		}
		
		$game_name = $this->session->userdata('game_name');
		$item['open_id'] = $this->session->userdata('open_id');

		if(empty($game_name) || empty($item['open_id'])){
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->$redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
			header("Location:$url");
			return;
		}

		$user_infos = $this->Model_prize_user_daily_gift->get_one_user_all_gifts($game_name, $item);
		$outs = array();
		foreach($user_infos as $val){
			$outs[$val['date']] = json_decode($val['prize'], TRUE);
		}
		
		$view_data['game_name'] = $game_name;
		$view_data['open_id'] = $item['open_id'];
		$view_data['items'] = $outs;

		$this->load->view("scratch_card/view_my_all_gifts.php", $view_data);
	}
	
	public function ajax_update_user_tel(){
		$game_name = $this->session->userdata('game_name');
		$item['open_id'] = $this->session->userdata('open_id');

		if(empty($game_name) || empty($item['open_id'])){
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd377c6c99078f542&redirect_uri='.$this->redirectdomain.'scratch_card/get_user_open_id?game_name=hot_blood_tank&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect';
			header("Location:$url");
			return;
		}

		$item['user_tel'] = $this->input->get_post('tel');
		$item['date'] = date('Y-m-d', time());
		$this->Model_prize_user_daily_gift->upsert_user_daily_gift($game_name, $item);
	}
	
	public function check_user_tel(){
		$game_name = $this->input->get_post('game_name');
		$item['open_id'] = $this->input->get_post('open_id');
		$result = $this->Model_prize_user_daily_gift->check_user_tel($game_name, $item);
		if($result['cnt'] != 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	public function get_random_tels(){
		$random_tel_prefix = MY_Gift::get_config_item('random_tel_prefix', 'scratch_card_config');
		$random_tel_suffix = MY_Gift::get_config_item('random_tel_suffix', 'scratch_card_config');
		$outs = array();
		for($i = 0; $i < 5; $i++){
			$index_prefix = mt_rand(0, count($random_tel_prefix) - 1);
			$index_suffix = mt_rand(0, count($random_tel_suffix) - 1);
			$outs[] = $random_tel_prefix[$index_prefix]."****".mt_rand(1000, 9999).$random_tel_suffix[$index_suffix];
		}
		return $outs;
	}
	
	public function is_weixin(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
			return true;
		}

		return false;
	}
	
	public function delete_unrelopenids(){
		set_time_limit(0);
		$date = $this->input->get_post('date');
		if(empty($date)){
			$date = date('Y-m-d', time());
		}
		
		$openids = $this->get_real_openid_parallel($date);
		if(!empty($openids)){
			$this->Model_prize_user_daily_gift->delete_unrelopenids('hot_blood_tank', $openids);
		}
	}

	public function get_real_openid_parallel($date){
		$requests = array();
		$all_openids = $this->Model_prize_user_daily_gift->get_all_user_openids('hot_blood_tank', $date);
		foreach($all_openids as $val){
			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".self::Access_token."&openid={$val['open_id']}&lang=zh_CN";
			
			$requests[$val['open_id']] = array(
				'url' => $url,
				'timeout' => 20
			);
		}
			
		$raw_rets = self::multi_curl($requests);
		$unrelids = array();
		foreach($raw_rets as $key => $ret) {
			$ret = json_decode($ret, TRUE);
			if(!isset($ret['subscribe'])){
				$unrelids[] = $key;
			}
		}
		
		return $unrelids;
	}
	
	public static function multi_curl($requests) {
		$mh = curl_multi_init();
		$chs = array();
		foreach ($requests as $key => $req) {
			$timeout = empty($req['timeout']) ? 20 : $req['timeout'];
			$ch = curl_init($req['url']);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			if(defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
				curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			}

			curl_multi_add_handle($mh, $ch);
			$chs[$key] = $ch;
		}
		
		$active = null;
		do {
			$mrc = curl_multi_exec($mh, $active);
		} while($mrc == CURLM_CALL_MULTI_PERFORM);
		
		while($active && $mrc==CURLM_OK) {
			if(curl_multi_select($mh) != -1) {
				do {
					$mrc = curl_multi_exec($mh, $active);
				} while($mrc == CURLM_CALL_MULTI_PERFORM);
			}
			usleep(100);
		}
		
		$rets = array();
		foreach($chs as $key => $ch) {
			$rets[$key] = curl_multi_getcontent($ch);
			curl_multi_remove_handle($mh, $ch);
			curl_close($ch);
		}
		curl_multi_close($mh);
		
		return $rets;
	}

public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $jsapi_ticket_path = base_url('assets/card/jsapi_ticket.json');
    $data = json_decode(file_get_contents($jsapi_ticket_path));
    if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        // $fp = fopen($jsapi_ticket_path, "w");
        // fwrite($fp, json_encode($data));
        // fclose($fp);
        write_file($jsapi_ticket_path, json_encode($data));
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }

    return $ticket;
  }

  private function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $access_token_path = base_url('assets/card/access_token.json');
    $data = json_decode(file_get_contents($access_token_path));
    if ($data->expire_time < time()) {
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url));
      $access_token = $res->access_token;
      if ($access_token) {
        $data->expire_time = time() + 7000;
        $data->access_token = $access_token;
        // $fp = fopen($access_token_path, "w");
        // fwrite($fp, json_encode($data));
        // fclose($fp);
        write_file($access_token_path, json_encode($data));
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
}
