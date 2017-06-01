<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
    <!--个人中心中间 开始-->
    <div class="R-content">
        <div class="member-t"><h2 style="font-size:14px;font-weight:bold;"><?php echo L('html.key'); ?>记录</h2></div>
        <div id="GoodsList" class="goods_show">
            <ul class="gtitle">
                <li>商品图片</li>
                <li class="gname">商品名称</li>
                <li class="yg_status"><?php echo L('html.key'); ?>状态</li>
                <li class="joinInfo">参与人次</li>
                <li class="do">操作</li>
            </ul>
            <?php if(is_array($record)) foreach($record AS $rt): ?>
            <?php if($rt['getowin_uid']): ?> 
            <ul class="goods_list"> 
                <li><a title="" target="_blank" class="pic" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $rt['ogid']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo useri_title($rt['og_title'],'g_thumb'); ?>"></a></li>
                <li class="gname"style="margin:10px 0 0 0;">
                    <a target="_blank" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $rt['ogid']; ?>" class="blue">第(<?php echo $rt['oqishu']; ?>)期 <?php echo useri_title($rt['og_title'],'g_title'); ?></a>
                    <p class="gray02">获得者：<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($rt['getowin_uid']); ?>" target="_blank" class="blue"><?php echo $rt['getowin_uname']; ?></a></p>
                    <p class="gray02">揭晓时间：<?php echo microt($rt['q_end_time'],'r'); ?></p>
                </li>           
                <li class="yg_status" style="margin:23px 0 0 0;"><span class="c_red">已揭晓</span></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['onum']; ?></em>人次</p></li>
                <li class="do" style="margin:23px 0 0 0;"><a href="<?php echo WEB_PATH; ?>/member/shop/userbuydetail/<?php echo $rt['oid']; ?>" class="blue" title="详情">详情</a></li>
            </ul>
            <?php  else: ?>
            <ul class="goods_list"> 
                <li><a title="" target="_blank" class="pic" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo useri_title($rt['og_title'],'g_thumb'); ?>"></a></li>
                <li class="gname" style="margin:15px 0 0 0;">
                    <a target="_blank" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>" class="blue">第(<?php echo $rt['oqishu']; ?>)期  <?php echo useri_title($rt['og_title'],'g_title'); ?></a>             
                    <p class="gray02">购买时间：<?php echo microt($rt['otime'],'r'); ?></p>
                </li>
                <li class="yg_status" style="margin:23px 0 0 0;"><span class="orange">正在进行...</span></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['onum']; ?></em>人次</p></li>
                <li class="do" style="margin:23px 0 0 0;"><a href="<?php echo WEB_PATH; ?>/member/shop/userbuydetail/<?php echo $rt['oid']; ?>" class="blue" title="查看夺宝码">查看购买码</a></li>
            </ul>   
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>  
    <?php if($total>$num): ?>
        <div class="pagesx"><?php echo $page->show('two'); ?></div> 
    <?php endif; ?> 
    <!--个人中心中间 结束-->
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>