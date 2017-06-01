<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!--个人中心左边 开始-->
    <div class="left">
        <div class="head">
            <?php if($user=login('bool')): ?> 
            <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['uid']); ?>" target="_blank">            
                <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($user['uid']); ?>.160160.jpg">
            <?php endif; ?>
            </a>
        </div>
        <div class="head-but">
            <a href="<?php echo WEB_PATH; ?>/member/home/userphoto">修改头像</a>
            <a href="<?php echo WEB_PATH; ?>/member/home/modify" class="fr">编辑资料</a>
        </div>
        <div class="sidebar-nav">
            <p class="sid-line"></p>
            <h2 class="sid-icon01"><a href="<?php echo WEB_PATH; ?>/member/home/userindex" class="c_red f14"><b></b>我的<?php echo _cfg("web_name_two"); ?></a></h2>
            <p class="sid-line"></p>
            <h3 class="sid-icon09"><a href="<?php echo WEB_PATH; ?>/member/home/modify" class="c_red f14"><b></b>个人设置</a></h3>       
            <p class="sid-line"></p>
            <h3 class="sid-icon02 ss">
                <a href="javascript:void();" class="c_red f14"><b></b>我的<?php echo _cfg("web_name_two"); ?> <s title="收起" class="sid_ss"></s></a>
            </h3>
            <ul>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/shop/userbuylist"><?php echo L('html.key'); ?>记录</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/shop/orderlist"><?php echo L('html.key'); ?>中奖商品</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/shop/plaingoods">购买的商品</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/share/sharelist">晒单</a></li>
            </ul>
            <!-- <p class="sid-line"></p>
            <h3 class="sid-icon03 ss">
                <a href="javascript:void();" class="c_red f14"><b></b>圈子管理 <s title="收起" class="sid_ss"></s></a>
            </h3>
            <ul>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/club/joingroup">加入的圈子</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/club/topic">圈子话题</a></li>
            </ul> -->
            <?php if($member['manage_rank'] > 0): ?>
            <p class="sid-line"></p>
            <h3 class="sid-icon06 ss">
                <a href="javascript:void();" class="c_red f14"><b></b>
                管理商 <s title="收起" class="sid_ss"></s></a>
            </h3>
            <ul>
                <?php if($member['manage_rank'] == 1): ?>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/shop/dis1_buylist">一级管理商订单</a></li>
                <?php endif; ?>
                <?php if($member['manage_rank'] == 2): ?>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/shop/dis2_buylist">二级管理商订单</a></li>
                <?php endif; ?>
                <?php if($member['manage_rank'] == 3): ?>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/shop/dis3_buylist">三级管理商订单</a></li>
                <?php endif; ?>
                <?php if($member['manage_rank'] < 3): ?>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/subordinate/openlower">开通下级</a></li>
                <?php endif; ?>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/account/invitefriends">邀请好友</a></li>
            </ul>
            <?php endif; ?>
            <p class="sid-line"></p>
            <h3 class="sid-icon06 ss">
                <a href="javascript:void();" class="c_red f14"><b></b>
                分销管理 <s title="收起" class="sid_ss"></s></a>
            </h3>
            <ul>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/apply">申请分销</a></li>
                <?php if ( is_distributor( _getcookie( 'uid' ) ) ) { ?>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/distributor_info">分销中心</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/my_child">我的下级</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/money_log">佣金记录</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/withdrawals_apply">申请提现</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/withdrawals_log">提现记录</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/invitefriends">邀请好友</a></li>
                <?php } ?>
            </ul>
            <p class="sid-line"></p>        
            <h3 class="sid-icon05 ss">
                <a href="javascript:void();" class="c_red f14"><b></b>账户管理 <s title="收起" class="sid_ss"></s></a>
            </h3>
            <ul>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/account/userbalance">账户明细</a></li>
                <li class=""><a href="<?php echo WEB_PATH; ?>/member/account/userrecharge">账户充值</a></li>
            </ul>
            <!-- <p class="sid-line"></p>
            <h3 class="sid-icon07 sid-hcur" ><a href="<?php echo WEB_PATH; ?>/member/account/usercredit" class="c_red f14"><b></b>我的<?php echo L('cgoods.credit'); ?></a></h3> -->
        </div>
        <div class="sid-service">
            <p>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" target="_blank" class="service-btn">
                    <s></s><img border="0"  style="display:none;">在线客服
                </a>
            </p>
            <span>客服热线</span>
            <b class="tel c_red"><?php echo _cfg("cell"); ?></b>
        </div>
    </div>
    <!--个人中心左边 结束-->
<script>
    $(".sid_ss").click(function(){
        $(this).parents(".ss").next().toggle(200);
    })
</script>
