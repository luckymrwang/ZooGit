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
<section id="wrap">
    <section class="page page1 z-current">
        <section class="box">
            <p class="page1_1"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/logo.png?4" alt=""></p>
            <p class="page1_2"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/left-1.png?4" alt=""></p>
            <p class="page1_3"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/light.png?4" alt=""></p>
            <p class="page1_4"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/right-1.png?4" alt=""></p>
            <p class="btn btnDownload show">
               <script>
                    if (isMobile.iOS()) {
                        document.write('<a href="https://itunes.apple.com/cn/app/zhan-de-tan-ke/id875915071"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/download.gif?4" alt="iOS下载"></a>');
                    } else if (isMobile.Android()) {
                        document.write('<a href="http://pan.baidu.com/s/1kT04pJD"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/download.gif?4" alt="Android下载"></a>');
                    } else {
                        document.write('<a href="/"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/download.gif?4" alt="进入官网"></a>');
                    }
                </script>
            </p>
        </section>
    </section>
</section>
<section class="tip_ios"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/tip_ios.png?4" alt=""></section>
<section class="tip_android"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/tip_android.png?4" alt=""></section>
<section class="tip_wechat"><img src="<?php echo base_url();?>assets/hot_blood_tank/images/tip_wechat.png?4" alt=""></section>
<script src="<?php echo base_url();?>assets/hot_blood_tank/images/jquery-1.10.1.min.js?4"></script>
<script>
    $.extend({
        isWeiXin: function () {
            var ua = window.navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == 'micromessenger') {
                return true;
            } else {
                return false;
            }
        },
        page1: function () {
            $(".page1_1").delay(100).animate({left: 150, top: 155, width: 349, height: 116}, 500);
            $(".page1_2").delay(500).animate({opacity: 1, left: 0, top: 585}, 300);
            $(".page1_4").delay(800).animate({opacity: 1, right: 0, top:695}, 300);
            $(".page1_3, .page1_5").delay(1200).fadeIn('fast');
            $(".page1 .btn").delay(1400).fadeIn('slow');
        }
    })

    $(function () {
        $("#wrap").find(".btn").on("mousedown touchstart", "a",function (e) {
            var src = $(this).children().attr("src").replace(/.png/, "_cur.png");
            $(this).children().attr("src", src);
        }).on("mousemove touchmove", "a",function (e) {
            var src = $(this).children().attr("src").replace(/_cur.png/, ".png");
            $(this).children().attr("src", src);
        }).on("mouseup touchend", "a", function (e) {
            var src = $(this).children().attr("src").replace(/_cur.png/, ".png");
            $(this).children().attr("src", src);
        });

        $(".btnDownload").on("click", "a", function (e) {
            if ($.isWeiXin()) {
                e.preventDefault();
                $("body").addClass("unmove");
                $(".tip_wechat").show().one("click", function () {
                    $("body").removeClass("unmove");
                    $(this).hide();
                });
                return false;
            }

            var _url = $(this).attr("href");
            if (_url != "javascript:;") {
                window.location.href = _url;
                return false;
            }
            if (isMobile.Android()) {
                e.preventDefault();
                $("body").addClass("unmove");

                $(".tip_android").show().one("click", function () {
                    $("body").removeClass("unmove");
                    $(this).hide();
                });
                return false;
            } else if (isMobile.iOS()) {
                e.preventDefault();
                $("body").addClass("unmove");
                $(".tip_ios").show().one("click", function () {
                    $("body").removeClass("unmove");
                    $(this).hide();
                });
                return false;
            }
        });
    })
    $(window).load(function () {
        $.page1();
    });
</script>
</body>
</html>