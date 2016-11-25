<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description;?>" />
    <meta name="keywords" content="<?php echo $keywords;?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/hot_blood_tank/css/download.css">
    <script type="text/javascript">
        if (/Android (\d+\.\d+)/.test(navigator.userAgent)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                var phoneScale = parseInt(window.screen.width) / 640;
                document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
            } else {
                document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
            }
        } else {
            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
        }

        /* Mobile */
        var isMobile = {
            Android: function () {
                return navigator.userAgent.match(/Android/i) ? true : false;
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
            }
        };
    </script>
</head>

<body>
<section id="wrap" name="wrap">
    <section class="page page2 z-current">
        <section class="box">
        	<section class="reg-logo"></section>
        	<section class="reg-cont">
            	<h2>个人信息</h2>
                <form action="<?php echo base_url();?>gift/save_register_info" method="post">
                <section class="list">
                	<li>手机：<input name="mobile" value="" id="mobile" type="text" maxlength="11" class="mobile" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" ><font color="#ff0000">（必填）</font></li>
                	<li>生日：<input name="year" value="" type="text" maxlength="4" class="year" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" >年<input name="month" value="" type="text" maxlength="2" class="month" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" >月<input name="day" value="" type="text" maxlength="2" class="day" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" >日</li>
                	<li>QQ号：<input name="qq" value="" id="qq" type="text" maxlength="11" class="qq" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" ><font color="#ff0000">（必填）</font></li>
                	<li>性别：<input name="sex" type="radio" value="">男<input name="sex" type="radio" value="">女</li>
					<input name="weixin_id" value="<?php echo $weixin_id?>" type="hidden" >
					<input name="sign" value="<?php echo $sign?>" type="hidden" >
					<input name="random_data" value="<?php echo $random_data?>" type="hidden" >
                </section>
                <h3><img src="<?php echo base_url();?>assets/hot_blood_tank/images/3131.png" alt=""></h3>
                <section class="icon">
                	<li><img src="<?php echo base_url();?>assets/hot_blood_tank/images/icon-1.png" alt=""><h2>原油桶*2</h2></li>
                    <li><img src="<?php echo base_url();?>assets/hot_blood_tank/images/icon-2.png" alt=""><h2>中级宝箱*10</h2></li>
                    <li><img src="<?php echo base_url();?>assets/hot_blood_tank/images/icon-3.png" alt=""><h2>中级钥匙*10</h2></li>
                    <li><img src="<?php echo base_url();?>assets/hot_blood_tank/images/icon-4.png" alt=""><h2>虎式坦克图纸*1</h2></li>
                </section>
                <section class="submit"><input name="submit" type="image" src="<?php echo base_url();?>assets/hot_blood_tank/images/submit.gif" id="submit" onClick="return checkform();"></section>
                </form>
            </section>
        </section>
    </section>
</section>
<script type="text/javascript">
function checkform(){
	var target = document.getElementById("mobile");
	var cont = target.value;
	var len = cont.length;
	if ( len >0 && len < 11 )	{
		alert("请填写正确的11位手机号！");
		return false;
	} else if ( len == 0){
		alert("手机号不能为空！");
		return false;
		}
	var target2 = document.getElementById("qq");
	var cont2 = target2.value;
	var len2 = cont2.length;
	if ( len2 == 0 )	{
		alert( "QQ号不能为空！" );
		return false;
	}
	
}
<?php if (!empty($msg)) echo "alert('$msg');";?>
</script>
</body>
</html>
