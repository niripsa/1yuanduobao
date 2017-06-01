<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title": '申请分销',
        "Member":true,
        "Home":true
    });
</script>

<section class="clearfix g-member">
    <article class="clearfix m-round g-userMoney">
        申请分销资格，获取推广收益！
        <a href="<?php echo WEB_PATH; ?>/member/distributor/apply&apply=1" class="z-Recharge-btn">去申请</a>
    </article>
</section>
<?php include self::includes("index.footer"); ?>