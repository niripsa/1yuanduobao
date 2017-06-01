<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
    <!--个人中心中间 开始-->
    <div class="R-content">
        <div class="subMenu">
            <a class="current">已晒单</a>
            <a>未晒单</a>
        </div>
        <!--已晒单 开始-->
        <div class="list-tab topic" style="display: block;">
            <ul class="listTitle">
                <li style="text-align:center;" class="w100">晒单图片</li>
                <li class="w400">晒单信息</li>
                <li class="w130">晒单状态</li>
                <li class="w85 fr">操作</li>
            </ul>
            <?php if(!$shareed): ?>
            <div class="tips-con"><i></i>暂无记录！</div>
            <?php  else: ?>
            <?php if(is_array($shareed)) foreach($shareed AS $sd): ?>
            <ul class="listCon">            
                <li class="w100" style="text-align:center;"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank" class="blue"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"width="50"height="50"></a></li>
                <li class="w400"><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>" target="_blank" class="gray01"><?php echo $sd['sd_title']; ?></a></li>
                <li class="w85 fr">
                <font color="#666">不可修改</font>
                </li>
            </ul>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!--已晒单 结束-->

        <!--未晒单 开始-->
        <div class="list-tab topic" style="display:none">
            <ul class="listTitle">
                <li style="text-align:center;" class="w100">商品图片</li>
                <li class="w630">商品信息</li>
                <li class="w85 fr">操作</li>
            </ul>
            <?php if(!$share): ?>
            <div class="tips-con"><i></i>暂无记录！</div>
            <?php  else: ?>
            <?php if(is_array($share)) foreach($share AS $sd): ?>
            <ul class="listCon">
                <li style="text-align:center;" class="w100"><div class="listConT"><img width="50" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo shoplisext($sd['ogid'],'g_thumb'); ?>"/></div></li>
                <li style="text-indent:1em;" class="w400"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $sd['ogid']; ?>" target="_blank"><?php echo shoplisext($sd['ogid'],'g_title'); ?></a></li>
                <li class="w50 fr"><a name="delete" href="<?php echo WEB_PATH; ?>/member/share/shareinsert/<?php echo $sd['oid']; ?>" class="blue">添加晒单</a></li>
            </ul>                   
            <?php endforeach; ?>
            <?php endif; ?>         
        </div>  
        <!--未晒单 结束-->
    </div>
    <!--个人中心中间 结束-->
</div>
<!--商品 wrap 结束-->
<script>
$(function(){
    $(".subMenu a").click(function(){
        var id=$(".subMenu a").index(this);
        $(".subMenu a").removeClass().eq(id).addClass("current");
        $(".R-content .topic").hide().eq(id).show();
    });
})
</script>
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
