<!-- 在table-responsive下的表格为响应式表格，能在如手机的小屏设备上支持水平滚动条 -->
<div class="table-responsive">
<?php
	$adjust_items[0] = $item_descs;
	foreach($items as $item) {
		$adjust_item = array();
		foreach(array_keys($item_descs) as $key) {
			$adjust_item[$key] = $item[$key];
		}
		$adjust_items[] = $adjust_item;
	}
	$ci = &get_instance();
	$ci->load->library('table');
	$ci->table->set_template(array('table_open'=>'<table class="table table-bordered table-hover table-striped">'));
	echo $ci->table->generate($adjust_items);
?>
</div>