<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $layout = 'layout/classic';
	protected $layout_data = array(
		'title' => 'weixin-mp',
	);
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('common');
		$this->load->helper('base_common');
	}
	
	protected function render($file, $view_data = array(), $layout_data = array()) {
//		$this->load->add_package_path(APPPATH.'third_party/rjweb/', FALSE);
//		$this->load->library('rj_view');
//		$this->load->library('rj_form_builder');
//		$this->load->remove_package_path(APPPATH.'third_party/rjweb/');
		
		if(!empty($file)) {
			$layout_data = empty($layout_data) ? $this->layout_data : $layout_data;
			
			$data['content'] = $this->load->view($file, $view_data, TRUE);
			$data['layout'] = $layout_data;
			$this->load->view($this->layout, $data);
		} else {
			echo "file empty";
		}
	}
}
