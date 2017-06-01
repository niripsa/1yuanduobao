<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/ZeroClipboard.js"></script>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
    <!--个人中心中间 开始-->
    <div class="R-content">
        <div class="member-t"><h2>邀请好友</h2></div>
        <div id="divInvited" class="success-invitation gray02">
            <p>复制链接邀请好友来夺宝啦！ 
            <!-- <a target="_blank" href="<?php echo WEB_PATH; ?>/single/pleasereg" class="blue">详情&gt;&gt;</a> -->
            </p>
            <span><b></b><input id="txtInfo" style="width:818px;height:20px; " disabled="disabled" value="1元就能中大奖哦，快去看看吧！<?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>/<?php echo $area_id; ?>" onpaste="return false" type="text"></span>
            <div class="d_clip_copy"></div>
            <div id="d_clip_container" style="position:relative;overflow:hidden">
                <div id="d_clip_button" class="bluebut f12" style="text-align:center;line-height:22px;width:60px;padding:0;">复制</div>
                <!-- <div style="position: absolute; left: 1px; top: 24px; width: 64px; height: 20px; z-index: 99;"><embed id="ZeroClipboardMovie_1" src="" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="64" height="20" name="ZeroClipboardMovie_1" align="middle" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="" flashvars="id=1&amp;width=64&amp;height=20" wmode="transparent"></div>
             --></div>
        </div>
        <div id="divInviteInfo" class="get-tips gray01 f12 bg_pink b_pink" style="">成功邀请
            <span class="c_red"><?php echo $involvedtotal; ?></span> 位会员注册，已有 <span class="c_red"><?php echo $involvednum; ?></span> 位会员参与夺宝
        </div>
        <div id="divList" class="list-tab SuccessCon f12">
            <ul class="listTitle">
                <li class="w70">用户编号</li>
                <li class="w120">用户名</li>
                <li class="w120">时间</li>
                <li class="w70">邀请编号</li>
                <li class="w70">消费状态</li>
                <li class="w70">会员身份</li>
                <li class="w70">操作</li>
            </ul>
            <?php if($involvedtotal != 0): ?>
            <?php if(is_array($invifriends)) foreach($invifriends AS $key => $val): ?>
            <ul>
                <li class="w70"><?php echo $val['uid']; ?></li>
                <li class="w120"><a href="" target="_blank" class="blue"><?php echo $val['sqlname']; ?></a></li>
                <li class="w120"><?php echo date('Y.m.d H:i:s',$val['time']); ?></li>
                <li class="w70"><?php echo idjia($val['uid']); ?></li>
                <li class="w70"><?php echo $records[$val['uid']]; ?></li>
                <li class="w70"><?php echo $manage_rank[$val['manage_rank']]; ?></li>
                <?php if ( in_array( $member['manage_rank'], array( '1', '2' ) ) ) { ?>
                <li class="w70"><a href="<?php echo WEB_PATH . '/member/shop/dis'.$member['manage_rank'].'_buylist/0/0/0/0/' . $val['uid']; ?>" class="blue">查看订单</a></li>
                <?php } ?>
            </ul>
            <?php endforeach; ?>
            <?php  else: ?>
            <div class="tips-con f12"><i></i>您还未有邀请谁哦</div>
            <?php endif; ?>
        </div>
    </div>
    <!--个人中心中间 结束-->
</div>
<!--商品 wrap 结束-->
<script type="text/javascript">
    var clip = null;
    function copy(id){ return document.getElementById(id); }
    function initx(){
        clip = new ZeroClipboard.Client();
        clip.setHandCursor(true);
        ZeroClipboard.setMoviePath("<?php echo G_TEMPLATES_STYLE; ?>/js/ZeroClipboard.swf");
        clip.addEventListener('mouseOver',function (client){
            clip.setText(copy('txtInfo').value );
        });

        clip.addEventListener('complete',function(client,text){
            alert("邀请复制成功");
        });
        clip.glue('d_clip_button','d_clip_container');
    }
    $(function(){
        initx();
    })

</script>
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
