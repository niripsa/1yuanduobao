<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<!--商品 wrap 开始-->
<div class="wrap w1200"style="overflow:hidden;margin-top:5px;">
    <div class="Current_nav"><a href="">首页</a> &gt; 最新揭晓</div>
    <div class="W-left fl" style="padding:0;width:938px">
        <div id="current" class="publish_Curtit">
            <h1 class="fl c_red">最新揭晓</h1>
            <span id="spTotalCount">(到目前为止共揭晓商品<em class="c_red"><?php echo $total; ?></em>件)</span>
        </div>
        <div class="publishBor">
            <div class="publishCen">
                <ul id="b_pink">
                <?php if(is_array($cglotterylist)) foreach($cglotterylist AS $lotterylist): ?>
                    <li class="Cursor b_pink">
                        <a class="fl goodsimg" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $lotterylist['id']; ?>" target="_blank">
                        <img alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $lotterylist['g_thumb']; ?>">
                        </a>
                        <div class="publishC-Member gray02">
                            <a class="fl headimg" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($lotterylist['q_uid']); ?>" target="_blank">
                            <?php if(get_user_key($lotterylist['q_uid'],'img','8080')=='null'): ?>
                            <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" border="0">
                            <?php  else: ?>
                            <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($lotterylist['q_uid']); ?>.8080.jpg" width="50" height="50" border="0">
                            <?php endif; ?>                                                     
                            </a>
                            <p>获得者：<a class="blue Fb" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($lotterylist['q_uid']); ?>" target="_blank"><?php echo get_user_name($lotterylist['q_user']); ?></a></p>
                            <p>夺宝：<em class="c_red Fb"><?php echo $lotterylist['onum']; ?></em>人次</p>                            
                        </div>
                        <div class="publishC-tit">
                            <h3><a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $lotterylist['id']; ?>" target="_blank" class="gray01">(第<?php echo $lotterylist['qishu']; ?>期)<?php echo $lotterylist['g_title']; ?></a></h3>
                            <p class="money">商品价值：<span class="rmb"><?php echo sprintf("%.2f",$lotterylist['zongrenshu']*$lotterylist['price']); ?></span><?php echo L('cgoods.currency'); ?></p>
                            <p class="Announced-time gray02">揭晓时间：<?php echo microt($lotterylist['q_end_time'],'r'); ?></p>
                        </div>
                        <div class="details bg_pink">
                            <p class="fl details-Code">幸运夺宝码：<em class="c_red Fb"><?php echo $lotterylist['q_user_code']; ?></em></p>
                            <a class="fl details-A c_red" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $lotterylist['id']; ?>" rel="nofollow" target="_blank">查看详情</a>
                        </div>
                    </li>               
                <?php endforeach; ?>               
                </ul>
<!---正在倒计时--->                 
<script>
 var APP = {
      WEB_PATH : '<?php echo WEB_PATH; ?>',
      G_WEB_PATH : '<?php echo G_WEB_PATH; ?>',
      G_PARAM_URL : '<?php echo G_PARAM_URL; ?>'
    };      
</script>       
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery.BusyTime.js"></script>    
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery.cmsapi.js"></script>  
<style>
.busytime i{
    color: #fff;
    font-size: 15px;
    line-height: 30px;
    background: #ca1b38;
    border-radius: 3px;
    padding: 5px;
}
.b_pink span.shi {
width: 75px;
height: 20px;
float: left;
font-size: 16px;
font-weight: bold;
color: #ca1b38;
font-family: "宋体";
}
</style>
<script>
$.YunCmsApi.Loop({
    "timer"   : 15000,
    "callback": function(data){
        var path='<?php echo WEB_PATH; ?>';
        var html= '';   
        html+= '<li class="Cursor b_pink" id="timeloop'+data.id+'">';
        html+= '<div class="cprint">';
        html+= '<a class="fl goodsimg" href="'+path+'/cgdataserver/'+data.id+'" target="_blank">';
        html+= '<img  src="'+data.upload+'/'+data.thumb+'">';
        html+= '</a>';
        html+= '<div class="publishC-tit">';
        html+= '<h3><a href="'+path+'/cgdataserver/'+data.id+'" target="_blank" class="gray01">(第'+data.qishu+'期)'+data.title+'</a></h3>';
        html+= '<p class="money">商品价值：<span class="rmb">'+data.money+'</span>'+data.currency+'</p>';
        html+= '</div>';
        html+= '<p class="mt30">离开奖还有</p>';
        html+='<span class="shi"><span class="busytime" pattern="<i>mm</i>:<i>ss</i>:<i>ms</i>" time="'+(new Date().getTime() + (data.times * 1000)) +'">99 : 99 : 99</span>';
        html+='</div>';                 
        html+= '</li>';     
        var divl = $("#b_pink").find('li');
        var len = divl.length;          
        if(len==10 && len  >0){
            var this_len = len - 1;
            divl.eq(this_len).remove();
        }       
        $("#b_pink").prepend(html);
        $("#timeloop"+data.id+" .busytime").busytime({
            callback:function($dom){
                $dom.find(".shi").html('<span class="minute">正在计算,请稍后…</span>'); 
                setTimeout(function(){
                $.post(path+'/index/getshop/lottery_shop_getjson/',{gid:data.id},function(info){
                var uhtml = '';     
                uhtml+= '<div class="cprint">';     
                uhtml+= '<a class="fl goodsimg" href="'+path+'/cgdataserver/'+info.id+'" target="_blank">'; 
                uhtml+= '<img  src="'+info.upload+'/'+info.thumb+'"></a>';
                uhtml+= '<div class="publishC-Member gray02">';
                uhtml+= '<a class="fl headimg" href="'+path+'/uname/'+(1000000000 + parseInt(info.uid))+'" target="_blank">';
                if(info.uid){
                uhtml+= '<img id="imgUserPhoto" src="'+info.upload+'/photo/member.jpg.8080.jpg" width="50" height="50" border="0">';
                }else{
                uhtml+= ' <img id="imgUserPhoto" src="'+info.upload+info.u_thumb+'" width="50" height="50" border="0">';                    
                }
                uhtml+= '</a>';
                uhtml+= '<p>获得者：<a class="blue Fb" href="'+path+'/uname/'+(1000000000 + parseInt(info.uid))+'" target="_blank">'+info.user+'</a></p>';
                uhtml+= '<p>夺宝：<em class="c_red Fb">'+info.shopsum+'</em>人次</p>';
                uhtml+= '</div>';
                uhtml+= '<div class="publishC-tit">';
                uhtml+= '<h3><a href="'+path+'/cgdataserver/'+info.id+'" target="_blank" class="gray01">(第'+info.qishu+'期)'+info.title+'</a></h3>';
                uhtml+= '<p class="money">商品价值：<span class="rmb">'+info.money+'</span>'+info.currency+'</p>';
                uhtml+= '<p class="Announced-time gray02">揭晓时间：'+info.q_external_time+'</p>';
                uhtml+= '</div>';
                uhtml+= '<div class="details bg_pink">';
                uhtml+= '<p class="fl details-Code">幸运夺宝码：<em class="c_red Fb">'+info.q_user_code+'</em></p>';
                uhtml+= '<a class="fl details-A c_red" href="'+path+'/cgdataserver/'+info.id+'" rel="nofollow" target="_blank">查看详情</a>';
                uhtml+= '</div>';
                uhtml+= '</div>';               
                $("#timeloop"+data.id).html(uhtml);                 
                },'json');
                },5000);
            }
        }).start();     
        
    }
});
</script>   
<!---正在倒计时--->                 
            </div>
        <?php if($total>$num): ?>
        <div class="pagesx"><?php echo $page->show('two'); ?></div>     
        <?php endif; ?>
        </div>
    </div>
    <div class="W-right fr" style="width:235px;border:none">
        <div class="Newpublishbor b_gray">
            <div class="Rtitle gray01">TA们正在<?php echo L('html.key'); ?> </div>
            <div class="Rcenter buylistH">
                <ul id="buyList" style="margin-top: 0px;">
                <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$user_record = $mod_common_cloud_goods->cloud_user_record('ouid is not null order by `otime` desc limit 6'); ?> 
                <?php if(is_array($user_record)) foreach($user_record AS $c_user_record): ?>
                <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$user_cgoods = $mod_common_cloud_goods->cloud_goodsdetail($c_user_record['ogid']); ?>
                    <li>
                     <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($c_user_record['ouid']); ?>" target="_blank" class="pic">   
                    <?php if(get_user_key($c_user_record['ouid'],'img','8080')=='null'): ?>
                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" border="0">
                    <?php  else: ?>
                    <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($c_user_record['ouid']); ?>.8080.jpg" width="50" height="50" border="0">
                    <?php endif; ?>                       
                    </a>                
                        <p class="Rtagou"><a class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($c_user_record['ouid']); ?>" target="_blank"><?php echo get_user_key($c_user_record['ouid'],'username'); ?></a>刚刚<?php echo L('html.key'); ?>了</p>
                        <p class="Rintro"><a class="gray01" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $c_user_record['ogid']; ?>" target="_blank"><?php echo useri_title($c_user_record['og_title'],'g_title'); ?></a></p>
                    </li>       
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="blank10"></div>
        <div class="Newpublishbor b_gray">
                <div class="Rtitle gray01">人气排行 </div>
                <div class="Rcenter RcenterPH">
                    <ul class="RcenterH" id="RcenterH">     
                        <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$r_cgoods = $mod_common_cloud_goods->cloud_goodslist(5,1); ?> 
                        <?php if(is_array($r_cgoods)) foreach($r_cgoods AS $recommended): ?>                        
                        <li>
                            <div name="simpleinfo">
                                <span class="pic"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $recommended['id']; ?>" target="_blank">
                                <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $recommended['g_thumb']; ?>" width="56"height="56"></a></span>
                                <p class="Rintro gray01"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $recommended['id']; ?>" target="_blank"><?php echo $recommended['g_title']; ?></a></p>
                                <p><i>剩余人次</i><em><?php echo $recommended['zongrenshu']-$recommended['canyurenshu']; ?></em></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>  
    </div>
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>