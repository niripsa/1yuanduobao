<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"个人中心",
        "Home":true,
        "Shop":true
    });
</script>
<section class="clearfix g-member">
    <div class="clearfix m-round m-name">
        <div class="fl f-Himg">
            <?php if($user=login('bool')): ?>
            <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['uid']); ?>" class="z-Himg">
            <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($user['uid']); ?>" border=0/></a>
            <?php endif; ?>
            </a>
            <!-- <span class="z-class-icon0<?php echo $dengji_1['groupid']; ?> gray01"><s></s><?php echo $dengji_1['name']; ?></span> -->
        </div>
        <div class="m-name-info">
        <p class="u-name">
        <b class="z-name gray01">
        <?php if($member['username']!=null): ?>
        <?php echo $member['username']; ?>
        <?php elseif ($member['mobile']!=null): ?>
        <?php echo $member['mobile']; ?>
        <?php  else: ?>
        <?php echo $member['email']; ?>
        <?php endif; ?>
        </b>
        <?php if($member['username']!=null): ?>
        (
        <?php if($member['mobile']!=null): ?>
        <?php echo $member['mobile']; ?>
        <?php  else: ?>
        <?php echo $member['email']; ?>
        <?php endif; ?>
        )
        <?php endif; ?>
        </p>
            <ul class="clearfix u-mbr-info">
                <!-- <li>可用<?php echo L('cgoods.credit'); ?> <span class="orange"><?php echo $member['score']; ?></span></li> -->
                <!-- <li>经验值 <span class="orange"><?php echo $member['jingyan']; ?></span></li> -->
                <li></li>
                <li class="cz">可用<?php echo L('cgoods.currency'); ?><span class="orange"><?php echo $member['money']; ?></span>
                <a href="<?php echo WEB_PATH; ?>/member/account/userrecharge" class="fr z-Recharge-btn">去充值</a></li>
            </ul>
        </div>
    </div>
    <div class="m-round m-member-nav">
        <ul id="ulFun">
            <li><a href="https://www.pgyer.com/1yshangcheng"><b class="z-arrow"></b>APP下载</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/shop/userbuylist"><b class="z-arrow"></b>我的<?php echo L('html.key'); ?>记录</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/shop/orderlist"><b class="z-arrow"></b><?php echo L('html.key'); ?>中奖商品</a></li>
            <!-- <li><a href="<?php echo WEB_PATH; ?>/member/shop/plaingoods"><b class="z-arrow"></b>购买的商品</a></li> -->
            <?php if($member['manage_rank'] > 0): ?>
            <!-- <li><a href="<?php echo WEB_PATH; ?>/member/account/invitefriends"><b class="z-arrow"></b>邀请好友</a></li> -->
            <?php endif; ?>
            <li><a href="<?php echo WEB_PATH; ?>/member/share/sharelist"><b class="z-arrow"></b>我的晒单</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/account/userbalance"><b class="z-arrow"></b>帐户明细</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/home/useraddress"><b class="z-arrow"></b>收货地址</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/home/modify"><b class="z-arrow"></b>个人资料</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/home/userpassword"><b class="z-arrow"></b>密码修改</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/apply"><b class="z-arrow"></b>申请分销</a></li>
            <?php if ( is_distributor( $member['uid'] ) ) { ?>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/distributor_info"><b class="z-arrow"></b>分销中心</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/my_child"><b class="z-arrow"></b>我的下级</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/money_log"><b class="z-arrow"></b>佣金记录</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/withdrawals_apply"><b class="z-arrow"></b>申请提现</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/withdrawals_log"><b class="z-arrow"></b>提现记录</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/distributor/invitefriends"><b class="z-arrow"></b>邀请好友</a></li>
            <?php } ?>
        </ul>
    </div>
</section>
<?php include self::includes("index.footer"); ?>