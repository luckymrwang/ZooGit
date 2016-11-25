<style>body{text-align:center;} div br{display:inline;}</style>
<!-- 使用 -->
<img style="margin-right:auto; margin-left:auto;" src="<?php echo base_url(); ?>assets/img/clock.png" />
<p class="weui_btn_area"><a href="javascript:;" id="btnLoading" class="weui_btn weui_btn_primary">点我打卡</a></p>
<div class="weui_text_area"><div class="weui_msg_desc">上班时间: 09:30<br>下班时间: 18:30</div></div>
<div class="weui_tabbar">
                <a href="javascript:;" class="weui_tabbar_item weui_bar_item_on">
                    <div class="weui_tabbar_icon">
                        <img src="./images/icon_nav_button.png" alt="">
                    </div>
                    <p class="weui_tabbar_label">微信</p>
                </a>
                <a href="javascript:;" class="weui_tabbar_item">
                    <div class="weui_tabbar_icon">
                        <img src="./images/icon_nav_msg.png" alt="">
                    </div>
                    <p class="weui_tabbar_label">通讯录</p>
                </a>
                <a href="javascript:;" class="weui_tabbar_item">
                    <div class="weui_tabbar_icon">
                        <img src="./images/icon_nav_article.png" alt="">
                    </div>
                    <p class="weui_tabbar_label">发现</p>
                </a>
                <a href="javascript:;" class="weui_tabbar_item">
                    <div class="weui_tabbar_icon">
                        <img src="./images/icon_nav_cell.png" alt="">
                    </div>
                    <p class="weui_tabbar_label">我</p>
                </a>
            </div>
<script>
    $(function () {
        $('#btnLoading').on('click', function () {
            $.weui.loading('请稍等...');
            setTimeout(function () {
                var url = "<?php echo site_url('attendance/shakearound/ajax_clock'); ?>";
                $.get(url, function (response) {
                    console.log(response);
                    $.weui.hideLoading();
                    var data = $.parseJSON(response);
                    $.weui.toast(data.msg, {duration: 2000});
                    $(".weui_msg_desc").html(data.des);
                    $(".weui_text_area").show();
                })
            }, 1000);
        });
        $("body").on("click", "#checkas", function (e) {
            $.weui.dialog({
                title: '雷尚考勤制度',
                content: '正常工作时间<br>09:30 - 12:30  14:00 - 18:30<br>共计7.5小时<br>加班到21:00为小加班，可抵消10:15之前的小迟到一次<br>加班到23:00为大加班，可抵消10:15-11:00之间的大迟到一次；11:00之后到14:00为休假半天，大加班也可抵消休假半天<br>小加班每月清零不做累计，大加班可以累计到年底（12月31日）',
                buttons: [{
                        label: '知道了',
                        type: 'default',
                        onClick: function () {
                            console.log('知道了');
                        }
                    }]
            });
        });
    });
</script>