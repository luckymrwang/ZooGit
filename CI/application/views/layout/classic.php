<?php $this->load->view('include/_header'); ?>

<div class="main-container-inner">
	<?php $this->load->view("include/sidebar/{$layout['sidebar_file']}");?>

	<div class="main-content">
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try { ace.settings.check('breadcrumbs', 'fixed'); } catch(e) {}
			</script>

			<ul class="breadcrumb">
				<li>
					<i class="icon-home home-icon"></i>
				</li>
				<li class="active" id="breadcrumb_menu1"></li>
				<li class="active" id="breadcrumb_menu2"></li>
			</ul>
		</div>
		
		<script type="text/javascript">
			var menu1 = $(".sidebar .nav .active .menu-text").text();
			var menu2 = $(".sidebar .nav .active .submenu .active > a").text();
			$("#breadcrumb_menu1").text(menu1);
			$("#breadcrumb_menu2").text(menu2);
		</script>
		
		<div class="page-content">
			<?php echo $content; ?>
		</div>
	</div>
</div>



<?php $this->load->view('include/_footer'); ?>

