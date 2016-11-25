<!DOCTYPE html>
<!-- saved from url=(0034)http://sq.0708.com/t2/90/1560.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=640;target-densitydpi=device-dpi; minimum-scale=0.5; maximum-scale=2,user-scalable=yes">
<title></title>
<link href="<?php echo base_url(); ?>assets/card/m_index.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/card/sweetalert.css" type="text/css" rel="stylesheet">
<style id="style-1-cropbar-clipper">/* Copyright 2014 Evernote Corporation. All rights reserved. */
.en-markup-crop-options {
    top: 18px !important;
    left: 50% !important;
    margin-left: -100px !important;
    width: 200px !important;
    border: 2px rgba(255,255,255,.38) solid !important;
    border-radius: 4px !important;
}

.en-markup-crop-options div div:first-of-type {
    margin-left: 0px !important;
}
</style></head>

<body>
	<div class="cent">
		<div class="rule">
			<span class="hide-icon" onclick="$(&#39;.show-icon&#39;).show();$(&#39;.rule&#39;).hide();"><img src="<?php echo base_url(); ?>assets/card/hide_icon.png"></span>
			<p> 活动时间：9月18日-9月25日<br>
				活动对象：百度移动用户（多酷 91）<br>
				活动规则：<br>
				1、活动期间只要访问本页面，每天均可获得2次刮卡机会，每分享给好友或朋友圈1次即可获得额外1次刮卡机会，每天最多拥有3次分享刮卡机会；<br>
				2、即刮即中，ipadmini2、金属坦克模型、移动电源、充值卡、豪华大礼包等。<br>
				3、请获得实物奖励的用户如实填写个人信息以便我们联系您发放奖励。<br>
			</p>
		</div>
		<div id="Wrap2">
			<span class="show-icon" onclick="$(&#39;.rule&#39;).show();$(&#39;.show-icon&#39;).hide();"><img src="<?php echo base_url(); ?>assets/card/show_icon.png"></span>
			<div class="gont">
				<ul class="g_cont">
					<?php
					foreach ($items as $key => $val) {
						if (empty($val))
							continue;
						foreach ($val as $v) {
							?>
					<li><p><img src="<?php echo base_url();?>assets/card/lipin5.png" height="80px"></p><?php echo $v; ?></li>
	<?php }
} ?>
				</ul>
				<div class="gz" style=" margin-top: 50px;"><a class="collect" href="javascript:void(0)"></a><a href="<?php echo base_url() . "scratch_card/index"; ?>" class="Lottery"></a></div>
			</div>
			<!--<div class="down"><a href="#"></a></div>-->
		</div>
		<div class="tip_cont" style="display:none;">
			<div class="tit"><h2><img src="<?php echo base_url(); ?>assets/card/img_21.png"></h2><span class="close"></span></div>
			<div class="aw_1"><img src="<?php echo base_url(); ?>assets/card/img_22.png"></div>
			<p>恭喜您获得百度特别预约礼包</p>  
			<form class="register" style="display:none;">
				<input type="text" class="input" placeholder="请输入手机号" value="">
				<input name="button" type="button" class="button" value="提交">
				<div class="get_span">提示语</div>
			</form>
			<div class="know"><a href="#"></a></div>
		</div>
		<div id="screen" style="display:none"></div>
		<div class="minibg" style="position:fixed; width:100%; height:100%; display:none; z-index: 101;"><img src="<?php echo base_url()?>assets/card/minibg.jpg" width="100%" height="100%" /></div>
		<div class="menban" style="display:none"><a class="close-btn" href="javascript:void(0);" title="关闭"><img src="<?php echo base_url()?>assets/card/img_20.png" width="100%" height="100%" /></a></div>
	</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/jquery.eraser.opv1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/sweetalert.min.js"></script>
<script>
 $(function(){
	$('.collect').click(function(){
		var h = $(document).height();
		$('#screen').css({ 'height': h });	
		$('.menban').show();
		$('#screen').center();
		$('.menban').fadeIn();
		return false;
	});
	$('.close-btn').click(function(){
		$('.menban').fadeOut(function(){ $('#screen').hide(); });	
		$.ajax({url: "<?php echo site_url('scratch_card/get_more_scratch_cnt'); ?>",async:false,success:function(result){
      		if(result != ''){
      			swal(result);
      		}
    	}});		
		return false;
	});
});
</script>
</body></html>