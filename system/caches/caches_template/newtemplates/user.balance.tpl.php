<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
<?php include self::includes("user.left"); ?>
    <!--个人中心中间 开始-->
    <div class="R-content">
        <div class="member-t"><h2>账户明细</h2></div>
        <div class="last">
            <ul>
                <li><h3>您的账户可用余额为：</h3><b class="c_red"><?php echo $member_money; ?></b><?php echo L('cgoods.currency'); ?> <a href="<?php echo WEB_PATH; ?>/member/account/userrecharge" class="bluebut" title="充值">充值</a></li>
            </ul>
        </div>
        <div id="divList0" class="list-tab recordList f12">
            <ul class="listTitle">
                <li class="leftTitle">充值时间</li>
                <li class="price">资金渠道</li>
                <li class="regard">收入/支出</li>
            </ul>
    <?php if(is_array($account)) foreach($account AS $at): ?>          
            <ul>
                <li class="leftTitle fontAri"><?php echo date("Y-m-d H:i:s",$at['time']); ?></li>
                <li class="price"><?php echo $at['content']; ?></li>
                <li class="regard">
                <?php if($at['type'] == 1): ?>
                    <font color="#0c0"><?php echo $at['money']; ?><?php echo L('cgoods.currency'); ?></font>
                <?php  else: ?>    
                <?php if($at['type'] == -1): ?>  
                     <font color="red"><?php echo $at['money']; ?><?php echo L('cgoods.currency'); ?></font>  
                <?php  else: ?>
                    <font color="red"><?php echo $at['money']; ?><?php echo L('cgoods.currency'); ?></font>
                <?php endif; ?> 
                <?php endif; ?> 
                </li>
            </ul>
    <?php endforeach; ?>

        </div>      
        <?php if($total>$num): ?>
            <div class="pagesx"><?php echo $page->show('two'); ?></div> 
        <?php endif; ?> 

    </div>  
    <!--个人中心中间 结束-->
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
