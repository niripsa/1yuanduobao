<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php echo css("user"); ?>
<?php include self::includes("index.header"); ?>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <div class="sidebar">
        <div class="head" style="height:140px;">
        <a href=""><img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($member['uid']); ?>.160160.jpg" width="160" height="160" border="0"></a>
        </div>  
    </div>  
    <div class="content clearfix" style="width:799px;">
        <div class="per-info">
            <ul>
                <li class="info-mane gray02">
                    <b class="gray01"><?php echo get_user_name($member,'username'); ?></b>
                </li>
                <!--<li class="info-address"><span><a href="" class="blue"><s></s><?php echo WEB_PATH; ?>/uname/<?php echo idjia($member['uid']); ?></a></span></li>
                -->
                <li class="info-intro gray02">
                    <?php if($member['qianming']!=null): ?>
                    <?php echo $member['qianming']; ?>
                    <?php  else: ?>
                    这家伙很懒，什么都没留下。
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <div class="su_s">
            <span>总共<?php echo L('html.key'); ?>次数：</span><b><?php echo $retotal; ?></b>
            <div class="yun_zj"></div>
            <span>总共中奖次数：</span><b><?php echo $hdtotal; ?></b>
        </div>
    </div>
    <div class="clear"></div>
        <div  class="ugoods_show">
            <ul class="ugtitle">
                <li>商品图片</li>
                <li class="gname">商品名称</li>
                <li class="yg_status"><?php echo L('html.key'); ?>状态</li>
                <li class="joinInfo">参与人次</li>
                <li class="do">操作</li>
            </ul>
            <?php if(is_array($record)) foreach($record AS $rt): ?>
            <ul class="ugoods_list">
                <li><a title="" target="_blank" class="pic" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo useri_title($rt['og_title'],'g_thumb'); ?>"></a></li>
                <?php if($rt['q_uid']): ?>
                <li class="gname"style="margin:10px 0 0 0;">
                    <a target="_blank" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>" class="blue">第(<?php echo $rt['oqishu']; ?>)期 <?php echo useri_title($rt['og_title'],'g_title'); ?></a>
                    <p class="gray02">获得者：<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($rt['q_uid']); ?>" target="_blank" class="blue"><?php echo Getusername($rt['q_uid']); ?></a></p>
                    <p class="gray02">揭晓时间：<?php echo microt($rt['q_end_time'],'r'); ?> </p>
                </li>
                <?php  else: ?>
                <li class="gname" style="margin:15px 0 0 0;">
                    <a target="_blank" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>" class="blue">第(<?php echo $rt['oqishu']; ?>)期 <?php echo useri_title($rt['og_title'],'g_title'); ?></a>
                    <p class="gray02">购买时间：<?php echo microt($rt['otime'],'r'); ?></p>
                </li>
                <?php endif; ?>
                <li class="yg_status" style="margin:23px 0 0 0;"><span class="c_red"><?php if($rt['q_showtime'] == 'N' and  $rt['q_uid']): ?>已揭晓<?php  else: ?>正在进行...<?php endif; ?></span></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['onum']; ?></em>人次</p></li>
                <?php if($user=login('bool')): ?> 
                <?php if($rt['q_showtime'] == 'N' and  $rt['q_uid']): ?>
                <li class="do" style="margin:23px 0 0 0;"><a href="<?php echo WEB_PATH; ?>/member/shop/userbuydetail/<?php echo $rt['oid']; ?>" class="blue" title="查看<?php echo L('html.key'); ?>码">查看<?php echo L('html.key'); ?>码</a></li>
                <?php  else: ?>
                <li class="do" style="margin:23px 0 0 0;"><a href="<?php echo WEB_PATH; ?>/member/shop/userbuydetail/<?php echo $rt['oid']; ?>" class="blue" title="详情">详情</a></li>
                <?php endif; ?>
                <?php  else: ?>
                <?php if($rt['q_showtime'] == 'N' and  $rt['q_uid']): ?>
                <li class="do" style="margin:23px 0 0 0;"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>" class="blue" title="查看<?php echo L('html.key'); ?>码">查看<?php echo L('html.key'); ?>码</a></li>
                <?php  else: ?>
                <li class="do" style="margin:23px 0 0 0;"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $rt['ogid']; ?>" class="blue" title="详情">详情</a></li>
                <?php endif; ?>
                <?php endif; ?>                
            </ul>
            <?php endforeach; ?>
        
        </div>  
        <?php if($retotal>$num): ?>
        <div class="pagesx"><?php echo $page->show('two'); ?></div> 
        <?php endif; ?>                 
</div>

<!--商品 wrap 结束-->
<div class="clear"></div>
<script>
$(function(){
    $("#referDocument li").bind({       
        mouseover:function(){
            var number=$("#referDocument li").index(this)+1;
            $(".S0"+number).removeClass("hidden");
        },
        mouseout:function(){
            var number=$("#referDocument li").index(this)+1;
            $(".S0"+number).addClass("hidden");
        }
    })
})
</script>
<?php include self::includes("index.footer"); ?>
</html>
