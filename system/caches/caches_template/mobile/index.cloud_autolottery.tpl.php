<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("jquery.pageDialog"); ?>
<?php echo js("jquery.cartlist"); ?>
<?php echo js("jquery.BusyTime"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"限时揭晓",
        "Home":true,
        "Member":false,
        "Shop":true
    }); 
</script>
<nav class="limit-nav">
    <ul>
        <li class="limit-navCur" onclick="">今日揭晓</li>
        <li class="" onclick="">明日限时</li>
    </ul>
</nav>
    <div class="h5-1yyg-w310">
        <!-- 焦点图 -->
        <input name="hdStartAt" type="hidden" id="hdStartAt" value="0" />
        <section class="flexbox clearfix limit-ct"> 
        <article id="autoLotteryBox" class="clearfix limit-content">
    <ul id="divTimerItems" class="slides">
        <?php if(count($jinri_shoplist)>1): ?>
        <div class="loading" style="background:#F4F4F4">
            <b>
            </b>
            正在加载
        </div>
        <?php  else: ?>
         <?php if(count($jinri_shoplist)==0 ): ?>
         <div id="divNone" class="haveNot z-minheight" style="display:block"><s></s><p><?php echo $home_title; ?></p>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php if(is_array($jinri_shoplist)) foreach($jinri_shoplist AS $shop): ?>  
        <?php if($shop['xsjx_time'] < time()): ?>     
         <li class="m-xs-li" txt="<?php echo abs(date('H',$shop['xsjx_time'])); ?>点">
            <div class="m-round limit-bd limit-End">
                <div class="f-limit-time">
                    <span class="f-limit-time-date">已揭晓</span>
                </div>
                <div class="limt-pic">
                    <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>">
                        <img border="0" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"
                        />
                    </a>
                </div>
                <div class="limit-bd-con">
                    <p class="z-limit-tt">
                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" class="gray6 z-tt">
                            (第<?php echo $shop['qishu']; ?>期)<?php echo $shop['g_title']; ?>
                        </a>
                    </p>
                    <p class="z-promo">
                        价值:<em class="gray9">￥<?php echo $shop['g_money']; ?></em>
                    </p>
                    <div class="Progress-bar">
                        <p class="u-progress" title="已完成<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],100); ?>%">
                            <span class="pgbar" style="width:width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],100); ?>%;">
                                <span class="pging">
                                </span>
                            </span>
                        </p>
                        <ul class="Pro-bar-li">
                            <li class="P-bar01">
                                <em><?php echo $shop['canyurenshu']; ?></em>已参与
                            </li>
                            <li class="P-bar02">
                                <em><?php echo $shop['zongrenshu']; ?></em>总需人次
                            </li>
                            <li class="P-bar03">
                                <em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix gray9 limit-user">
                    <a class="fl z-Limg" href="location.href='<?php echo WEB_PATH; ?>/uname/<?php echo idjia($shop['q_uid']); ?>">
                        <s></s>
                        <img border="0" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($shop['q_uid'],'img'); ?>">
                    </a>
                    <p>
                        恭喜<span class="z-user blue" onclick="location.href='<?php echo WEB_PATH; ?>/uname/<?php echo idjia($shop['q_uid']); ?>'"><?php echo get_user_name($shop['q_uid']); ?></span>获得
                    </p>
                    <p class="m-limit-Code">幸运夺宝码：<em class="orange"><?php echo $shop['q_user_code']; ?></em>
                    </p>
                    <p>
                        夺宝人次：<?php echo $user_shop_number[$shop['q_uid']][$shop['id']]; ?>
                    </p>
                </div>
            </div>
        </li>
        <?php  else: ?>
        <li class="m-xs-li " txt="<?php echo $shop['time_H']; ?>点">
            <div class="m-round limit-bd ">
                <div name="timerItem" class="f-limit-time" time="{wc:$shop['xsjx_time']-time()}"  >
                    <span class="f-limit-time-date timeall"  shopid="<?php echo $shop['id']; ?>" endtimeto="<?php echo $shop['xsjx_time']; ?>000" lxfday="no">
                        <b>剩余时间</b><em>00</em>时<em>00</em>分<em>00</em>秒
                    </span>
                </div>
                <div class="limt-pic">
                    <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>">
                        <img border="0" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"/>
                    </a>
                </div>
                <div class="limit-bd-con">
                    <p class="z-limit-tt">
                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" class="gray6 z-tt">
                            (第<?php echo $shop['qishu']; ?>期)<?php echo $shop['g_title']; ?>
                        </a>
                    </p>
                    <p class="z-promo">价1值:<em class="gray9">￥<?php echo $shop['g_money']; ?></em>
                    </p>
                        <div class="Progress-bar">
                            <p class="u-progress">
                                <span class="pgbar" style="width:<?php echo intval(width($shop['canyurenshu'],$shop['zongrenshu'],100)); ?>%;">
                                    <span class="pging"></span>
                                </span>
                            </p>
                            <ul class="Pro-bar-li">
                                <li class="P-bar01">
                                    <em><?php echo $shop['canyurenshu']; ?></em>已参与</li>
                                <li class="P-bar02">
                                    <em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                                <li class="P-bar03">
                                    <em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</li>
                            </ul>
                        </div>
                </div>
                <div class="u-Btn">
                   <?php if($shop['canyurenshu']==$shop['zongrenshu']): ?>
                    <div class="u-Btn-li">
                        <a class="grayBtn">
                            下手慢了！！ 被抢光啦！！
                        </a>
                    </div>
                    <?php  else: ?>

                    
              <div id="btnBuyBox" class="pBtn" >
                <a href="javascript:;" class="fl buyBtn Det_Shopbut" price="<?php echo $shop['price']; ?>" shopid="<?php echo $shop['id']; ?>" syrs="$shop['zongrenshu']-$shop['canyurenshu']" ><?php echo L('cgoods.go'); ?></a>
                <a href="javascript:;" id="car_<?php echo $shop['id']; ?>" class="fr addBtn"  onclick="gcartlist.gocartlist(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>','<?php echo GetConfig('cookie_pre'); ?>')"><?php echo L('cgoods.cartlist'); ?></a>
              </div>                    
                    
                    <?php endif; ?>
                </div>
            </div>
        </li>
       <?php endif; ?>
       <?php endforeach; ?>
    </ul>
</article>
        
    <article class="clearfix mt10 m-round limit-tips">
        <h3>限时揭晓规则</h3>
        <div class="limit-tips-ct">
            <p><s></s><b>1、取码： 取出所有用户的夺宝码(只要参与了本期奖品，所有夺宝码都会拿到系统中运算)</b></p>
            <p><s></s><b>2、运算： 随机生成夺宝码(系统会用随机算法全部打乱数据，重新洗牌，最后随机抽取一个幸运码) </b></p>
            <p><s></s><b>3、结果： 将随机抽取的幸运码公示出来</b></p>
        </div>
    </article>
</section>
<script>
var syrs='';
var shopid='';
var price='';
var shopinfo={'shopid':shopid,'money':price,'shenyu':syrs};
$(function(){
    $(".Det_Shopbut").click(function(){ 
        var syrs=$(this).attr("syrs");;
        var shopid=$(this).attr("shopid");
        var price=$(this).attr("price");
        console.log(syrs+shopid+price);
        var shopinfo={'shopid':shopid,'money':price,'shenyu':syrs}; 
        Cartcookie(true);
    }); 
});


function Cartcookie(cook){
    var info = {};
    var shopid=shopinfo['shopid'];
    var cookie_pre="<?php echo GetConfig('cookie_pre'); ?>";//cookie配置前缀
    var Cartlist = $.cookie(cookie_pre+'Cartlist');
    if(!Cartlist){
        var info = {};
    }else{
        var info = $.evalJSON(Cartlist);
        if((typeof info) !== 'object'){
            var info = {};
        }
    }       
    if(!info[shopid]){
        var CartTotal=$("#sCartTotal").text();
            $("#sCartTotal").text(parseInt(CartTotal)+1);
            $("#btnMyCart em").text(parseInt(CartTotal)+1);
    }   
    var number=1;   
    info[shopid]={};
    info[shopid]['num']=number;
    info[shopid]['shenyu']=shopinfo['shenyu'];
    info[shopid]['money']=shopinfo['money'];
    info['MoenyCount']='0.00';
    $.cookie(cookie_pre+'Cartlist',$.toJSON(info),{expires:7,path:'/'});    
    if(cook){
        window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist/"+new Date().getTime();//+new Date().getTime()
    }
}
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

<?php include self::includes("index.footer"); ?>

