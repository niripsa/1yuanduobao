<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css">
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
    <!--个人中心中间 开始-->
    <div class="R-content">
        <div class="member-t"><h2 style="font-size:14px;font-weight:bold;">管理商订单</h2></div>
        <div class="get-pro gray02 f12">金额统计 <b class="c_red"> <?php echo $order_amount ? : 0; ?> </b> 元</div>
        <div class="select">
        <ul id="ulMoneyList">
            <label for="rd10">购买者： </label>
            <input type="text" id="ou_name" class="enter" value="<?php echo $search['ou_name']; ?>" >
            添加时间:
            <input id="start_otime" type="text" class="enter" value="<?php echo $search['start_otime'] ? : ''; ?>" readonly="readonly" />至
            <input id="end_otime" type="text" class="enter" value="<?php echo $search['end_otime'] ? : ''; ?>" readonly="readonly" />

            <input type="submit" onclick="search();" class="bluebut imm" value="搜索" />
            <input type="submit" onclick="location.href = '<?php echo $search_url; ?>'" class="bluebut imm" value="撤销" />
        </ul>
        </div>
        <div id="GoodsList" class="goods_show">
            <ul class="gtitle">
                <li>商品图片</li>
                <li class="gname">商品名称</li>
                <li class="yg_status"><?php echo L('html.key'); ?>状态</li>
                <li class="joinInfo">参与人次</li>
                <li class="joinInfo">购买者</li>
                <li class="joinInfo">消费</li>
                <!-- <li class="do">操作</li> -->
            </ul>
            <?php if(is_array($record)) foreach($record AS $rt): ?>
            <?php if($rt['getowin_uid']): ?>
            <ul class="goods_list"> 
                <li><a title="" target="_blank" class="pic" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $rt['ogid']; ?>">
                <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo useri_title($rt['og_title'],'g_thumb'); ?>"></a>
                </li>
                <li class="gname"style="margin:10px 0 0 0;">
                    <a target="_blank" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $rt['ogid']; ?>" class="blue">第(<?php echo $rt['oqishu']; ?>)期 <?php echo useri_title($rt['og_title'],'g_title'); ?></a>
                    <p class="gray02">获得者：<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($rt['getowin_uid']); ?>" target="_blank" class="blue"><?php echo $rt['getowin_uname']; ?></a></p>
                    <p class="gray02">揭晓时间：<?php echo microt($rt['q_end_time'],'r'); ?></p>
                </li>           
                <li class="yg_status" style="margin:23px 0 0 0;"><span class="c_red">已揭晓</span></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['onum']; ?></em>人次</p></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['ou_name']; ?></em></p></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['omoney']; ?></em></p></li>
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
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['ou_name']; ?></em></p></li>
                <li class="joinInfo" style="margin:23px 0 0 0;"><p><em><?php echo $rt['omoney']; ?></em></p></li>
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
<script type="text/javascript">
    date = new Date();
    Calendar.setup({
        inputField     :    "start_otime",
        ifFormat       :    "%Y-%m-%d %H:%M:%S",
        showsTime      :    true,
        timeFormat     :    "24"
    });
    Calendar.setup({
        inputField     :    "end_otime",
        ifFormat       :    "%Y-%m-%d %H:%M:%S",
        showsTime      :    true,
        timeFormat     :    "24"
    });
</script>
<script type="text/javascript">
/* 搜索 */
function search()
{
    var url = "<?php echo $search_url; ?>";
    var ou_name     = $( '#ou_name' ).val();
    ou_name = ou_name != '' ? ou_name : '0';
    var start_otime = $( '#start_otime' ).val();
    start_otime = start_otime != '' ? start_otime : '0';
    var end_otime   = $( '#end_otime' ).val();
    end_otime = end_otime != '' ? end_otime : '0';
    /* 订单来源 */
    var order_source = $( '#order_source' ).val();
    order_source = order_source != '' ? order_source : '0';

    url = url + '/' + ou_name + '/' + start_otime + '/' + end_otime + '/' + order_source;
    location.href = url;
}
</script>
<?php include self::includes("index.footer"); ?>