<?php $ci = &get_instance(); ?>
<!-- menu-toggler在手机这种小屏设备时显示一个Menu小按钮取代sidebar，节省屏幕空间-->
<a class="menu-toggler" id="menu-toggler" href="#">
		<span class="menu-text"></span>
</a>

<div class="sidebar" id="sidebar">
	<script type="text/javascript">
		try { ace.settings.check('sidebar', 'fixed'); } catch(e) {}
	</script>

	<ul class="nav nav-list">
		<?php foreach($menus as $menu): ?>
		<li <?php if(preg_match($menu['active_pattern'], $ci->uri->uri_string())) echo 'class="active open"'; ?>>
			<a href="#" class="dropdown-toggle">
				<i class="icon-dashboard"></i>
				<span class="menu-text"><?php echo $menu['desc']; ?></span>
				<b class="arrow icon-angle-down"></b>
    		</a>
    		<ul class="submenu">
				<?php foreach($menu['level2_menus'] as $level2_menu): ?>
				<li <?php if(preg_match($level2_menu['active_pattern'], $ci->uri->uri_string())) echo 'class="active"'; ?>>
					<a href="<?php echo base_url($level2_menu['url']); ?>">
						<i class="icon-double-angle-right"></i><?php echo $level2_menu['desc']; ?>
					</a>
				</li>
				<?php endforeach; ?>
    		</ul>
    	</li>
		<?php endforeach; ?>

	</ul><!-- /.nav-list -->
	
	<div class="sidebar-collapse" id="sidebar-collapse">
		<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
	</div>

	<script type="text/javascript">
		try { ace.settings.check('sidebar', 'collapsed'); } catch(e) {}
	</script>
</div>
