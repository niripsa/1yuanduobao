<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.webox"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="wrap" id="loadingPicBlock">
    <div id="current" class="list_Curtit mt0">
        <h1 class="fl c_red">商品搜索－"<?php echo $search; ?>"</h1> 
        <span id="spTotalCount">(共<em class="orange"><?php echo $search_sum; ?></em>件相关商品)</span>
    </div>
    <?php if($search_res): ?>         
    <div class="listContent">
        <ul class="item" id="ulGoodsList">
        <?php if(is_array($search_res)) foreach($search_res AS $shop): ?>     
            <li class="goods-iten">
                <div class="pic">
                <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['g_title']; ?>">
                <img alt="<?php echo $shop['g_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"></a>
                <p name="buyCount" style="display:none;"></p>
            </div>
            <p class="name">
                <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['g_title']; ?>"><?php echo $shop['g_title']; ?></a>
            </p>
            <p class="money"><?php echo L('cgoods.value'); ?>：<span  class="rmb"><?php echo $shop['g_money']; ?></span>   <?php echo L('cgoods.currency'); ?></p>
            <div class="Progress-bar">
                <p title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>">
                <span style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],211); ?>px;"></span></p>
                <ul class="Pro-bar-li">
                    <li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
                    <li class="P-bar02"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                    <li class="P-bar03"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
                </ul>
            </div>
            <div class="gl_buybtn">
                <div class="go_buy">
                    <a href="javascript:;" title="立即夺宝" class="go_Shopping fl"  onclick="jwebox.goshopnow(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>')"><?php echo L('cgoods.go'); ?></a>
                    <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" title="加入购物车" class="go_cart fr"><?php echo L('cgoods.cartlist'); ?></a>
                </div>
            </div>
            <div class="Curborid" style="display:none;">17272</div>
        </li>
        <?php endforeach; ?>
            </ul>
    </div>
    <?php  else: ?>
    <div class="NoConMsg w1200"><span>未找到有关“<em class="c_red"><?php echo $search; ?></em>”的商品</span></div>
    <?php endif; ?> 
    </div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
