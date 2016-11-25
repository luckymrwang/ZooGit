﻿<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width" name="viewport" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<script src="<?php echo base_url(); ?>assets/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery.dialog.js"></script>
	<link href="<?php echo base_url(); ?>assets/dialog.css" rel="stylesheet" />
	<script type="text/javascript">
		$(function() {
			$("#open-btn").bind({
				"touchstart":function() {
					$("#test-dialog").dialog({
						title:"hello",
						width:800,
						height:800
					});
				}
			})
			$("#close-btn").bind({
				"touchstart":function() {					
					$("#test-dialog").dialog({
						close:true
					});
				}
			})

			var html = "";
			for (var i = 0; i < 50; i++) {
				html += i + "<br>";
			}
			html += "100";
			$("#test-dialog").append(html);
		})
	</script>
</head>
<body>

	<br><br><br><br>
	<input id="open-btn" type="button" value='open' />

	<div id="test-dialog" style="display:none">
		弹出出窗口<br/>
		<input id="close-btn" type="button" value='close' />
	</div>
</body>
</html>