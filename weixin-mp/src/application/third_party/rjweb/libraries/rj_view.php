<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RJ_View {
	public function __construct() {	
	}
	
	public function load_view($view_file, $params) {
		$ci = &get_instance();
		$ci->load->add_package_path(APPPATH.'third_party/rjweb/', FALSE);
		$view = $ci->load->view($view_file, $params, TRUE);
		$ci->load->remove_package_path(APPPATH.'third_party/rjweb/');
		return $view;
	}

	public function load_table_view($item_descs, $items) {
		return $this->load_view('include/widget/_table', array('item_descs'=>$item_descs, 'items'=>$items));
	}
	
	public function load_sidebar_view($menus) {
		return $this->load_view('include/widget/_sidebar', array('menus'=>$menus));
	}
}