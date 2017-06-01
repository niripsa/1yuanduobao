<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.BusyTime"); ?>
<?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php include self::includes("index.header"); ?>
<!-- 栏目导航 开始-->
<?php include self::includes("index.navs"); ?>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/TouchSlide.1.1.js"></script>
<!-- 栏目导航 结束-->
<input name="hidStartAt" type="hidden" id="hidStartAt" value="0">
<div id="myCarousel" class="carousel slide">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div id="content">
        <div id="focus" class="focus">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    <?php if(is_array(Getslide(5,2))) foreach(Getslide(5,2) AS $slide): ?>
                    <li><a href="<?php echo $slide['link']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>" /></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--限时抢购  开始-->
<div class="m_countdown">
	 <div class="m-tt1">
        <h2 class="fl"><a href="<?php echo WEB_PATH; ?>/cgoods_list">限时抢购</a></h2>
        <div class="fr u-more">
            <a href="<?php echo WEB_PATH; ?>/cgoods_list" class="u-rs-m1 ziti">更多<b class="z-arrow"></b></a>
        </div>
    </div>
    
    <div class="countdown_pro">
    	<ul>
        <?php foreach ( (array)$jinri_shoplist as $k => $v ) { ?>
        <li>
            <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $v['id']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $v['g_thumb']; ?>"/>
                <p class="title_cut" style="padding-bottom:5px"><span><?php echo $v['g_title']; ?></span></p>
                <p>倒计时 <span id="hour_<?php echo $k; ?>">00:</span><span id="minute_<?php echo $k; ?>">00:</span><span id="second_<?php echo $k; ?>">00</span></p>
            </a>
        </li>
        <script type="text/javascript"> 
            $(function() {
                timer( <?php echo $v['xsjx_time'] - time(); ?>, <?php echo $k; ?>, ':' );
            });
        </script>
        <?php } ?>
        </ul>
    </div>
</div>
<!--限时抢购  结束-->


<!-- 最新揭晓 -->
<!-- <section class="g-main">
    <div class="m-tt1">
        <h2 class="fl"><a href="<?php echo WEB_PATH; ?>/cgoods_lottery">最新揭晓</a></h2>
        <div class="fr u-more">
            <a href="<?php echo WEB_PATH; ?>/cgoods_lottery" class="u-rs-m1"><b class="z-arrow"></b></a>
        </div>
    </div>
    <article class="h5-1yyg-w310 m-round m-lott-li" id="divLottery"> -->

        <!--已经揭晓 开始-->
      <!--   <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$r_cgoodslisted = $mod_common_cloud_goods->cloud_goodsed(5); ?>
        <div id="divLotteryList">
        <?php if(is_array($r_cgoodslisted)) foreach($r_cgoodslisted AS $cgoodslisted): ?>
        <div class="m-lott-conduct">
            <p onclick="location.href='<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $cgoodslisted['id']; ?>'">恭喜
                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($cgoodslisted['q_uid']); ?>"><span class="z-user blue"><?php echo Getusername($cgoodslisted['q_uid']); ?></span></a> 获得 (第<?php echo $cgoodslisted['qishu']; ?>期)<?php echo $cgoodslisted['g_title']; ?>
                <a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $cgoodslisted['id']; ?>"><b class="z-arrow"></b></a>
            </p>
        </div>
        <?php endforeach; ?>
        </div> -->
        <!--已经揭晓 结束-->


        <!-- <ul class="clearfix">
            <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$r_cgoodslisted = $mod_common_cloud_goods->cloud_goodsed(4); ?>
            <?php if(is_array($r_cgoodslisted)) foreach($r_cgoodslisted AS $cgoodslisted): ?>
            <li>
                <a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $cgoodslisted['id']; ?>" class="u-lott-pic">
                    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $cgoodslisted['g_thumb']; ?>" border="0" alt="" />
                </a>
                <span>恭喜<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($cgoodslisted['q_uid']); ?>" class="blue z-user"><?php echo Getusername($cgoodslisted['q_uid']); ?></a>获得</span>
            </li>
            <?php endforeach; ?>
        </ul>
    </article>
</section> -->

<!-- 热门推荐 开始-->
<section class="g-main">
    <div class="m-tt1">
        <h2 class="fl"><a href="<?php echo WEB_PATH; ?>/cgoods_list">热门推荐</a></h2>
        <div class="fr u-more">
            <!-- <a href="<?php echo WEB_PATH; ?>/cgoods_list" class="u-rs-m1 ziti">更多<b class="z-arrow"></b></a> -->
        </div>
    </div>
    <article class="clearfix h5-1yyg-w310 m-round m-tj-li">
        <ul id="ulRecommend">
            <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$r_cgoods = $mod_common_cloud_goods->cloud_goodslist(6,2); ?>
            <?php if(is_array($r_cgoods)) foreach($r_cgoods AS $recommended): ?>
            <li id="16973">
                <div class="f_bor_tr">
                    <div class="m-tj-pic">
                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $recommended['id']; ?>" class="u-lott-pic">
                            <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $recommended['g_thumb']; ?>" border=0 alt="<?php echo $recommended['g_title']; ?>" />
                        </a>
                        <ins class="u-promo">价值:<?php echo $recommended['g_money']; ?><?php echo L('cgoods.currency'); ?></ins>
                    </div>
                    <div class="Progress-bar">
                       <p class="title_cut" style="padding-bottom:5px"><span><?php echo $recommended['g_title']; ?></span></p>
                        <p class="u-progress" title="已完成">
                        <span class="pgbar" style="width:<?php echo intval(width($recommended['canyurenshu'],$recommended['zongrenshu'],100)); ?>%;">
                        <span class="pging"></span>
                        </span>
                        </p>
                        <ul class="Pro-bar-li">
                            <li class="P-bar01"><em><?php echo $recommended['canyurenshu']; ?></em>已参与</li>
                            <li class="P-bar02"><em><?php echo $recommended['zongrenshu']; ?></em>总需人次</li>
                            <li class="P-bar03"><em><?php echo $recommended['zongrenshu']-$recommended['canyurenshu']; ?></em>剩余</li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <span id="nodata"></span>
    </article>
    <input type="hidden" id="cur_pages" value="2" name="cur_pages"/>
</section>
<!-- 热门推荐 结束   -->
<script id="index_goods" type="text/html">
    <p onclick="location.href='<?php echo WEB_PATH; ?>/cgdataserver/{{shop.id}}'">恭喜
        <a href="<?php echo WEB_PATH; ?>/uname/{{shop.uid | uid}}"><span class="z-user blue">{{shop.user}}</span></a> 
        获得 (第{{shop.qishu }}期){{shop.title}}
        <a href="<?php echo WEB_PATH; ?>/cgdataserver/{{shop.id}}"><b class="z-arrow"></b></a>
    </p>
</script>
<script type="text/javascript">
$(function(){ 
  var winH = $(window).height(); //页面可视区域高度 
  var i; //设置当前页数 
  i = $('#cur_pages').val();
  $(window).scroll(function () { 
    var pageH = $(document.body).height(); 
    var scrollT = $(window).scrollTop(); //滚动条top 
    var aa = (pageH-winH-scrollT)/winH; 
    if(aa<0.02){ 
      $.getJSON("<?php echo WEB_PATH; ?>/index/cloud_goods/ajax_cloud_goods_l",{page:i},function(json){ 
        if(json){ 
          var str = ""; 
          $.each(json,function(index,array){ 
            $('#ulRecommend').append(
                '<li id="16973">'+
                '<div class="f_bor_tr">'+
                    '<div class="m-tj-pic">'+
                        '<a href="<?php echo WEB_PATH; ?>/cgoods/'+array.id+'" class="u-lott-pic">'+
                            '<img src="<?php echo G_UPLOAD_PATH; ?>/'+array.g_thumb+'" border=0 alt="'+array.g_title+'" />'+
                        '</a>'+
                        '<ins class="u-promo">价值:'+array.g_money+'购买币</ins>'+
                    '</div>'+
                    '<div class="Progress-bar">'+
                       '<p class="title_cut" style="padding-bottom:5px"><span>'+array.g_title+'</span></p>'+
                        '<p class="u-progress" title="已完成">'+
                        '<span class="pgbar" style="width:'+array.canyu_rate+'%;">'+
                        '<span class="pging"></span>'+
                        '</span></p>'+
                        '<ul class="Pro-bar-li">'+
                            '<li class="P-bar01"><em>'+array.canyurenshu+'</em>已参与</li>'+
                            '<li class="P-bar02"><em>'+array.zongrenshu+'</em>总需人次</li>'+
                            '<li class="P-bar03"><em>'+(array.zongrenshu - array.canyurenshu) +'</em>剩余</li>'+
                        '</ul></div></div></li>'
                );
          }); 
        i++;
        $('#cur_pages').val( i );
        }else{ 
          $("#nodata").show().html("别滚动了，已经到底了。。。"); 
          return false; 
        } 
      }); 
    } 
  }); 
}); 
</script>
<script type="text/javascript">

$.YunCmsApi.Loop({
    "timer"   : 15000,
    "callback": function(data){
            //data.times = (new Date().getTime() + (data.times * 1000));
            $("#divLottery").prepend(
                '<div class="m-lott-conduct" id="timeloop'+data.id+'">'+
                '<a href="<?php echo WEB_PATH; ?>/cgoods/'+data.id+'">'+
                '<p class="z-lott-tt">(第' + data.qishu + '期) ' + data.title +
                '<b class="z-arrow"></b>'+
                '<span class="z-lott-time">揭晓倒计时'+
                '<span class="busytime" pattern="hh:mm:ss ms" time="'+(new Date().getTime() + (data.times * 1000)) +'"> '+
                '99 : 99 : 99</span></span></p></a>'+
                '</div>'
            );
            $("#timeloop"+data.id+" .busytime").busytime({
                callback:function($dom){
                    $("#timeloop"+data.id).html(template('index_goods', {shop:data}))           
                }
            }).start();
    }
});

</script>
<?php include self::includes("index.footer"); ?>