<?php
	$menus = array(
		array(
			'desc' => '测试',
			'active_pattern' => '/start/i',
			'level2_menus' => array(
				array(
					'desc' => '欢迎',
					'url' => 'start/welcome',
					'active_pattern' => '/start\/welcome/i',
				),
			),
		),
	);
	
	echo $this->rj_view->load_sidebar_view($menus);
?>