<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class MY_Gift {
	public function get_config_item($item,$file=null) {
		if($file==null) {
			return false;
		}
		
		$config = self::get_file_config($file);
		if ( ! isset($config[$item])) {
			return FALSE;
		}
		$config_item[$item] = $config[$item];
		
		return $config_item[$item];
	}
	
	public function get_file_config($file) {
		if ( ! isset($main_conf)) {
			if ( ! file_exists(APPPATH.'config/'.$file.EXT)) {
				exit('The configuration file config'.EXT.' does not exist.');
			}

			require(APPPATH.'config/'.$file.EXT);

			if ( ! isset($config) OR ! is_array($config)) {
				exit('Your config file does not appear to be formatted correctly.');
			}

			$main_conf[0] =& $config;
		}
		return $main_conf[0];
	}
	public function get_weixin_id_by_game_name($game_name){
		$item = MY_Gift::get_config_item('game_wx_id', 'gift_mark_config');
		foreach ($item as $k =>$v){
			foreach ($v as $value){
				if($value == $game_name){
					$weixin_id = $k;
				}
			}
		}
		return $weixin_id;
	}
}

class MY_Sign {
	public static function get_sign($game_name, $params) {
		$sercert = MY_Gift::get_config_item('app_sercert', 'gift_mark_config');
		if(!array_key_exists($game_name, $sercert)) {
			$err_msg = 'app_sercert not config';
			return $err_msg;
		}
		$app_sercert = $sercert[$game_name];
		
        ksort($params);
        $str = '';
        foreach($params as $key => $param){
            if($str){
                $str .= $key."=".$param;
            }else{
                $str = $key."=".$param;
            }
        }
        $str .= $app_sercert;
        $sign = md5($str);
		
		return $sign;
	}
	
	public function check_sign($game_name, $params){
		$sercert = MY_Gift::get_config_item('app_sercert', 'gift_mark_config');
		if(!array_key_exists($game_name, $sercert)) {
			$err_msg = 'app_sercert not config';
			return $err_msg;
		}
		$app_sercert = $sercert[$game_name];
		
        $sign = $params['sign'];
        
        unset($params['sign']);
        ksort($params); 
		$str = '';
		
        foreach($params as $key => $param){
             if($str){
                  $str .= $key."=".$param;
             }else{
                  $str = $key."=".$param;
             }
        }

        $str .= $app_sercert;
        $mySign = md5($str);
        if($sign != $mySign)
            return FALSE;
        
        return TRUE;
    }
}

class MY_Prompt_Msg {
	public function get_msg($game_name,$msg_type) {
		$text_msgs = MY_Gift::get_config_item($msg_type, 'gift_mark_config');
		$text_msg = $text_msgs[$game_name];
		return $text_msg;
	}
}

class MY_Gift_Num {
	public function get_gift_type($wx_id, $type) {
		$gift_type_arr = array();
		$game_names = MY_Gift::get_config_item('game_wx_id', 'gift_mark_config');
		if(!isset($game_names[$wx_id])) {
			echo "game_wx_id is not config";
			exit;
		}
		$game_name = $game_names[$wx_id]['game_name'];
		
		$game_prefix = MY_Gift::get_config_item('gift_prefix', 'gift_mark_config');
		if(!isset($game_prefix[$game_name])) {
			echo "gift_prefix is not config";
			exit;
		}
		$gift_prefix = $game_prefix[$game_name];
		
		if($type == 'subscribe') {
			$gift_type = MY_Gift::get_config_item('gift_type', 'gift_mark_config');
			$type = 1;
			$sub_type = $gift_type[$type]['sub_type'];
		}elseif($type == 'register') {
			$gift_type = MY_Gift::get_config_item('gift_type', 'gift_mark_config');
			$type = 2;
			$sub_type = $gift_type[$type]['sub_type'];
		}elseif($type == 'holiday') {
			$gift_type = MY_Gift::get_config_item('gift_type', 'gift_mark_config');
			$type = 3;
			$sub_type = $gift_type[$type]['sub_type'];
		}
		
		$gift_type_arr = array('game_name'=>$game_name,'gift_prefix'=>$gift_prefix,'type'=>$type,'sub_type'=>$sub_type);
		return $gift_type_arr;
	}
}

class MY_Api{
	public static function mobile_message_send($package_number, $mobile_number, $tpl_id){
		
		$tpl_value = '#code#='.$package_number;
		$apikey = '3746857a9b5a4b78514f9ecea44e28aa';
		$url="http://yunpian.com/v1/sms/tpl_send.json";
		$encoded_tpl_value = urlencode("$tpl_value");  //tpl_value需整体转义
		$post_string="apikey=$apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile_number";
		return sock_post($url, $post_string);
		
	}
}
function sock_post($url,$query){
	$data = "";
	$info=parse_url($url);
	$fp=fsockopen($info["host"],80,$errno,$errstr,30);
	if(!$fp){
		return $data;
	}
	$head="POST ".$info['path']." HTTP/1.0\r\n";
	$head.="Host: ".$info['host']."\r\n";
	$head.="Referer: http://".$info['host'].$info['path']."\r\n";
	$head.="Content-type: application/x-www-form-urlencoded\r\n";
	$head.="Content-Length: ".strlen(trim($query))."\r\n";
	$head.="\r\n";
	$head.=trim($query);
	$write=fputs($fp,$head);
	$header = "";
	while ($str = trim(fgets($fp,4096))) {
		$header.=$str;
	}
	while (!feof($fp)) {
		$data .= fgets($fp,4096);
	}
	return $data;
}

