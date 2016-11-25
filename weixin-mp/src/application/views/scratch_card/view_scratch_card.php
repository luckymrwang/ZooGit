<!DOCTYPE html>
<!-- saved from url=(0034)http://sq.0708.com/t2/90/1559.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=640;target-densitydpi=device-dpi; minimum-scale=0.5; maximum-scale=2,user-scalable=yes">
<title></title>
<link href="<?php echo base_url(); ?>assets/card/m_index.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/card/sweetalert.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/card/style.css" type="text/css" rel="stylesheet">
</head>

<body>
	<!-- <div class="cent">
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
		<div id="Wrap">
			<span class="show-icon" onclick="$(&#39;.rule&#39;).show();$(&#39;.show-icon&#39;).hide();"><img src="<?php echo base_url(); ?>assets/card/show_icon.png"></span>
			<!--<div class="btn_rule"></div>-->
			<div class="cont">
				<!--刮一刮-->
				<div class="pic">
					<img class="pic_n" src="<?php echo base_url(); ?>assets/card/img_6.jpg">
					<div class="pic_s"><img src="<?php echo base_url(); ?>assets/card/img_6.jpg"></div>
				</div>
				<div class="prize">
					<li id="lipin0"><img src="<?php echo base_url(); ?>assets/card/lipin1.png"></li>
					<li id="lipin3"><img src="<?php echo base_url(); ?>assets/card/lipin2.png"></li>
					<li id="lipin4"><img src="<?php echo base_url(); ?>assets/card/lipin3.png"></li>
					<li id="lipin2"><img src="<?php echo base_url(); ?>assets/card/lipin4.png"></li>
					<li id="lipin1" style="display: none;"><img src="<?php echo base_url(); ?>assets/card/lipin5.png"></li>
				</div>
				<div class="award-winner">
					<ul id="rolltxt">
						<?php foreach($random_tels as $val){
							echo "<li>$val</li>";
						}?>
					</ul>
				</div>
				<div class="gz">
					<a href="javascript:void(0)" class="friend"></a>
					<a class="now" href="<?php echo base_url() . "scratch_card/scan_my_all_gifts"; ?>"></a>
				</div>
				<div class="ggk_wz">
					<span>每天有两次机会，分享好友获得更多机会！</span>
					<h2>剩余<i id="remain_cnt"><?php echo $remaining_cnt; ?></i>次机会<a style="cursor: pointer;" class="c_btn"><img src="<?php echo base_url(); ?>assets/card/img_33.jpg"></a></h2>
				</div>
			</div>
			<div class="down">
				<script>
						var ua = navigator.userAgent.toLowerCase();  
						if(ua.match(/MicroMessenger/i)=="micromessenger") {  
							document.write('<a href="javascript:void(0)" class="fenxiang"></a>');
						} else {  
							document.write('<a href="http://dl.m.duoku.com/service/cloudapk_sign_online/7555/7555_1439369401_BaiduApp_signed.apk"></a>'); 
						}
				</script></div>
			<div class="minibg" style="position:fixed; width:100%; height:100%; display:none; z-index: 101;"><img src="<?php echo base_url()?>assets/card/minibg.jpg" width="100%" height="100%" /></div>
			<div class="weixin" style="position:fixed; width:100%; height:100%; display:none; z-index: 101;"><a class="close-weixin" href="javascript:void(0);" title="关闭"><img src="<?php echo base_url()?>assets/card/weixin.jpg" width="100%" height="100%" /></a></div>
		</div>
		<div id="screen" style="display:none"></div>
		<div class="menban" style="display:none"><a class="close-btn" href="javascript:void(0);" title="关闭"><img src="<?php echo base_url()?>assets/card/img_20.png" width="100%" height="100%" /></a></div>
		<input type="hidden" id="tag" value="0"/>
	</div> -->
	
	<div class="lbox_close wxapi_form">
      <h3 id="menu-basic">基础接口</h3>
      <span class="desc">判断当前客户端是否支持指定JS接口</span>
      <button class="btn btn_primary" id="checkJsApi">checkJsApi</button>

      <h3 id="menu-share">分享接口</h3>
      <span class="desc">获取“分享到朋友圈”按钮点击状态及自定义分享内容接口</span>
      <button class="btn btn_primary" id="onMenuShareTimeline">onMenuShareTimeline</button>
      <span class="desc">获取“分享给朋友”按钮点击状态及自定义分享内容接口</span>
      <button class="btn btn_primary" id="onMenuShareAppMessage">onMenuShareAppMessage</button>
      <span class="desc">获取“分享到QQ”按钮点击状态及自定义分享内容接口</span>
      <button class="btn btn_primary" id="onMenuShareQQ">onMenuShareQQ</button>
      <span class="desc">获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口</span>
      <button class="btn btn_primary" id="onMenuShareWeibo">onMenuShareWeibo</button>
      <span class="desc">获取“分享到QZone”按钮点击状态及自定义分享内容接口</span>
      <button class="btn btn_primary" id="onMenuShareQZone">onMenuShareQZone</button>

      <h3 id="menu-image">图像接口</h3>
      <span class="desc">拍照或从手机相册中选图接口</span>
      <button class="btn btn_primary" id="chooseImage">chooseImage</button>
      <span class="desc">预览图片接口</span>
      <button class="btn btn_primary" id="previewImage">previewImage</button>
      <span class="desc">上传图片接口</span>
      <button class="btn btn_primary" id="uploadImage">uploadImage</button>
      <span class="desc">下载图片接口</span>
      <button class="btn btn_primary" id="downloadImage">downloadImage</button>

      <h3 id="menu-voice">音频接口</h3>
      <span class="desc">开始录音接口</span>
      <button class="btn btn_primary" id="startRecord">startRecord</button>
      <span class="desc">停止录音接口</span>
      <button class="btn btn_primary" id="stopRecord">stopRecord</button>
      <span class="desc">播放语音接口</span>
      <button class="btn btn_primary" id="playVoice">playVoice</button>
      <span class="desc">暂停播放接口</span>
      <button class="btn btn_primary" id="pauseVoice">pauseVoice</button>
      <span class="desc">停止播放接口</span>
      <button class="btn btn_primary" id="stopVoice">stopVoice</button>
      <span class="desc">上传语音接口</span>
      <button class="btn btn_primary" id="uploadVoice">uploadVoice</button>
      <span class="desc">下载语音接口</span>
      <button class="btn btn_primary" id="downloadVoice">downloadVoice</button>

      <h3 id="menu-smart">智能接口</h3>
      <span class="desc">识别音频并返回识别结果接口</span>
      <button class="btn btn_primary" id="translateVoice">translateVoice</button>

      <h3 id="menu-device">设备信息接口</h3>
      <span class="desc">获取网络状态接口</span>
      <button class="btn btn_primary" id="getNetworkType">getNetworkType</button>

      <h3 id="menu-location">地理位置接口</h3>
      <span class="desc">使用微信内置地图查看位置接口</span>
      <button class="btn btn_primary" id="openLocation">openLocation</button>
      <span class="desc">获取地理位置接口</span>
      <button class="btn btn_primary" id="getLocation">getLocation</button>

      <h3 id="menu-webview">界面操作接口</h3>
      <span class="desc">隐藏右上角菜单接口</span>
      <button class="btn btn_primary" id="hideOptionMenu">hideOptionMenu</button>
      <span class="desc">显示右上角菜单接口</span>
      <button class="btn btn_primary" id="showOptionMenu">showOptionMenu</button>
      <span class="desc">关闭当前网页窗口接口</span>
      <button class="btn btn_primary" id="closeWindow">closeWindow</button>
      <span class="desc">批量隐藏功能按钮接口</span>
      <button class="btn btn_primary" id="hideMenuItems">hideMenuItems</button>
      <span class="desc">批量显示功能按钮接口</span>
      <button class="btn btn_primary" id="showMenuItems">showMenuItems</button>
      <span class="desc">隐藏所有非基础按钮接口</span>
      <button class="btn btn_primary" id="hideAllNonBaseMenuItem">hideAllNonBaseMenuItem</button>
      <span class="desc">显示所有功能按钮接口</span>
      <button class="btn btn_primary" id="showAllNonBaseMenuItem">showAllNonBaseMenuItem</button>

      <h3 id="menu-scan">微信扫一扫</h3>
      <span class="desc">调起微信扫一扫接口</span>
      <button class="btn btn_primary" id="scanQRCode0">scanQRCode(微信处理结果)</button>
      <button class="btn btn_primary" id="scanQRCode1">scanQRCode(直接返回结果)</button>

      <h3 id="menu-shopping">微信小店接口</h3>
      <span class="desc">跳转微信商品页接口</span>
      <button class="btn btn_primary" id="openProductSpecificView">openProductSpecificView</button>

      <h3 id="menu-card">微信卡券接口</h3>
      <span class="desc">批量添加卡券接口</span>
      <button class="btn btn_primary" id="addCard">addCard</button>
      <span class="desc">调起适用于门店的卡券列表并获取用户选择列表</span>
      <button class="btn btn_primary" id="chooseCard">chooseCard</button>
      <span class="desc">查看微信卡包中的卡券接口</span>
      <button class="btn btn_primary" id="openCard">openCard</button>

      <h3 id="menu-pay">微信支付接口</h3>
      <span class="desc">发起一个微信支付请求</span>
      <button class="btn btn_primary" id="chooseWXPay">chooseWXPay</button>
    </div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/jquery.eraser.opv1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/touch.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
 $(function(){
	swal("刮奖活动已结束，欢迎下次再来");
	$(".c_btn").hide();
	$(".information").hide();
	$('.close-btn').click(function(){
		$('.menban').fadeOut(function(){ $('#screen').hide(); });	
		$.ajax({url: "<?php echo site_url('scratch_card/get_more_scratch_cnt'); ?>",async:false,success:function(result){
      			if(result != ''){
      				swal(result);
      			}
    		}
    	});
		
		setTimeout('location.reload()',10000);
		return false;
	});
	$('.friend').click(function(){
		var h = $(document).height();
		$('#screen').css({ 'height': h });	
		$('.menban').show();
		$('#screen').center();
		$('.menban').fadeIn();
		return false;
	});
	
	$('.fenxiang').click(function(){
		var h = $(document).height();
		$('#screen').css({ 'height': h });	
		$('.weixin').show();
		$('#screen').center();
		$('.weixin').fadeIn();
		return false;
	});
	
	$('.close-weixin').click(function(){
		$('.weixin').fadeOut(function(){ $('#screen').hide(); });
		return false;
	});
	
	addEventListener( "load", init, false );
	function init( event ) {
		$(".pic_n").eraser({
			completeRatio: .01,
			completeFunction: ajax_get_infos,
		});
	}

	function ajax_get_infos(){
		$.ajax({url: "<?php echo site_url('scratch_card/ajax_get_scratch_gift'); ?>",async:false,success:function(result){
				var infos = $.parseJSON(result);
				switch (infos.tag){
					case 0:
						if(infos.gift_info.type == 1){
							var put=$("<div class='pic_i'>"+$("#lipin"+infos.gift_info.type+"").html()+"<p>恭喜你获得</p><h2>开炮吧坦克豪华礼包</h2></div>");
						} else {
							var put=$("<div class='pic_i'>"+$("#lipin"+infos.gift_info.type+"").html()+"<p>恭喜你获得</p><h2>"+infos.gift_info.gift_num+"</h2></div>");
							$("#tag").val('1');
						}
						$(".pic_s").html(put);
						
						if(infos.remain_cnt > 1){
							$(".c_btn").show();
						}
						$("#remain_cnt").html(infos.remain_cnt - 1);
						break;
					case 1: 
						swal("分享获得更多刮奖机会!");
						break;
					case 2:
						swal("啊哦，今天没有机会刮奖了，欢迎明天再来");
						break;
					case 3:
						swal("刮奖活动已结束，欢迎下次再来");
						break;
				}
			}
		});
	}
	
	function remove(event) {
		$(".pic_n").eraser('clear');
		event.preventDefault();
	}
	
	$(".c_btn").on("click",function(){
		window.location.reload();
	});
	
	$(".closed").on("click",function(){
		$(".information").hide();
	});
	
	touch.on('.pic', 'touchstart touchmove touchend', function(ev){
		var progress = $('.pic_n').eraser('progress');
		var tag = $("#tag").val();
		if(progress > 0.35 && tag == 1){
			setTimeout(input_number(),3000);
		}
	});
	
	function input_number(){
		swal({   
				title: "恭喜您中奖啦",
				text: "请填写您的手机号，并保持手机通畅，我们的工作人员会与您联系，并发放您的实物奖励！",   
				type: "input",   
				showCancelButton: true,   
				closeOnConfirm: false,   
				animation: "slide-from-top",   
				inputPlaceholder: "手机号" 
			},
			function(inputValue){   
				if (inputValue === false) return false;      
				if (inputValue === "") {     
					swal.showInputError("手机号不能为空");     
					return false;
				}
				if (!$.isNumeric(inputValue)) {
					swal.showInputError("请填写正确的11位手机号");     
					return false;
				}
				if ( inputValue.length != 11 )	{
					swal.showInputError("请填写正确的11位手机号");
					return false;
				}
				
				ajax_push_user_tel(inputValue);
				swal("提交成功", "手机号是: " + inputValue, "success"); 
			});
	}
	
	function ajax_push_user_tel(inputValue){
		var url = "<?php echo site_url('scratch_card/ajax_update_user_tel'); ?>";
		$.post(url,{
			"tel":inputValue,
		},
		function(data,status){});
	}
});
$(".btn_rule").click(function(){$(".btn_rule,.rule").toggleClass("alt");if($(".rule").hasClass("alt")){$.post("");}});
</script>
<script type="text/javascript">  
function extractNodes(pNode){ 
    if(pNode.nodeType == 3)return null; 
    var node,nodes = new Array(); 
    for(var i=0;node= pNode.childNodes[i];i++){ 
        if(node.nodeType == 1)nodes.push(node); 
    } 
    return nodes; 
} 
var obj=document.getElementById("rolltxt"); 
for(i=0;i<4;i++){ 
    obj.appendChild(extractNodes(obj)[i].cloneNode(true)); 
} 
settime=0; 
var t=setInterval(rolltxt,50); 
function rolltxt(){ 
    if(obj.scrollTop % (obj.clientHeight-5) ==0){ 
        settime+=1; 
        if(settime==50){ 
            obj.scrollTop+=1; 
            settime=0; 
        } 
    }else{ 
        obj.scrollTop+=1; 
        if(obj.scrollTop==(obj.scrollHeight-obj.clientHeight)){ 
            obj.scrollTop=0; 
        } 
    } 
} 
obj.onmouseover=function(){clearInterval(t)} 
obj.onmouseout=function(){t=setInterval(rolltxt,50)} 
</script>

<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
      ]
  });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/card/demo.js"></script>

</body></html>