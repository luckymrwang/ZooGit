<?php

// 不同游戏微信公众号原始ID:game_name:游戏名，tpl_id：短信格式模板id
$config['game_wx_id'] = array(
	'gh_a9d0d0c044fd' => array('game_name'=>'tank','tpl_id'=>'824965'),
	'gh_a8b2713ecffa' => array('game_name'=>'tank','tpl_id'=>'824965'),//个人
	'gh_d7c4d840c6d8' => array('game_name'=>'hot_blood_tank','tpl_id'=>'870437'),
);

// 不同游戏生成礼包时约定的礼包前缀
$config['gift_prefix'] = array(
	'tank' => 'TKWX',
	'hot_blood_tank' => 'HBTWX',
);

// 不同游戏查询礼包内容时约定的密钥
$config['app_sercert'] = array(
	'tank' => 'U2FsdGVkX1+Rga86/4PksSw3yQe8iccx5UYfd/5rA4TbGupAAGpJnjO/pQEYYOos',
	'hot_blood_tank' => 'U2FsdGVkX19ymLs/AlR2GG+pjuctkruancKdvbb0rvCvp7GPpjZDfivKO7aWi2by',
);

// 不同游戏关注时的欢迎文案
$config['subscribe_msg'] = array(
	'tank' => '尊敬的指挥官，感谢您关注坦克风云官方微信！我们将第一时间给您提供最新的游戏资讯和各种活动信息哦。为了回馈微信用户，特此奉上微信大礼包，回复"关注礼包"即可领取！',
	'hot_blood_tank' => '尊敬的指挥官，感谢您关注开炮吧坦克官方微信！我们将第一时间给您提供最新的游戏资讯和各种活动信息哦。为了回馈微信用户，特此奉上微信大礼包，回复"关注礼包"即可领取！',
);

// 不同游戏获取关注礼包时文案
$config['gift_text_msg'] = array(
	'tank' => array('pre_msg1'=>'您的礼包码是：','pre_msg2'=>'您已经领取过微信礼包啦，您的礼包码是：','end_msg'=>'，礼包领取方式：登陆游戏，打开"兑换"，输入礼包码即可领取大礼包。'),
	'hot_blood_tank' => array('pre_msg1'=>'您的礼包码是：','pre_msg2'=>'您已经领取过微信礼包啦，您的礼包码是：','end_msg'=>'，礼包领取方式：登陆游戏，打开"兑换"，输入礼包码即可领取大礼包。'),
);

// 游戏礼包分类
$config['gift_type'] = array(
	1=>array('sub_type'=>'0'), // 关注
	2=>array('sub_type'=>'0'), // 注册
	3=>array('sub_type'=>array( // 节假日
		'parade_gift'=>'1',		// 阅兵至尊礼包
		'national_day_gift'=>'2',		// 国庆神秘礼包
	)),
);

