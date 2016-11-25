<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $layout['title']; ?></title>
    
    <!-- basic styles -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    
    <!--[if IE 7]>
    	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    
    
    <!-- page specific plugin styles -->
    
    <!-- ace styles -->
    <link href="<?php echo base_url(); ?>assets/css/ace.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ace-skins.min.css" rel="stylesheet">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-ie.min.css" />
    <![endif]-->
        
    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->

	<!-- Load JavaScript
	================================================== -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-2.0.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/typeahead-bs2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.easy-pie-chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>


	<!-- ace scripts -->

	<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
       
        
</head>

<body class="skin">
    <div class="navbar navbar-default" id="navbar">
		<script type="text/javascript">
			try { ace.settings.check('navbar', 'fixed'); } catch(e) {}
		</script>

		<div class="navbar-container" id="navbar-container">
			<div class="navbar-header pull-left">
				<a href="<?php echo site_url("start"); ?>" class="navbar-brand">
					<small>
						<i class="icon-cogs"></i>
						RSDK-base-server
					</small>
				</a><!-- /.brand -->
			</div><!-- /.navbar-header -->


			<?php $user_name = 'guy'; ?>
			<div class="navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<span class="user-info">
								<small>Welcome:<?php echo $user_name; ?></small>
							</span>

							<i class="icon-caret-down"></i>
						</a>

						<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="<?php echo site_url("auth/index"); ?>">
									<i class="icon-cog"></i>
									Settings
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a href="<?php echo site_url("auth/logout"); ?>">
									<i class="icon-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>


				</ul><!-- /.ace-nav -->
			</div><!-- /.navbar-header -->
		</div><!-- /.container -->
	</div>
    		
            
            
<div class="main-container" id="main-container">

<script type="text/javascript">
	try { ace.settings.check('main-container', 'fixed'); } catch(e) {}
</script>
