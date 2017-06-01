<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"揭晓结果",
        "Home":true,
        "Member":false,
        "Shop":false
    }); 
</script>
<section class="goodsCon pCon">
    <!-- 导航 -->
    <div id="divPeriod" class="pNav">
        <div class="loading" style="display:none"><b></b>正在加载</div> 
        <ul class="slides"> 
        <li class="<?php echo $style0; ?>"><a href="<?php echo $cgoods_url0; ?>" >第<?php echo $itemlist0['qishu']; ?>期<i></i></a><b></b></li>       
        <?php if(is_array($itemlist)) foreach($itemlist AS $qitem): ?>      
        <li class="<?php echo $qitem['style']; ?>"><a href="<?php echo $qitem['cgoods_url']; ?>" >第<?php echo $qitem['qishu']; ?>期</a><b></b></li>
        <?php endforeach; ?>               
        </ul>
    </div>
    
    <!-- 揭晓倒计时 -->
    <div class="pProcess pProcess2">
        <div class="pResults">
            <div class="pResultsL" onclick="location.href='<?php echo WEB_PATH; ?>/uname/<?php echo idjia($item['q_uid']); ?>'">
                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($item['q_uid']); ?>">
                    <?php if(!$item['q_user']['img']): ?>
                    <img class="mt10 mb10" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" ></a>
                    <?php  else: ?>
                    <img class="mt10 mb10" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['q_user']['img']; ?>"  ></a>
                    <?php endif; ?>             
                    <span><?php echo get_user_name($q_user); ?></span>
                </a>
                <s></s>
            </div>
            <div class="pResultsR">
                <div class="g-snav">
                    <div class="g-snav-lst">总共<?php echo L('html.key'); ?><br><dd><b class="orange"><?php echo $user_shop_number; ?></b><br>人次</dd></div>
                    <div class="g-snav-lst">揭晓时间<br><dd class="gray9"><span><?php echo microt($item['q_end_time'],'Y'); ?><br><?php echo microt($item['q_end_time'],'H'); ?></span></dd></div>
                    <div class="g-snav-lst"><?php echo L('html.key'); ?>时间<br><dd class="gray9"><span><?php echo microt($user_shop_time,'Y'); ?><br><?php echo microt($user_shop_time,'H'); ?></span></dd></div>
                </div>
            </div>
            <p><a href="<?php echo WEB_PATH; ?>/cgoodsresult/<?php echo $item['id']; ?>" class="fr">查看计算结果</a>幸运<?php echo L('html.key'); ?>码：<b class="orange"><?php echo $item['q_user_code']; ?></b></p>
        </div>
    </div>
    
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
    <div class="pDetails pDetails-end">
        <b>(第<?php echo $item['qishu']; ?>期)<?php echo $item['g_title']; ?><span></span></b>
        <p class="price">价值：<em class="arial gray"><?php echo sprintf("%.2f",$item['zongrenshu']*$item['price']); ?></em><?php echo L('cgoods.currency'); ?></p>
        <div class="pClosed">本期已揭晓</div>
        <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$lastone = $mod_common_cloud_goods->cloud_goodslastone($item['gid']); ?> 
        <div class="pOngoing" codeid="403041">第<em class="arial"><?php echo $lastone['qishu']; ?></em>期 进行中…<a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $lastone['id']; ?>"><span class="fr">查看详情</span></a></div>
    </div>


    
    <!-- 上期获得者 -->
    <div class="joinAndGet">
        <dl>
            <a href="<?php echo WEB_PATH; ?>/index/cloud_goods/go_record_iframe/<?php echo $item['id']; ?>/20"><b class="fr z-arrow"></b>所有购买记录</a>
            <a href="<?php echo WEB_PATH; ?>/cgoodsdesc/<?php echo $item['id']; ?>"><b class="fr z-arrow"></b>图文详情<em>（建议WIFI下使用）</em> </a>           
            <a href="<?php echo WEB_PATH; ?>/index/share/share_iframe/<?php echo $item['id']; ?>">
            <?php $mod_common_temp = System::load_app_model('temp','common');$total = $mod_common_temp->sharenum($item[id]); ?>
            <b class="fr z-arrow"></b>已有<span class="orange arial"><?php echo $total['sd_total']; ?></span>个幸运者晒单
            <strong class="orange arial"><?php echo $total['sd_totalpl']; ?></strong>条评论</a>
        </dl>
        <!--
        <ul id="prevPeriod" class="m-round" codeid="398781" uweb="1006028413">
            <li class="fl"><s></s><img src="http://m.yungoucms.cn/statics/uploads/shaidan/20141126/50322014982719.jpg"/></li>
            <li class="fr"><b class="z-arrow"></b></li>         
            <li class="getInfo">
                <dd><em class="blue">大宏表哥感觉萌萌哒</em> (天津市) </dd>
                <dd>总共<?php echo L('html.key'); ?>：<em class="orange arial">527</em>人次</dd>
                <dd>幸运<?php echo L('html.key'); ?>码：<em class="orange arial">100000013</em></dd>
                <dd>揭晓时间：2015-03-11 10:47:33.491</dd>
                <dd><?php echo L('html.key'); ?>时间：2015-03-11 10:47:33.491</dd>    
            </li>
        </ul>
      -->  
    </div>
</section>
<?php include self::includes("index.footer"); ?>
</body>
</html>
