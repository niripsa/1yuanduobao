<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.GoodsPicSlider"); ?>
<?php echo js("jquery.cmsapi"); ?>
<?php echo js("jquery.pageDialog"); ?>
<?php echo js("jquery.cartlist"); ?>
<?php echo js("jquery.BusyTime"); ?>
<?php echo js("function"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $(function(){
        $("#sliderBox").picslider()
    });
    $.YunCmsApi.SetTopStyle({
        "Title":"商品详情",
        "Home":true,
        "Member":false,
        "Shop":true
    }); 
</script>

<section class="goodsCon pCon">
    <!-- 导航 -->
    <div id="divPeriod" class="pNav">
        <div class="loading" style="display:none"><b></b>正在加载</div>
        <ul class="slides">
            <li class="<?php echo $style0; ?>"><a href="<?php echo $cgoods_url0; ?>" >第<?php echo $itemlist0['qishu']; ?>期</a><b></b></li>  
            <?php if(is_array($itemlist)) foreach($itemlist AS $qitem): ?>
            <?php if($qitem['qishu']<$item['qishu']): ?>
            <li><a href="<?php echo $qitem['cgoods_url']; ?>">第<?php echo $qitem['qishu']; ?>期</a><b></b></li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if($item['q_end_time'] == '' && $item['xsjx_time'] != 0): ?>
    <!-- 限时揭晓倒计时 -->
    <div id="divLotteryTime" class="pProcess clearfix">
        <div class="pCountdown">
            <div id="busytime" class="g-snav busytime">
                <div class="g-snav-lst">揭晓<br>倒计时<s></s></div>
                <div class="g-snav-lst"><b id="hour_1">00</b><em>时</em></div>
                <div class="g-snav-lst"><b id="minute_1">00</b><em>分</em></div>
                <div class="g-snav-lst"><b id="second_1">00</b><em>秒</em></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            timer( <?php echo $item['xsjx_time'] - time(); ?>, 1, '' );
        });
    </script>
    <?php endif; ?>


    <?php if($item['q_end_time'] != '' && $item['xsjx_time']==0): ?>
    <!-- 普通揭晓倒计时 -->
    <div id="divLotteryTime" class="pProcess clearfix">
        <div class="pCountdown">
            <div id="busytime" class="g-snav busytime">
                <div class="g-snav-lst">揭晓<br>倒计时<s></s></div>
                <div class="g-snav-lst"><b>00</b><em>小时</em></div>
                <div class="g-snav-lst"><b>00</b><em>分</em></div>
                <div class="g-snav-lst"><b>00</b><em>秒</em></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var html =  '<div class="g-snav-lst">揭晓<br>倒计时<s></s></div>'+
                    '<div class="g-snav-lst"><b>{hh}</b><em>时</em></div>'+
                    '<div class="g-snav-lst"><b>{mm}</b><em>分</em></div>'+
                    '<div class="g-snav-lst"><b>{ss}.{ms}</b><em>秒</em></div>';
        $.post( "<?php echo WEB_PATH; ?>/index/getshop/lottery_shop_get", {"lottery_shop_get":true,"gid":<?php echo $item['id']; ?>, "times":Math.random()}, function( ret ) {
                var times = (new Date().getTime()) + (parseInt(ret)) * 1000;
                if ( ret == 'no' ) return;
                $("#busytime").attr( "time", times );
                $("#busytime").busytime({
                    view    : html,
                    callback:function( $dom ) {
                       window.location.href = "<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $item['id']; ?>";
                    }
                }).start();
            }
        );
    </script>
    <?php endif; ?>


    <!-- 产品图 -->
    <div id="divPic" class="pPic">
        <div class="pPic2">
            <div id="sliderBox" class="pImg">
                <div class="loading" style="display:none"><b></b>正在加载</div>
                <ul class="slides">
                    <?php if(is_array($item['g_picarr'])) foreach($item['g_picarr'] AS $imgtu): ?>
                    <li><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" /></li>
                    <?php endforeach; ?>
                </ul>
                <ul class="direction-nav">
                    <li class="prev" style="display: block; width: 205px;"></li>
                    <li class="next" style="display: block; width: 205px;"></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 条码信息 -->
    <div class="pDetails">
        <b>(第<?php echo $item['qishu']; ?>期)<?php echo $item['g_title']; ?><span></span></b>
        <p class="price"><?php echo L('cgoods.value'); ?>：<em class="arial gray">
        <?php echo $item['g_money']; ?><?php echo L('cgoods.currency'); ?></em></p>
                <div class="Progress-bar">
                    <p class="u-progress" title="已完成<?php echo percent($item['canyurenshu'],$item['zongrenshu']); ?>">
                        <span class="pgbar" style="width:<?php echo $item['canyurenshu']/$item['zongrenshu']*100; ?>%;">
                            <span class="pging"></span>
                        </span>
                    </p>
                    <ul class="Pro-bar-li" style="overflow: hidden;">
                        <li class="P-bar01"><em><?php echo $item['canyurenshu']; ?></em>已参与</li>
                        <li class="P-bar02"><em><?php echo $item['zongrenshu']; ?></em>总需人次</li>
                        <li class="P-bar03"><em><?php echo $item['zongrenshu']-$item['canyurenshu']; ?></em>剩余</li>
                    </ul>
                </div>
            <?php if($item['q_end_time'] !=''): ?>
                <!--<div class="pClosed">本期已揭晓</div> -->
                <?php if($itemxq==1): ?>
                <div class="pOngoing" codeid="<?php echo $itemzx['id']; ?>">第<em class="arial"><?php echo $itemzx['qishu']; ?></em>期 正在进行中……<span class="fr">查看详情</span></div>
                <?php endif; ?>
            <?php elseif ($item['zongrenshu']==$item['canyurenshu']): ?>             
               <div class="pClosed">下手慢了！！ 被抢光啦！！</div>
            <?php  else: ?>
              
              <div id="btnBuyBox" class="pBtn" codeid="<?php echo $item['id']; ?>">
                <a href="javascript:;" class="fl buyBtn Det_Shopbut"><?php echo L('cgoods.go'); ?></a>
                <a href="javascript:;" id="car_<?php echo $item['id']; ?>" class="fr addBtn"  onclick="gcartlist.gocartlist(<?php echo $item['id']; ?>,'<?php echo WEB_PATH; ?>','<?php echo GetConfig('cookie_pre'); ?>')"><?php echo L('cgoods.cartlist'); ?></a>
              </div>
            <?php endif; ?>    
    </div>

    <!-- 上期获得者 -->
    <div class="joinAndGet">
        <dl>
            <a href="<?php echo WEB_PATH; ?>/index/cloud_goods/go_record_iframe/<?php echo $item['id']; ?>/20"><b class="fr z-arrow"></b>所有夺宝记录</a>
            <a href="<?php echo WEB_PATH; ?>/cgoodsdesc/<?php echo $item['id']; ?>"><b class="fr z-arrow"></b>图文详情<em>（建议WIFI下使用）</em> </a>
            <a href="<?php echo WEB_PATH; ?>/index/share/share_iframe/<?php echo $item['id']; ?>"><b class="fr z-arrow"></b>已有<span class="orange arial">0</span>个幸运者晒单<strong class="orange arial">0</strong>条评论</a>
        </dl>
        
        <?php if($previous_cgoods && $previous_cgoods['q_showtime'] == "N"): ?>
        <ul id="prevPeriod" class="m-round" codeid="398781" uweb="1006028413">
            <li class="fl"><s></s><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $previous_cgoods['g_thumb']; ?>"/></li>
            <li class="fr"><b class="z-arrow"></b></li>
            <li class="getInfo">
                <dd><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($previous_cgoods['q_uid']); ?>"><em class="blue"><?php echo $previous_user['username']; ?></em></a>  </dd>
          
                <dd>幸运<?php echo L('html.key'); ?>码：<em class="orange arial"><?php echo $previous_cgoods['q_user_code']; ?></em></dd>
                <dd>揭晓时间：<?php echo microt($previous_cgoods['q_end_time'],'r'); ?></dd>
                <dd>夺宝时间：<?php echo microt($preuser_shop_time,'r'); ?></dd>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</section>

<script>
var syrs     = <?php echo $item['zongrenshu']-$item['canyurenshu']; ?>;
var shopinfo = {'shopid':<?php echo $item['id']; ?>,'money':<?php echo $item['price']; ?>,'shenyu':syrs};
$(function() {
    $(".Det_Cart").click(function(){ 
        Cartcookie(false);
    });
    $(".Det_Shopbut").click(function(){ 
        Cartcookie(true);
    }); 
});

function Cartcookie( cook )
{
    var info       = {};
    var shopid     = shopinfo['shopid'];
    var cookie_pre = "<?php echo GetConfig('cookie_pre'); ?>";//cookie配置前缀
    var Cartlist   = $.cookie(cookie_pre+'Cartlist');
    if ( ! Cartlist ) {
        var info = {};
    } else {
        var info = $.evalJSON( Cartlist );
        if ( (typeof info) !== 'object' )
        {
            var info = {};
        }
    }       
    if ( ! info[shopid] )
    {
        var CartTotal=$("#sCartTotal").text();
        $("#sCartTotal").text(parseInt(CartTotal)+1);
        $("#btnMyCart em").text(parseInt(CartTotal)+1);
    }   
    var number=1;   
    info[shopid]           = {};
    info[shopid]['num']    = number;
    info[shopid]['shenyu'] = shopinfo['shenyu'];
    info[shopid]['money']  = shopinfo['money'];
    info['MoenyCount']     = '0.00';
    $.cookie( cookie_pre+'Cartlist', $.toJSON(info), {expires:7,path:'/'} );    
    if ( cook )
    {
        window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist/"+new Date().getTime();//+new Date().getTime()
    }
}
</script>
<!-- footer 开始-->
<?php include self::includes("index.footer"); ?>