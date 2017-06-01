<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user"); ?>
<?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="layout980 clearfix">
<?php include self::includes("user.left"); ?>
<!-- 个人中心中间 开始 -->
    <div class="center">
        <div class="per-info">
            <ul>
                <li class="info-mane gray02">
                    <b class="gray01">
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
                    <br>
                    <!-- <span><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($member['uid']); ?>" target="_blank" class="blue"><s></s><?php echo WEB_PATH; ?>/uname/<?php echo idjia($member['uid']); ?></a></span> -->
                </li>
                <!-- 经验值 -->
                <!-- <li class="account-money">
                    <em class="gray02">经验值：<?php echo $member['jingyan']; ?></em> 
                    <span class="class-icon0<?php echo $dengji_1['groupid']; ?> gray01"><s></s><?php echo $dengji_1['name']; ?></span>
                    <span class="gray02">（还差<?php echo $dengji_x; ?>经验值升级到<?php if($dengji_2['name']): ?><?php echo $dengji_2['name']; ?><?php  else: ?>最高等级<?php endif; ?>）</span>
                </li> -->
                <li class="account-money">
                    <em class="gray02">帐户余额：</em>
                    <span class="money-red"><?php echo $member['money']; ?>  <?php echo L('cgoods.currency'); ?></span>&nbsp;&nbsp;
                    <a href="<?php echo WEB_PATH; ?>/member/account/userrecharge" title="充值" class="blue">充值</a>
                </li>
                <!-- 我的福分 -->
                <!-- <li class="account-money">
                    <em class="gray02">我的<?php echo L('cgoods.credit'); ?>：</em>
                    <span class="money-red"><?php echo $member['score']; ?></span>&nbsp;&nbsp;
                </li>     -->           
            </ul>       
        </div>
    </div>
    <!--个人中心中间 结束-->
    <!--个人中心右边 开始-->
    <!-- <div class="right">             
        <div class="groups-shadow clearfix">
            <div class="R-grtit">
                <h3>圈子热门话题</h3>
            </div>
            <ul class="R-list">
                <?php $mod_common_club_db = System::load_app_model('club_db','common');$quanzi = $mod_common_club_db->GetHotClubPost(); ?>
                <?php if(is_array($quanzi)) foreach($quanzi AS $tm): ?>
                <li>
                    <p class="groups-t"><a href="<?php echo WEB_PATH; ?>/index/club/nei/<?php echo $tm['id']; ?>" target="_blank" class="gray"><?php echo $tm['title']; ?></a></p>
                    <p class="groups-c gray02"><?php echo Club_title($tm['cid']); ?><span class="gray03"> | </span><?php echo Club_postnum($tm['cid'],$tm['id']); ?>条回复</p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div> 
        <p class="r-line"></p>
    </div> -->
    <!--个人中心右边 结束-->
</div>
<?php include self::includes("index.footer"); ?>