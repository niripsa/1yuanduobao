<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title": '分销信息',
        "Member":true,
        "Home":true
    });
</script>

<section class="clearfix g-member">
    <article class="clearfix m-round g-userMoney">
        您的分销佣金余额为： <span class="orange"><?php echo $info['dis_money']; ?></span>元
        <a href="<?php echo WEB_PATH; ?>/member/distributor/withdrawals_apply" class="z-Recharge-btn">申请提现</a>
    </article>
    <article class="clearfix m-round g-userMoney">
        您的下级总人数：<span class="orange"><?php echo $num; ?></span>人
        <a href="<?php echo WEB_PATH; ?>/member/distributor/my_child" class="z-Recharge-btn">查看下级</a>
    </article>
</section>
<?php include self::includes("index.footer"); ?>