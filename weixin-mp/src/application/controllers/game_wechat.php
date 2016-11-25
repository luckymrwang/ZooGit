<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  * wechat api
*/

//define token
define("TOKEN", "d318acca7aac2a2509b16f30f7d06fc4");

class Game_wechat extends MY_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Model_gifts');
		$this->load->model('Model_gift_content');
		$this->load->model('Model_players');
	}
	
	public function receive_wx_msg() {
		if (isset($_GET['echostr'])) {
			$this->valid();
		}else{
			$this->responseMsg();
		}
	}
	
	public function valid() {
		$echoStr = $_GET["echostr"];
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	
	public function responseMsg() {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)) { 
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
			$RX_TYPE = trim($postObj->MsgType);
			switch ($RX_TYPE)  
			{  
				case "text":  
					$resultStr = $this->receiveText($postObj);  
					break;  
				case "event":  
					$resultStr = $this->receiveEvent($postObj);  
					break;  
				default:  
					$resultStr = "unknow msg type: ".$RX_TYPE;  
					break;  
			}  
			echo $resultStr;  
		}else {  
			echo "";  
			exit;  
		}
	}
	
	private function receiveEvent($object) {
		$wx_id = (array)$object->ToUserName;
		switch ($object->Event)  
		{  
			case "subscribe":
				$gift_type = MY_Gift_Num::get_gift_type($wx_id[0], 'subscribe');
				$welcome_msg = MY_Prompt_Msg::get_msg($gift_type['game_name'],'subscribe_msg');
				break;
		}  
		$resultStr = $this->transmitText($object, $welcome_msg);
		return $resultStr;  
	}
	
	public function receiveText($object) {
		$fromUsername = $object->FromUserName;
		$toUsername = $object->ToUserName;
		$keyword = trim($object->Content);
		$wx_id = (array)$object->ToUserName;
		$time = time();
		$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";             
		if($keyword == "关注礼包") {
			$msgType = "text";
			$contentStr = $this->get_gift_content($wx_id[0], $fromUsername, 'subscribe');
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}elseif($keyword == "阅兵至尊礼包") {
			$msgType = "text";
			$contentStr = $this->get_gift_content($wx_id[0], $fromUsername, 'holiday', 'parade_gift');
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}elseif($keyword == "国庆神秘礼包") {
			$msgType = "text";
			$contentStr = $this->get_gift_content($wx_id[0], $fromUsername, 'holiday', 'national_day_gift');
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}
	}
	
	public function get_gift_content($wx_id, $fromUsername, $type, $sub_type='') {
		$gift_type = MY_Gift_Num::get_gift_type($wx_id, $type);
		if($gift_type['type'] == 1) {
			$gift_sub_type = $gift_type['sub_type'];
		}elseif($gift_type['type'] == 3) {
			$gift_sub_type = $gift_type['sub_type'][$sub_type];
		}
		$gift_text_msg = MY_Prompt_Msg::get_msg($gift_type['game_name'],'gift_text_msg');
		$is_exist_gift = $this->check_gift_num($gift_type['game_name'], $gift_type['gift_prefix'], $fromUsername, $gift_type['type'], $gift_sub_type);
		if(empty($is_exist_gift)) {
			$gift_num = $this->subscribe_gift_num($gift_type['game_name'], $gift_type['gift_prefix'], $gift_type['type'], $gift_sub_type, $fromUsername);
			$contentStr = $gift_text_msg['pre_msg1'].$gift_num.$gift_text_msg['end_msg'];
		}else{
			$contentStr = $gift_text_msg['pre_msg2'].$is_exist_gift.$gift_text_msg['end_msg'];
		}
		return $contentStr;
	}
	
	private function transmitText($object, $content) {
		if (!isset($content) || empty($content))
			return "";
		
		$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";
		$result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
		return $result;
	}
	
	private function checkSignature() {
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];	
		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	private function subscribe_gift_num($game_name, $gift_prefix, $type, $sub_type, $open_id) {
		// 产生1~5位随机数
		$random_part = self::create_random_part();
		$gift_arr = array('random_part'=>$random_part,'type'=>$type,'sub_type'=>$sub_type,'open_id'=>"$open_id");
		$ret_gift = $this->Model_gifts->create_gift_num($game_name, $gift_arr);
		$base62_id = Base62::encode($ret_gift['id']);
		$base62_random_part = Base62::encode($ret_gift['random_part']);
		$gift_num = $gift_prefix."-".$base62_id."-".$base62_random_part."-".$ret_gift['type']."-".$ret_gift['sub_type'];
		return $gift_num;
	}
	
	private function check_gift_num($game_name, $gift_prefix, $open_id, $gift_type, $gift_sub_type) {
		$gift_num = '';
		$ret_gift = $this->Model_gifts->check_gift_num_by_open_id($game_name, $open_id, $gift_type, $gift_sub_type);
		if(!empty($ret_gift)) {
			$base62_id = Base62::encode($ret_gift[0]['id']);
			$base62_random_part = Base62::encode($ret_gift[0]['random_part']);
			$gift_num = $gift_prefix."-".$base62_id."-".$base62_random_part."-".$ret_gift[0]['type']."-".$ret_gift[0]['sub_type'];
		}
		return $gift_num;
	}
	
	public function create_random_part() {
		$random_part = mt_rand(0, 65536);
		return $random_part;
	}
}