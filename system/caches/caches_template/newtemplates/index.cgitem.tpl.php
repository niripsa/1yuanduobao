<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<div class="clear"></div>
<div class="wrap w1200">
    <div class="Current_nav w1200">
        <a href="<?php echo WEB_PATH; ?>">首页</a> &gt; 
        <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $item['g_cateid']; ?>_0_0"><?php echo $model_title['cate_name']; ?></a> &gt;
        <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $item['g_cateid']; ?>_<?php echo $item['g_brandid']; ?>_0"><?php echo $model_title['brand_name']; ?></a> &gt;
        <?php echo $model_title['title']; ?>
    </div>
    <div class="show_content">
        <div id="divPeriodList" class="show_Period" style="max-height:99px;">
            <div class="period_Open bt_gray bb_gray bl_gray">
                <a class="gray02" href="javascript:;" id="btnOpenPeriod" click="off">展开<i></i></a>
            </div>
        <ul class="Period_list bb_gray">
        <li><a href="<?php echo $cgoods_url0; ?>" ><b class="<?php echo $style0; ?>">第<?php echo $itemlist0['qishu']; ?>期<i></i></b></a></li>
        <?php if(is_array($itemlist)) foreach($itemlist AS $qitem): ?> 
        <?php if($qitem['key']%9==0): ?>
        </ul><ul class="Period_list bb_gray">
        <?php endif; ?>
        <li><a href="<?php echo $qitem['cgoods_url']; ?>" class="<?php echo $qitem['stylea']; ?>"><b class="<?php echo $qitem['style']; ?>">第<?php echo $qitem['qishu']; ?>期<i></i></b></a></li>
        <?php endforeach; ?>
        </ul>
        </div>
        <div class="Pro_Details">
            <p style="font-size:24px;padding-bottom: 9px;margin-top: 15px;color:#f00">
                <span class="f24">(第<?php echo $item['qishu']; ?>期)</span>
                <span class="f24"><?php echo $item['g_title']; ?></span>
                <span style="<?php echo $item['g_title_style']; ?>"><?php echo $item['g_description']; ?></span>
            </p>
        <div class="Pro_Detleft">
            <div class="zoom-small-image">
                <div id="wrap" style="top:0px;z-index:9999;position:relative;">
                   <span href="<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['g_thumb']; ?>" class="cloud-zoom" id="zoom1" rel="adjustX:10, adjustY:-2">
                       <img width="80px" height="80px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['g_thumb']; ?>">
                 </span>
                    <div class="mousetrap"></div>
                </div>
            </div>
            <div class="zoom-desc"> 
                <div class="jcarousel-prev jcarousel-prev-disabled" style="display: none;"></div>
                <div class="jcarousel-clip" style="height:55px;width:384px;">
                <p> 
                <?php if(is_array($item['g_picarr'])) foreach($item['g_picarr'] AS $imgtu): ?>                
                <label href="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>'">
                <img class="zoom-tiny-image" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" /></label>
                <?php endforeach; ?>           
                </p>
                </div>
            </div>
            <?php if($previous_cgoods): ?>
            <div class="Pro_GetPrize">
                <h2>上期获得者</h2>
                <div class="GetPrize">
                    <dl>
                        <dt>
                            <a rel="nofollow" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $previous_cgoods['id']; ?>" target="_blank">
                                <img width="80" height="80" alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $previous_cgoods['g_thumb']; ?>">
                            </a>
                        </dt>
                        <dd class="gray02">
                            <p>恭喜 <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($previous_cgoods['q_uid']); ?>" target="_blank" class="blue"><?php echo get_user_name($previous_user); ?></a>获得了本商品</p>
                            <p>揭晓时间：<?php echo microt($previous_cgoods['q_end_time'],'r'); ?></p>
                            <p><?php echo L('html.key'); ?>时间：<?php echo microt($preuser_shop_time,'r'); ?></p>
                            <p>幸运<?php echo L('html.key'); ?>码：<em class="orange Fb"><?php echo $previous_cgoods['q_user_code']; ?></em></p>
                        </dd>
                    </dl>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="Pro_Detright">
        <p class="Det_money"><?php echo L('cgoods.value'); ?>：
        <!--显示揭晓动画 start-->
        <?php if(( $item['q_showtime'] == 'Y' )): ?>
        <span> <?php echo sprintf("%.2f",$item['zongrenshu']*$item['price']); ?><?php echo L('cgoods.currency'); ?></span></p>
            <?php include self::includes("index.cgitem_countdown"); ?>
        <?php  else: ?>
        <span> <?php echo $item['g_money']; ?><?php echo L('cgoods.currency'); ?> </span></p>
            <?php include self::includes("index.cgitem_contents"); ?>
        <?php endif; ?> 
        <!--显示揭晓动画 end-->

<script>
$("#btnOpenPeriod").click(function() {
    var ui_obj = $("#divPeriodList > ul");
    if ( $(this).attr("click") == 'off' )
    {
        $("#divPeriodList").css("max-height",ui_obj.length*33+"px");    
        $(this).attr("click","on");
        $(this).html("收起<s></s>");
    }
    else
    {
        $("#divPeriodList").css("max-height","99px");   
        $(this).attr("click","off");
        $(this).html("展开<i></i>");
    }
});
var syrs     = <?php echo $item['zongrenshu']-$item['canyurenshu']; ?>;
var shopinfo = {'shopid':<?php echo $item['id']; ?>,'money':<?php echo $item['price']; ?>,'shenyu':syrs};
var shopnum  = $("#num_dig");
// 添加购买
$(function() {
function baifenshua( aa, n ) {
    n = n || 2;
    return ( Math.round( aa * Math.pow( 10, n + 2 ) ) / Math.pow( 10, n ) ).toFixed( n ) + '%';
}
shopnum.ready( function() {
    if ( shopnum.val() > syrs ) {
        shopnum.val(syrs);
    }   
}); 
shopnum.keyup(function(){
    if ( isNaN(shopnum.val()) ) {
        shopnum.val(1);
    } else {
        if ( shopnum.val() <= 0 ) {
            shopnum.val(1);    
        } 
        if ( shopnum.val() > syrs ) {
            shopnum.val(syrs);
        }
        var numshop = shopnum.val();
        if ( numshop == <?php echo $item['zongrenshu']; ?> ) {
            var baifenbi='100%';
        } else {
            var showbaifen = numshop/<?php echo $item['zongrenshu']; ?>;
            var baifenbi   = baifenshua(showbaifen,2);
        }
        $("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");           
    }
}); 

$("#shopadd").click( function() {
    var shopnum     = $("#num_dig");
    var resshopnump = '';             
    var num         = parseInt(shopnum.val());      
    if ( num + 1 > syrs ) {
        shopnum.val(syrs);
        resshopnump = syrs;
    } else {
        resshopnump = parseInt(shopnum.val())+1;
        shopnum.val(resshopnump);   
        if(shopnum.val()>=syrs){
            resshopnump=shopinfo['shenyu'];
            shopnum.val(resshopnump);
        }
    }
    if ( resshopnump == <?php echo $item['zongrenshu']; ?> )
    {
        var baifenbi = '100%';
    }
    else
    {
        var showbaifen = resshopnump / <?php echo $item['zongrenshu']; ?>;
        var baifenbi = baifenshua( showbaifen, 2 );
    }
    $("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");           
});
        
$("#shopsub").click( function() {
    var shopnum = $("#num_dig");
    var num     = parseInt( shopnum.val() );
    if ( num < 2 )
    {
        shopnum.val(1);         
    }
    else
    {
        shopnum.val( parseInt(shopnum.val())-1 );
    }
    var shopnums = parseInt( shopnum.val() );
    if ( shopnums == <?php echo $item['zongrenshu']; ?> )
    {
        var baifenbi='100%';
    }
    else
    {
        var showbaifen = shopnums / <?php echo $item['zongrenshu']; ?>;
        var baifenbi = baifenshua( showbaifen, 2 );
    }
    $("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");       
});

});

$(function(){
    $(".Det_Cart").click( function() {
        Cartcookie(false);
    });
    $(".Det_Shopbut").click( function() {
        Cartcookie(true);
    }); 
});


function Cartcookie(cook) {
    var info       = {};
    var shopid     = shopinfo['shopid'];
    var cookie_pre = "<?php echo GetConfig('cookie_pre'); ?>";//cookie配置前缀
    var Cartlist   = getCookie( 'Cartlist' );
    if ( ! Cartlist ) {
        var info = {};
    } else {
        var info = eval( '(' + Cartlist + ')' );
        if( (typeof info) !== 'object') {
            var info = {};
        }
    }       
    if ( ! info[shopid] ) {
        var CartTotal=$("#sCartTotal").text();
        $("#sCartTotal").text(parseInt(CartTotal)+1);
        $("#btnMyCart em").text(parseInt(CartTotal)+1);
    }   
    var number             = parseInt($("#num_dig").val());   
    info[shopid]           = {};
    info[shopid]['num']    = number;
    info[shopid]['shenyu'] = shopinfo['shenyu'];
    info[shopid]['money']  = shopinfo['money'];
    info['MoenyCount']     = '0.00';
    setcookie( 'Cartlist', JSON.stringify( info ), 7 );
    if ( cook )
    {
        window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist/"+new Date().getTime();//+new Date().getTime()
    }
    else
    {
        layer.msg( '加入购物车成功！', 2, 1 );
    }
}
</script>                           
                
                <div class="Security">
                    <ul>
                        <li><a ><i></i>100%公平公正</a></li>
                        <li><a ><s></s>100%正品保证</a></li>
                        <li><a ><b></b>全国免费配送</a></li>
                    </ul>
                </div>
                <div class="Pro_Record">
                    <ul id="ulRecordTab" class="Record_tit">
                        <li class="NewestRec Record_titCur">最新<?php echo L('html.key'); ?>记录</li>
                        <li class="MytRec">我的<?php echo L('html.key'); ?>记录</li>
                        <li class="Explain c_red">什么是<?php echo _cfg("web_name_two"); ?>？</li>
                    </ul>
                    <div class="Newest_Con hide" ><!--最新<?php echo L('html.key'); ?>记录-->
                        <ul>
                        <?php if(is_array($cgoods_user_record)) foreach($cgoods_user_record AS $user): ?>
                        <li>
                        <a rel="nofollow" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['ouid']); ?>" target="_blank">
                <?php if(get_user_key($user['ouid'],'img','3030')=='null'): ?>
                <img src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.3030.jpg" border="0" width="20" height="20"></a>
                <?php  else: ?>
                <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($user['ouid']); ?>.3030.jpg" border="0" width="20" height="20"></a>               
                <?php endif; ?>                 
                        </a>                    
                        <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['ouid']); ?>" target="_blank" class="blue"><?php echo get_user_key($user['ouid'],'username'); ?></a>
                        <?php if($user['ur_ip']): ?>
                        (<?php echo get_ip($user['ur_id'],'ipcity'); ?>) 
                        <?php endif; ?>             
                        <?php echo _put_time($user['otime']); ?><?php echo L('html.key'); ?>了
                        <em class="Fb gray01"><?php echo $user['onum']; ?></em>人次</li>
                        <?php endforeach; ?>
                        </ul>
                        <p><a id="btnUserBuyMore" href="javascript:;" class="gray01">查看更多</a></p>
                    </div>
                    <div class="Newest_Con hide" style="display:none;"><!--我的<?php echo L('html.key'); ?>记录-->
                    <?php if($userlogin=login('bool')): ?>                
                    <ul>                
                    <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$cloud_user_recordinfo = $mod_common_cloud_goods->cloud_user_recordID($userlogin['uid'],$item['id'],9); ?>
                    <?php if($cloud_user_recordinfo): ?>
                    <?php if(is_array($cloud_user_recordinfo)) foreach($cloud_user_recordinfo AS $row): ?>                                   
                    <li><?php echo _put_time($row['otime']); ?> <?php echo L('html.key'); ?>了<em class="Fb gray01">  <?php echo $row['onum']; ?></em>  个<?php echo L('html.key'); ?>码</li>                       
                    <?php endforeach; ?> 
                    <?php  else: ?>
                    <div class="My_RecordReg">
                        <b class="gray01">看不到？您还没有购买该商品哟，去试试吧！</b>              
                    </div>                  

                    <?php endif; ?>
                    </ul>
                    <?php  else: ?>                   
                    <div class="My_RecordReg">
                        <b class="gray01">看不到？是不是没登录或是没注册？ 登录后看看</b>
                        <a href="<?php echo WEB_PATH; ?>/member/user/login" class="My_Signbut">登录</a><a href="<?php echo WEB_PATH; ?>/member/user/register" class="My_Regbut">注册</a>
                    </div>
                    <?php endif; ?>                 
                    </div>
                    <div class="Newest_Con hide" style="display:none;"><!--什么是一元夺宝？-->
                        <p class="MsgIntro"><?php echo _cfg("web_name_two"); ?>购是指只需一元就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份一元，当一件商品所有“等份”售出后，根据夺宝规则产生一名幸运者，该幸运者即可获得此商品。</p>
                        <p class="MsgIntro1"><?php echo _cfg("web_name_two"); ?>以“快乐夺宝，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。<a href="<?php echo WEB_PATH; ?>/article-1.html" class="blue" target="_blank">查看详情&gt;&gt;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<!--商品详情 开始-->
<div class="ProductTabNav w1200 mt10">
    <div id="divProductNav" class="DetailsT_Tit">
        <div class="DetailsT_TitP">
            <ul>
                <li class="Product_DetT DetailsTCur"><span class="DetailsTCur">商品详情</span></li>
                <li id="liUserBuyAll" class="All_RecordT"><span class="">所有参与记录</span></li>
                <li class="Single_ConT"><span class="">晒单</span></li>
            </ul>
        </div>
    </div>
    <div id="divContent" class="Product_Content">
        <!--商品详情 开始-->
        <div class="Product_Con"><?php echo $item['g_content']; ?></div>
        <!-- 商品详情 结束 -->
        <!-- 购买记录20条 -->
        <div id="bitem" class="AllRecordCon hide" style="display:none;">
            <iframe id="iframea_bitem" g_src="<?php echo WEB_PATH; ?>/index/cloud_goods/go_record_iframe/<?php echo $item['id']; ?>/20" style="width:978px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>        
        </div>  
       <!-- /购买记录20条 -->
        
        <!-- 晒单 -->
        <div id="divPost" class="Single_Content">
            <iframe id="iframea_divPost" g_src="<?php echo WEB_PATH; ?>/index/share/share_iframe/<?php echo $item['id']; ?>" style="width:978px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>
        </div>
        <!-- 晒单 -->       
    </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/cloud-zoom.min.js"></script>
<script type="text/javascript">

function set_iframe_height(fid,did,height){ 
    $("#"+fid).css("height",height);    
}

$(function(){
    $("#ulRecordTab li").click(function(){
        var add=$("#ulRecordTab li").index(this);
        $("#ulRecordTab li").removeClass("Record_titCur").eq(add).addClass("Record_titCur");
        $(".Pro_Record .hide").hide().eq(add).show();
    });
    
    var DetailsT_TitP = $(".DetailsT_TitP ul li");
    var divContent    = $("#divContent div");   
    DetailsT_TitP.click(function(){
        var index = $(this).index();
        DetailsT_TitP.removeClass("DetailsTCur").eq(index).addClass("DetailsTCur");

        var iframe = divContent.hide().eq(index).find("iframe");
        if (typeof(iframe.attr("g_src")) != "undefined") {
             iframe.attr("src",iframe.attr("g_src"));
             iframe.removeAttr("g_src");
        }
        divContent.hide().eq(index).show();
    });
    
    
    $("#btnUserBuyMore").click(function(){
        DetailsT_TitP.removeClass("DetailsTCur").eq(1).addClass("DetailsTCur");
        DetailsT_TitP.removeClass("DetailsTCur").eq(1).addClass("DetailsTCur");
            var iframe = divContent.hide().eq(1).find("iframe");
            if (typeof(iframe.attr("g_src")) != "undefined") {
                 iframe.attr("src",iframe.attr("g_src"));
                 iframe.removeAttr("g_src");
            }
        divContent.hide().eq(1).show();
        $("html,body").animate({scrollTop:930},1500);
        //$("#divProductNav").addClass("nav-fixed");
    });
    $(window).scroll(function(){
        if($(window).scrollTop()>=941){
            $("#divProductNav").addClass("nav-fixed");
        }else if($(window).scrollTop()<941){
            $("#divProductNav").removeClass("nav-fixed");
        }
    });
})
</script>
<?php include self::includes("index.footer"); ?>