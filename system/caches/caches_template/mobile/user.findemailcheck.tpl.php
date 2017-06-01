<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("login"); ?>
<?php echo js("jquery.Validform.min"); ?>
<?php echo js("jquery.pageDialog"); ?>
<?php include self::includes("index.header_top"); ?>
<section>
<div class="login_layout" style="padding: 10px;">
    <div class="login_title">
        <h2>找回密码</h2>
    </div>
    <div class="login_Content">
        <div id="divError" class="login_CMobile_Complete hidden">
            <p><span class="orange Fb">请稍候，系统正在发送邮件...</span></p>
        </div>
        <div id="divNormal" class="login_CMobile_Complete">
            <span>    <?php echo _cfg("web_name_two"); ?>已向您的 <span class="orange"><?php echo $email; ?></span> 邮箱发送了一封验证邮件，请前往收信，完成验证！</span>
            <a id="hylinkMails" class="login_Email_but" href="http://mail.<?php echo $emailurl['1']; ?>" target="_blank">登录邮箱完成验证</a>
        </div>

        <div class="login_Explain" style="margin-top: 20px;">
            <h2>没收到验证邮件？</h2>
            <p>1.查看邮箱的垃圾箱或广告箱，邮件有可能被误认为垃圾邮件。</p>
            <p>2.如果在10分钟后仍未收到验证邮件，请点击 <a id="retrySend" href="<?php echo WEB_PATH; ?>/member/finduser/findsendemail/<?php echo $email; ?>" class="login_SendoutbutClick">重新发送</a> </p>
        </div>  
    </div>
</div>
</section>
<!-- footer 开始-->
<?php include self::includes("index.footer"); ?>
