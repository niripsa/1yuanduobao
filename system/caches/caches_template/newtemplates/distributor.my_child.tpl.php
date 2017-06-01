<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
<?php include self::includes("user.left"); ?>
<!--个人中心中间 开始-->
<div class="R-content">
    <div class="member-t"><h2>我的下级</h2></div>
    <div class="last">
        <ul>
            <li><h3>您当前共有下级</h3><b class="c_red"> <?php echo $num; ?> </b>人</li>
        </ul>
    </div>
    <div id="divList0" class="list-tab recordList f12">
        <ul class="listTitle">
            <li class="">UID</li>
            <li class="">用户名</li>
            <li class="">佣金余额</li>
            <li class="">加入时间</li>
            <li class="">操作</li>
        </ul>
    <?php if ( is_array( $list ) ) foreach ( $list as $at ): ?>
    <ul>
        <li class=""> <?php echo $at['uid']; ?> </li>
        <li class=""> <?php echo $at['username']; ?> </li>
        <li class=""> <?php echo $at['dis_money']; ?> </li>
        <li class=""> <?php echo date( 'Y-m-d H:i:s', $at['add_time'] ); ?> </li>
        <li class=""><a href="<?php echo WEB_PATH; ?>/member/distributor/my_child&parent_id=<?php echo $at['uid']; ?>" class="blue" title="查看下级">查看下级</a></li>        
    </ul>
    <?php endforeach; ?>
    </div>
    <?php if($total > $num): ?>
        <div class="pagesx"><?php echo $page->show('two'); ?></div> 
    <?php endif; ?> 
</div>  
<!--个人中心中间 结束-->
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
