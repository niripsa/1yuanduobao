<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<div class="clear"></div>
<div class="wrap w1200">
    <div class="Current_nav w1200">
        <a href="<?php echo WEB_PATH; ?>">首页</a> &gt; 
        <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $item['g_cateid']; ?>_0_0"><?php echo $model_title['cate_name']; ?></a> &gt;
        <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $item['g_cateid']; ?>_<?php echo $item['g_brandid']; ?>_0">  <?php echo $model_title['brand_name']; ?></a> &gt;
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
            </p>
            <div class="Pro_Detleft">
                <div class="zoom-small-image"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['g_thumb']; ?>" width="400"height="400"></div>
                <div class="Result_LConduct">
                    <dl>
                        <dt><span>第<?php echo $item['qishu']; ?>期</span>已经揭晓</dt>
                        <dd>
                            <div class="Result_Progress-bar">
                                <p><span style="width:208px;"></span></p>
                                <ul class="Pro-bar-li">
                                    <li class="P-bar01"><em class="c_red"><?php echo $item['canyurenshu']; ?></em>已参与人次</li>
                                    <li class="P-bar02"><em><?php echo $item['zongrenshu']; ?></em>总需人次</li>
                                    <li class="P-bar03"><em><?php echo $item['shenyurenshu']; ?></em>剩余人次</li>
                                </ul>
                            </div>
                           <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$lastone = $mod_common_cloud_goods->cloud_goodslastone($item['gid']); ?> 
                            <p class="fl"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $lastone['id']; ?>"  target="_blank"  class="Result_LConductBut bg_red b_red">最新一期</a></p>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="Pro_Detright">
                <p class="Det_money">价值：<span class=""><?php echo sprintf("%.2f",$item['zongrenshu']*$item['price']); ?></span><?php echo L('cgoods.currency'); ?></p>
                <div class="Announced_Frame">
                    <div class="Announced_FrameT">揭晓结果</div>
                    <div class="Announced_FrameCode">
                        <ul class="Announced_FrameCodeMal"> 
                        <?php if(is_array($q_user_code_arr)) foreach($q_user_code_arr AS $q_code_num): ?>
                        <li class="Code_<?php echo $q_code_num; ?>"><?php echo $q_code_num; ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="Announced_FrameGet">
                        <dl>
                            <dd class="gray02 fl">
                                <p>恭喜<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($item['q_uid']); ?>" target="_blank" class="blue"><?php echo get_user_name($q_user); ?></a> 获得本期商品</p>
                                <p>揭晓时间：<?php echo microt($item['q_end_time'],'r'); ?></p>
                                <p><?php echo L('html.key'); ?>时间：<?php echo microt($user_shop_time,'r'); ?></p>
                            </dd>
                        </dl>
                    </div>
                    <!--补丁3.1.5_b.0.1-->  
                    <div class="Announced_FrameBut">
                        <a href="javascript:;" class="Announced_But">本期详细计算结果</a>
                        <a href="javascript:;" class="Announced_But">看看有谁参与了</a>
                        <a href="javascript:;" class="Announced_But">看看有谁晒单</a>
                    </div>
                    <!--补丁3.1.5_b.0.1-->  
                    <div class="Announced_FrameBm"></div>
                </div>
                <div class="MaCenter">
                    <p>商品获得者本期总共<?php echo L('html.key'); ?>了<em class="c_red"><?php echo $user_shop_number; ?></em>人次</p>
                    <div id="userRnoId" class="MaCenterH">
                        <dl>
                            <dt><?php echo microt($user_shop_time,'r'); ?></dt>
                            <dd>
                            <?php echo yunma($user_shop_codes,"b"); ?>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div id="divOpen" class="MaOff"><span>展开查看全部<s></s></span></div>
            </div>
        </div>
    </div>
</div>


<!-- 计算结果 所有参与记录 晒单 -->
<div id="calculate" class="ProductTabNav">
    <div id="divMidNav" class="DetailsT_Tit">
        <div class="DetailsT_TitP">          
            <ul>
                <li class="Product_DetT DetailsTCur"><span class="DetailsTCur">计算结果</span></li>
                <li class="All_RecordT"><span class="">所有参与记录</span></li>
                <li class="Single_ConT"><span class="">晒单</span></li>          
            </ul>
        </div>
    </div>
</div>
    
<!--商品详情 开始-->   
<div id="divCalResult" class="Product_Content"> 
    <div class="ygRecord" name="div_tab">

        <?php if(!$item['q_content']): ?>
        <div class="RecordOnehundred"><h4> 计算结果算法 </h4>
            <div class="ResultBox bg_red"><h2>计算结果</h2>
                <p class="num4">取码：
                    <span class="Fb">取出所有用户的夺宝码</span>(只要参与了本期奖品，所有夺宝码都会拿到系统中运算)<br>运算：
                    <span class="Fb">随机生成夺宝码</span>(系统会用随机算法全部打乱数据，重新洗牌，最后随机抽取一个幸运码)
                    <br>结果：
                    <em>将随机抽取的幸运码公示出来</em></span>
                </p>
                <b class="bg_yellow c_red">最终结果：<?php echo $item['q_user_code']; ?></b>
            </div>
            <div style="width:100%;height:30px;clear:bolt;"></div>
        </div>
        <?php  else: ?>
            <ul class="Record_title">
                <li class="time"><?php echo L('html.key'); ?>时间</li>
                <li class="nem">会员账号</li>
                <li class="name">商品名称</li>
                <li class="much"><?php echo L('html.key'); ?>人次</li>
            </ul>
            <div class="RecordOnehundred"><h4>截止该商品揭晓购买时间【<?php echo date("Y-m-d H:i:s",$item['q_end_time']).".".substr($item['q_end_time'],0,3); ?>】最后100条全站购买时间记录</h4>
            <div class="FloatBox b_red2"></div> 
               <?php if(is_array($item['q_content'])) foreach($item['q_content'] AS $record): ?> 
               <ul class="Record_content bb_pink">
                    <li class="time"><b><?php echo date("Y-m-d",$record['otime']); ?></b><?php echo date("H:i:s",$record['otime']); ?>.<?php echo $record['otime0']; ?></li>
                    <li class="timeVal"><?php echo $record['otime_add']; ?></li>
                    <li class="nem"><a class="gray02" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($record['ouid']); ?>" target="_blank"><?php echo get_user_name($record['ouid']); ?></a></li>
                    <li class="name"><a class="gray02" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $record['ogid']; ?>" target="_blank">（第<?php echo $record['oqishu']; ?>期）<?php echo $record['g_title']; ?></a></li>
                    <li class="much"><?php echo $record['onum']; ?>人次</li>
                </ul>   
                <?php endforeach; ?>
            </div>           
        <div class="RecordOnehundred"><h4> 100条计算结果 </h4>
            <div class="ResultBox bg_red"><h2>计算结果</h2>
                <p class="num4">求和：
                    <span class="Fb"><?php echo $item['q_counttime']; ?></span>(上面100条<?php echo L('html.key'); ?>记录时间取值相加之和)<br>取余：
                    <span class="Fb"><?php echo $item['q_counttime']; ?></span>(100条时间记录之和)
                    <span class="Fb"> % <?php echo $item['canyurenshu']; ?></span>(本商品总需参与人次)
                    <span class="Fb"> =  <?php echo $item['shop_fmod']; ?></span>(余数)<br>结果：
                    <span class="Fb"><?php echo $item['shop_fmod']; ?></span>(余数)
                    <span class="Fb"> + 10000001 = <em><?php echo $item['q_user_code']; ?></em></span>
                </p>
                <b class="bg_yellow c_red">最终结果：<?php echo $item['q_user_code']; ?></b>
            </div>
            <div style="width:100%;height:30px;clear:bolt;"></div>
        </div>                          
        <?php endif; ?>
    </div><!--计算结果 结束-->
</div>
    
<div id="divContent" class="Product_Content">
    <!-- 购买记录20条 -->
    <div name="div_tab" id="bitem" class="AllRecordCon hide" style="display:none;">
        <iframe id="iframea_bitem" g_src="<?php echo WEB_PATH; ?>/index/cloud_goods/go_record_iframe/<?php echo $item['id']; ?>/20" style="width:1100px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>       
    </div>  
   <!-- /购买记录20条 -->
    
    <!-- 晒单 -->
    <div name="div_tab" id="divPost"   class="Single_Content" style="display:none;">
        <iframe id="iframea_divPost" g_src="<?php echo WEB_PATH; ?>/index/share/share_iframe/<?php echo $item['id']; ?>" style="width:1100px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>
    </div>
    <!-- 晒单 -->       
</div>
</div>
<script>
$("#btnOpenPeriod").click( function() {
    var ui_obj = $("#divPeriodList > ul");
    if ( $(this).attr("click") == 'off' ) {
        $("#divPeriodList").css("max-height",ui_obj.length*33+"px");    
        $(this).attr("click","on");
        $(this).html("收起<s></s>");
    } else {
        $("#divPeriodList").css("max-height","99px");   
        $(this).attr("click","off");
        $(this).html("展开<i></i>");
    }
});

function set_iframe_height( fid, did, height ) {
    $("#"+fid).css("height",height);
}

$(function(){
var fouli = $(".DetailsT_TitP ul li");
var divCalResult = $("div[name='div_tab']");
fouli.click( function() {
    var index = fouli.index(this);
    fouli.removeClass("DetailsTCur").eq(index).addClass("DetailsTCur");
    var iframe = divCalResult.hide().eq(index).find("iframe");
    if ( typeof(iframe.attr("g_src")) != "undefined" ) {
        iframe.attr("src",iframe.attr("g_src"));
        iframe.removeAttr("g_src");
    }
    divCalResult.hide().eq(index).show();
});
<!--补丁3.1.6_b.0.3-->
    

    $(".Announced_But").click(function() {
        var next_li = $(".DetailsT_TitP ul>li");
        var index = $(this).index()
        next_li.eq(index).click();
        $("html,body").animate({scrollTop:800},1500);
    });

    
    $(window).scroll( function() {
        if ( $(window).scrollTop() >= 941 ) {
            $("#divMidNav").addClass("nav-fixed");
        } else if ( $(window).scrollTop() < 941 ) {
            $("#divMidNav").removeClass("nav-fixed");
        }
    });
});
function divOpen() {
var height = $("#userRnoId").css("height");
    if ( height == "90px" ) {
        $("#userRnoId").css("height","auto");
    } else {
        $("#userRnoId").css("height",90);
    };
}
$(function() {   
    $("#divOpen").click(divOpen);
});
</script>
<?php include self::includes("index.footer"); ?>