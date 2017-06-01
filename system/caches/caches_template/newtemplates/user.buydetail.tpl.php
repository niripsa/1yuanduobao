<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
    <!--个人中心中间 开始-->
    <div class="R-content">
        <div class="member-t"><h2><?php echo L('html.key'); ?>记录</h2></div>
        <div class="yg_record_goods">
            <a href="" target="_blank" class="fl-img"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $user_record['g_thumb']; ?>"></a>
            <div class="yg_record_r">
                <li><span class="c_red">(第<?php echo $user_record['oqishu']; ?>期)</span>
                <a target="_blank" href="
                <?php if($user_record['q_showtime'] == 'Y'): ?>
                <?php echo WEB_PATH; ?>/cgdataserver/<?php echo $user_record['ogid']; ?>
                <?php  else: ?>
                <?php echo WEB_PATH; ?>/cgoods/<?php echo $user_record['ogid']; ?>
                <?php endif; ?>
                " class="blue"><?php echo $user_record['g_title']; ?></a></li>
                <li><a  target="_blank" href="
                <?php if($user_record['q_showtime'] == 'Y'): ?>
                <?php echo WEB_PATH; ?>/cgdataserver/<?php echo $user_record['ogid']; ?>
                <?php  else: ?>
                <?php echo WEB_PATH; ?>/cgoods/<?php echo $user_record['ogid']; ?>
                <?php endif; ?>
                " class="bluebut">查看详情</a></li>
            </div>
        </div>

        <div class="goods-tit gray02">
            <p class="fl">本期商品您总共<?php echo L('html.key'); ?><span><?php echo $user_record['onum']; ?></span>人次 拥有<span><?php echo $user_record['onum']; ?></span>个<?php echo L('html.key'); ?>码</p><a href="<?php echo WEB_PATH; ?>/member/shop/userbuylist" class="blue fr">&lt;&lt; 返回列表</a>
        </div> 
        <div class="list-tab goodsList" id="userbuylist">
            <ul class="listTitle">
                <li class="leftTitle"><?php echo L('html.key'); ?>时间</li>
                <li><?php echo L('html.key'); ?>人次</li>
                <li class="Code"><?php echo L('html.key'); ?>码</li>
            </ul>
            <ul><li class="leftTitle"><?php echo microt($user_record['otime'],'r'); ?></li>
                <li><?php echo $user_record['onum']; ?>人次</li>
                <li class="Code"><span><?php echo yunma($user_record['ogocode']); ?></span></li>
            </ul>
        </div>
        <div class="goods-tit gray02"><a href="<?php echo WEB_PATH; ?>/member/shop/userbuylist" class="blue fr">&lt;&lt; 返回列表</a></div>
    </div>   
    <!--个人中心中间 结束-->
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
