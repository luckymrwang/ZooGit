<?php

//奖品配置信息
$config['prize_infos'] = array(
	'tank' => array(),
	
	'hot_blood_tank' =>	array(
		1 => array(
			'area' => '27~50000',
			'type' => '1',
			'total_cnt' => 50000,
			'url' => '',
			'desc' => '开炮吧坦克豪华礼包',
		),
	
		2 => array(
			'area' => '0~1',
			'type' => '2',
			'total_cnt' => 2,
			'url' => 'http://localhost/weixin-mp-game/src/assets/images/img_11.jpg',
			'desc' => '纯金属坦克模型',
		),
	
		3 => array(
			'area' => '2~6',
			'type' => '3',
			'total_cnt' => 5,
			'url' => 'http://localhost/weixin-mp-game/src/assets/images/img_11.jpg',
			'desc' => '小米移动电源',
		),
	
		4 => array(
			'area' => '7~26',
			'type' => '4',
			'total_cnt' => 20,
			'url' => 'http://localhost/weixin-mp-game/src/assets/images/img_11.jpg',
			'desc' => '50元手机充值卡',
		)
	)
);

//
$config['random_tel_prefix'] = array(
		'131',
		'132',
		'133',
		'135',
		'136',
		'137',
		'138',
		'139',
		
		'150',
		'151',
		'152',
		'153',
		'155',
		'156',
	
		'186',
		'188',
		'189',
);

$config['random_tel_suffix'] = array(
		'刮奖获得小米移动电源一个',
		'刮奖获得坦克模型一个',
		'刮奖获得50元充值卡一张',
		'刮奖获得小米移动电源一个',
		'刮奖获得50元充值卡一张',
		'刮奖获得50元充值卡一张',
);

