<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/AutoLottery.css"/>
<div class="limit-banner">
    <p>
        <img src="<?php echo G_TEMPLATES_IMAGE; ?>/atuo_01.gif" border="0" alt="">
        <a href="#regular" class="ExplainA"></a>
    </p>
</div>
<div class="auto-nav">
    <ul>
        <li id="liTimerHead" class="fl autoCur">今天揭晓 <em>(<?php echo $jinri_time; ?>)</em></li>
        <li id="liWillHead" class="fr">明天限时 <em>(<?php echo $minri_time; ?>)</em></li>
    </ul>
</div>

<script>
$(function(){
    $(".auto-nav li").click(function(){
        var id=$(".auto-nav li").index(this);
        $(".auto-nav li").removeClass("autoCur").eq(id).addClass("autoCur");
        $(".autoCon .showCon").hide().eq(id).show();
    });
    
});

$(function(){
    $("li[name='normalItem']").hover(function(){
        $(this).addClass("autolistCur");
    },function(){
        $(this).removeClass("autolistCur");
    });
    $(".jinrishop").eq(3).addClass("autolist-R");
    $(".minrishop").eq(3).addClass("autolist-R");
});

</script>
<script>
function lxfEndtime(objlist,len,thistimes){      
          for(var i in objlist){
                var endtime = objlist[i]['endtimeto'];
                var nowtime = thistimes;        //今天的日期(毫秒值)
                var youtime = endtime - nowtime;        //还有多久(毫秒值)              
                var seconds = youtime/1000;
                var minutes = Math.floor(seconds/60);
                var hours = Math.floor(minutes/60);
                var days = Math.floor(hours/24);
                var CDay = days;
                var CHour= hours % 24;
                var CMinute= minutes % 60;
                var CSecond= Math.floor(seconds%60);//"%"是取余运算，可以理解为60进一后取余数，然后只要余数。
                objlist[i]['obj'].html("<span></span>剩余<em>"+CHour+"</em>时<em>"+CMinute+"</em>分<em>"+CSecond+"</em>秒");                
                delete youtime,seconds,minutes,hours,days,CDay,CHour, CMinute, CSecond;
                if( endtime <= nowtime ){
                    delete endtime, nowtime;            
                    objlist[i]['obj'].html("<b>限时揭晓</b>&nbsp;&nbsp;正在计算中....");//如果结束日期小于当前日期就提示过期啦                  
                    $.post("<?php echo WEB_PATH; ?>"+"plugin-CloudWay-autoway",{"shopid":objlist[i]['shopid']},function(data){
                        if(data == '-1'){
                             objlist[i]['obj'].html("&nbsp;没有这个商品!");                     
                        }
                        if(data == '-2'){
                            objlist[i]['obj'].html("&nbsp;商品揭晓失败!");                  
                        }
                        if(data == '-3'){                           
                             objlist[i]['obj'].html("&nbsp;参与人数为0,不予揭晓!");                     
                        }
                        if(data == '-4'){
                             objlist[i]['obj'].html("&nbsp;商品还未到揭晓时间!");                   
                        }
                        if(data == '-5'){
                             objlist[i]['obj'].html("&nbsp;商品揭晓时间已过期!");                       
                        }
                        if(data == '-6'){                           
                             objlist[i]['obj'].html("&nbsp;商品正在揭晓中!");                       
                        }
                        if(data.length > 2){                            
                             objlist[i]['obj'].html("&nbsp;幸运码1是:"+data);                       
                        }                       
                        delete objlist[i];
                        return;
                    }); 
                }           
                
          }//for          
    setTimeout(function(){
        thistimes += 1000;
        lxfEndtime(objlist,objlist.length,thistimes);                                          
    },1000);
 }//fun
  
  
$(function(){
    $.ajaxSetup({
        async : false
    });
    var divlist = $(".timeall");
    var divarr  = new Array();

        divlist.each(function(i,v){
            divarr[i] = new Array();
            divarr[i]['obj'] = $(this);
            divarr[i]['endtimeto'] = $(this).attr("endtimeto");
            divarr[i]['shopid']=$(this).attr("shopid");
        });
        
    divlist = null; 
    lxfEndtime(divarr,divarr.length,<?php echo time(); ?>000);
});
</script>
<div class="autoCon">
    <div id="divTimerItems" class="showCon" style="display:block;">
        <ul>            
            <?php if(is_array($jinri_shoplist)) foreach($jinri_shoplist AS $shop): ?>
            <?php if($shop['q_user_code'] && $shop['q_showtime'] == 'N'): ?>          
            <li class="autolist autolistEnd jinrishop">         
                <div class="syTimeEnd">已揭晓</div>
                <div class="jxTime"><?php echo $shop['time_H']; ?>点揭晓</div>
                <div class="autolistC">
                    <div class="pic">
                        <a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $shop['id']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"></a>
                    </div>
                    <p class="name"><a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $shop['id']; ?>" target="_blank">(第<?php echo $shop['qishu']; ?>期)<?php echo $shop['g_title']; ?></a></p>
                    <p class="money">价值：<span class="rmb"><?php echo $shop['g_money']; ?></span></p>
                    <div class="Progress-bar">
                        <p><span style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],100); ?>%;"></span></p>
                        <ul class="Pro-bar-li">
                            <li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
                            <li class="P-bar02"><em id="Em1"><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                            <li class="P-bar03"><em id="Em2"><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
                        </ul>
                    </div>                  
                </div>
            
                <div class="listEndInfo">
                    <div class="uInfo">
                    <a class="fl" rel="nofollow" href="<?php echo WEB_PATH; ?>/uname/<?php echo $shop['q_uid']; ?>" target="_blank">
                        <img border="0" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($shop['q_uid'],'img'); ?>" alt="">
                    </a>
                    <p>恭喜<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($shop['q_uid']); ?>" target="_blank"><?php echo get_user_name($shop['q_uid']); ?></a>获得<br>幸运夺宝码：<span class="orange"><?php echo $shop['q_user_code']; ?></span><br>揭晓时间：<span>
                <?php echo date("Y-m-d H:i:s",$shop['q_end_time']); ?>.000
                </span></p></div></div>        
            </li>
            <?php  else: ?>
            <li name="normalItem" class="autolist jinrishop">
                <div name="timerItem"  class="AnnTime10 syTime timeall" shopid="<?php echo $shop['id']; ?>" endtimeto="<?php echo $shop['xsjx_time']; ?>000" lxfday="no"></div>
                <div class="jxTime"><?php echo $shop['time_H']; ?>点揭晓</div>
                <div class="autolistC">
                    <div class="pic">
                        <a rel="nofollow" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"></a></div>
                    <p class="name">
                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>"  target="_blank">(第<?php echo $shop['qishu']; ?>期)<?php echo $shop['g_title']; ?></a></p>
                    <p class="money">
                        价值：<span class="rmb"><?php echo $shop['g_money']; ?></span></p>
                    <div class="Progress-bar">
                        <p><span style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],100); ?>%;"></span></p>
                        <ul class="Pro-bar-li">                 
                            <li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
                            <li class="P-bar02"><em id="Em1"><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                            <li class="P-bar03"><em id="Em2"><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
                        </ul>
                    </div>
                    <?php if($shop['zongrenshu']==$shop['canyurenshu']): ?>
                    <div class="ashowM"> <a class="nowBtnEnd">已结束</a> </div>
                    <?php  else: ?>
                    <div class="ashowM"><a class="nowBtn" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">立即参与</a></div>
                    <?php endif; ?>
                </div>              
            </li>                
            <?php endif; ?>
            <?php endforeach; ?>
            </ul> 
    </div>
           
    <div id="divWillItems" class="showCon hidden" style="display: none;">
        <ul>        
            <?php if(is_array($minri_shoplist)) foreach($minri_shoplist AS $shop): ?>
            <li class="autolist minrishop" style="padding-top:3px;">
                <div class="jxTime"><?php echo $shop['time_H']; ?>点揭晓</div>
                <div class="autolistC">
                    <div class="pic"><a rel="nofollow" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"></a></div>
                    <p class="name">
                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">(第<?php echo $shop['qishu']; ?>期)<?php echo $shop['g_title']; ?></a></p>
                    <p class="money">
                        价值：<span class="rmb"><?php echo $shop['g_money']; ?></span></p>
                    <div class="Progress-bar">
                        <p><span style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],100); ?>%;"></span></p>
                        <ul class="Pro-bar-li">
                         <li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
                            <li class="P-bar02"><em id="Em1"><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                            <li class="P-bar03"><em id="Em2"><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
                        </ul>
                    </div>
                    <div class="ashowM"><a class="nowBtn"  href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">立即参与</a></div>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="autoOld">
        <p class="dsjx">
            往期回顾</p>
        <span class="autoOldMore"><a href="<?php echo WEB_PATH; ?>/autolottery" target="_blank">更多 <em>&gt;&gt;</em></a></span>
        <div class="autoOldC">
            
                    <?php if(is_array($endshoplist)) foreach($endshoplist AS $eshop): ?>
                    <ul class="autoOldlist">
                        <li class="pInfo">
                            <dt><a rel="nofollow" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $eshop['id']; ?>" target="_blank">
                                <img border="0" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $eshop['g_thumb']; ?>" alt="<?php echo $eshop['g_title']; ?>"></a></dt>
                            <dt class="title"><a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $eshop['id']; ?>" target="_blank">
                                <?php echo $eshop['g_title']; ?></a></dt>
                            <dd>
                                <p class="Det_money">
                                价值：<span class="rmbgray"><?php echo sprintf("%.2f",$eshop['zongrenshu']*$eshop['price']); ?></span></p>
                            </dd>
                            <i></i></li>
                        <li class="pro-barw">
                        <div class="Progress-bar">
                            <p><span style="width:100%;"></span></p>
                            <ul class="Pro-bar-li">
                             <li class="P-bar01"><em><?php echo $eshop['canyurenshu']; ?></em>已参与人次</li>
                                <li class="P-bar02"><em id="Em1"><?php echo $eshop['zongrenshu']; ?></em>总需人次</li>
                                <li class="P-bar03"><em id="Em2"><?php echo $eshop['zongrenshu']-$eshop['canyurenshu']; ?></em>剩余人次</li>
                            </ul>
                        </div>
                        </li>
                        <li class="uInfo">
                            <dt><a rel="nofollow" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($eshop['q_uid']); ?>" target="_blank">
                                <img border="0" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($eshop['q_uid'],'img'); ?>"></a></dt>
                            <dt class="uget">恭喜<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($eshop['q_uid']); ?>" target="_blank"><?php echo get_user_name($eshop['q_uid']); ?></a>获得<br>
                                幸运夺宝码：<span class="orange"><?php echo $eshop['q_user_code']; ?></span><br>
                                揭晓时间：<span><?php echo date("Y-m-d H",$eshop['q_end_time']); ?></span></dt>
                        </li>
                    </ul>           
                    <?php endforeach; ?>
                
        </div>
    </div>
    <div class="autoRule">
        <a name="regular" id="regular"></a>
        <p class="dsjx">
            限时揭晓规则</p>
        <div class="autoOldC">
            <ul>
                <li>1、取码： 取出所有用户的夺宝码(只要参与了本期奖品，所有夺宝码都会拿到系统中运算)</li>
                <li>2、运算： 随机生成夺宝码(系统会用随机算法全部打乱数据，重新洗牌，最后随机抽取一个幸运码) </li>
                <li>3、结果： 将随机抽取的幸运码公示出来</li>
            </ul>
        </div>
    </div>
</div>
<?php include self::includes("index.footer"); ?>