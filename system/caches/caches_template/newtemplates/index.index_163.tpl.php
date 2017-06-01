<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>

<html>



<head>

<?php echo seo(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/163style.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/163css.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/163cssdq.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/swiper.min.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/stylekf.css"/>

<script src="<?php echo G_TEMPLATES_STYLE; ?>/css/jquery-1.10.2.min.js"></script>

<script src="<?php echo G_TEMPLATES_JS; ?>/jquery-1.9.1.min.js"></script>

<script src="<?php echo G_TEMPLATES_JS; ?>/count_down.js"></script>

<script src="<?php echo G_TEMPLATES_JS; ?>/swiper.min.js"></script>



<script type='text/javascript'>

$(function(){

$("#butSearch").click(function() {

    if ( $("#txtSearch").val() ) 

    {

        window.location.href = "<?php echo WEB_PATH; ?>/soso="+$("#txtSearch").val();

    }

    else

    {

        alert( '请输入要搜索的内容' );

    }

});

});

</script>

</head>



<body>

<?php include self::includes("index.toolbar"); ?>

<div class="m-nav" module="nav/Nav">

    <div class="g-wrap f-clear">

        <div class="m-catlog m-catlog-normal">

            <div class="m-catlog-hd" style="padding-left:30px;cursor:pointer">

                <h2>商品分类

                <i class="ico ico-arrow ico-arrow-white ico-arrow-white-down"></i>

                </h2>

            </div>

            <div class="m-catlog-wrap">

                <div class="m-catlog-bd">

                    <ul class="m-catlog-list">

                        <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/">全部商品</a></li>

                        <?php if(is_array(GetCate('0',11,0))) foreach(GetCate('0',11,0) AS $two_cate): ?>

                        <li>

                        <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0" target="_blank"> <?php echo $two_cate['name']; ?> </a>

                        </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

                <div class="m-catlog-ft"></div>

            </div>

        </div>

        

        <div class="m-menu" pro="menu">

            <ul class="m-menu-list">

                <?php if(is_array(Getheader('index','classstyle'))) foreach(Getheader('index','classstyle') AS $k => $indexnav): ?>

                <li class="m-menu-list-item">

                <?php if ( $k > 0 ) { ?>

                    <var>|</var>

                <?php } ?>

                    <a class="m-menu-list-item-link" href="<?php echo $indexnav['url']; ?>" target="<?php echo $indexnav['url_target']; ?>"> <?php echo $indexnav['name']; ?> </a>

                </li>

                <?php endforeach; ?>

            </ul>

        </div>

    </div>

</div>      

</div>



<div class="g-body">

<div module="index/Index">

    <div class="m-index">

        <div class="g-wrap g-body-hd f-clear">

            <div class="g-main">

                <div class="g-main-l">

                    <div class="m-index-news">

                        <div class="m-index-news-hd">

                            <h4>系统公告</h4>

                        </div>

                        <div class="m-index-news-bd">

                            <ul class="m-index-news-list">

                            <?php if(is_array($notice)) foreach($notice AS $k => $v): ?>

                                <li class="f-txtabb">

                                    <span class="lv1"><?php echo $k+1; ?></span>

                                    <a href="<?php echo WEB_PATH; ?>/article-<?php echo $v['id']; ?>.html" target="_blank">

                                        <?php echo $v['title']; ?>

                                    </a>

                                </li>

                            <?php endforeach; ?>

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="g-main-m">

                    <div class="w-slide m-index-promot swiper-banner">

                        <ul class="swiper-wrapper">

                        <?php if(is_array(Getslide(5))) foreach(Getslide(5) AS $k => $slide): ?>

                            <li class="swiper-slide">

                                <a href="<?php echo $slide['link']; ?>" target="_blank">

                                <img width="730" height="370" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>" />

                                </a>

                            </li>

                        <?php endforeach; ?>

                        </ul>

                        <!-- Add Pagination -->

                        <div id="banner_pagination" class="swiper-pagination"></div>

                        <!-- Add Arrows -->

                        <div id="banner_next" class="swiper-button-next"></div>

                        <div id="banner_prev" class="swiper-button-prev"></div>

                    </div>

                    <script>

                        var swiper = new Swiper('.swiper-banner', {

                            pagination: '#banner_pagination',

                            nextButton: '#banner_next',

                            prevButton: '#banner_prev',

                            slidesPerView: 1,

                            paginationClickable: true,

                            spaceBetween: 30,

                            centeredSlides: true,

                            autoplay: 2500,

                            autoplayDisableOnInteraction: false,

                            loop: true

                        });

                    </script>



                    <div id="newestResult" class="w-slide m-index-newReveal">

                        <h4>最新揭晓</h4>

                        <div class="swiper-announce">

                            <ul class="swiper-wrapper">

                            <?php if(is_array($jinri_shoplist)) foreach($jinri_shoplist AS $k => $shop): ?>

                            <?php if($shop['q_user_code'] && $shop['q_showtime'] == 'N'): ?>

                            

                            <?php  else: ?>

                            <?php if ( $k % 2 == 0 ) { ?>

                            <div class="swiper-slide">

                                <li class="w-slide-wrap-list-item">

                                    <div class="w-goods-newReveal">

                                        <i class="ico ico-label ico-label-revealing" title="正在揭晓"></i>

                                        <p class="w-goods-title">

                                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" title="<?php echo $shop['g_title']; ?>" target="_blank"><?php echo $shop['g_title']; ?></a>

                                        </p>

                                        <div class="w-goods-pic">

                                            <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">

                                                <img width="120" height="120" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>" />

                                            </a>

                                        </div>

                                        <p class="w-goods-price">总需：<?php echo $shop['zongrenshu']; ?>人次</p>

                                        <p class="w-goods-period">期号：(第<?php echo $shop['qishu']; ?>期)</p>

                                        <div class="w-goods-counting">

                                            <div class="w-goods-countdown">揭晓倒计时:

                                                <div class="w-countdown">

                                                    <span id="time_<?php echo $k; ?>" class="w-countdown-nums">

                                                    <b>0</b><b>0</b>:<b>0</b><b>0</b>:<b>0</b><b>0</b>:<b>0</b><b>0</b>

                                                    </span>

                                                    <p class="w-countdown-ing txt-red" style="display:none;">请稍候，正在计算中…</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div id="already_<?php echo $k; ?>" class="w-goods-error" style="display:none">

                                            <p class="txt-gray w-goods-err">已揭晓~<br/>

                                            <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">点击查看详情...</a>

                                            </p>

                                        </div>

                                    </div>

                                </li>

                            <?php } else { ?>

                                <li class="w-slide-wrap-list-item">

                                    <div class="w-goods-newReveal">

                                        <i class="ico ico-label ico-label-revealing" title="正在揭晓"></i>

                                        <p class="w-goods-title">

                                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" title="<?php echo $shop['g_title']; ?>" target="_blank"><?php echo $shop['g_title']; ?></a>

                                        </p>

                                        <div class="w-goods-pic">

                                            <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">

                                                <img width="120" height="120" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>" />

                                            </a>

                                        </div>

                                        <p class="w-goods-price">总需：<?php echo $shop['zongrenshu']; ?>人次</p>

                                        <p class="w-goods-period">期号：(第<?php echo $shop['qishu']; ?>期)</p>

                                        <div class="w-goods-counting">

                                            <div class="w-goods-countdown">揭晓倒计时:

                                                <div class="w-countdown">

                                                    <span id="time_<?php echo $k; ?>" class="w-countdown-nums">

                                                    <b>0</b><b>0</b>:<b>0</b><b>0</b>:<b>0</b><b>0</b>:<b>0</b><b>0</b>

                                                    </span>

                                                    <p class="w-countdown-ing txt-red" style="display:none;">请稍候，正在计算中…</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div id="already_<?php echo $k; ?>" class="w-goods-error" style="display:none">

                                            <p class="txt-gray w-goods-err">已揭晓~<br/>

                                            <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank">点击查看详情...</a>

                                            </p>

                                        </div>

                                    </div>

                                </li>

                            </div>

                            <?php } ?>

                            <script type="text/javascript"> 

                                addTimer( "time_<?php echo $k; ?>", "<?php echo $shop['xsjx_time']; ?>" );

                            </script>

                            <?php endif; ?>

                            <?php endforeach; ?>

                            </ul>

                            <!-- Add Pagination -->

                            <div id="announce_pagination" class="swiper-pagination"></div>

                        </div>

                        <script>

                            var swiper = new Swiper('.swiper-announce', {

                                pagination: '#announce_pagination',

                                slidesPerView: 1,

                                paginationClickable: true,

                                spaceBetween: 30,

                                centeredSlides: true,

                                autoplay: 2500,

                                autoplayDisableOnInteraction: false,

                                // loop: true

                            });

                        </script>

                        



                    </div>

                </div>

                </div>

                <div class="g-side">

                <!-- 注册 img -->

                    <div class="m-index-recommend">

                    <a href="<?php echo WEB_PATH; ?>/member/account/userrecharge" target="_blank">

                        <img src="<?php echo G_TEMPLATES_IMAGE; ?>/recharge.jpg" />

                    </a>

                    </div>

                    <div class="w-slide m-index-newGoods">

                        <i class="ico ico-label ico-label-newRecommend" title="新品推荐"></i>

                        <div class="swiper-recom">

                            <ul class="swiper-wrapper">

                            <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$r_cgoods = $mod_common_cloud_goods->cloud_goodslist(10,2); ?>

                            <?php if(is_array($r_cgoods)) foreach($r_cgoods AS $recommended): ?>

                            <li class="swiper-slide">

                                <table class="wrap">

                                    <tr>

                                        <td style="border-bottom:1px dotted #C9C9C9;padding-top:15px;height:130px;text-align:center;">

                                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $recommended['id']; ?>" target="_blank">

                                        <img width="120" height="120" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $recommended['g_thumb']; ?>" style="margin:auto" />

                                        </a>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td style="height:63px;text-align:center">

                                            <dl>

                                                <dt class="f-txtabb" style="width:100%">

                                                <a style="color:#3C3C3C;font-size:14px;" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $recommended['id']; ?>" target="_blank" title="<?php echo $recommended['g_title']; ?>"><?php echo $recommended['g_title']; ?></a></dt>

                                                <dd class="f-txtabb m-index-newGoods-desc" style="width:100%" title="<?php echo $recommended['g_keyword']; ?>"> <?php echo $recommended['g_keyword']; ?> </dd>

                                            </dl>

                                        </td>

                                    </tr>

                                </table>

                            </li>

                            <?php endforeach; ?>

                            </ul>

                            <!-- Add Arrows -->

                            <div id="recom_next" class="swiper-button-next"></div>

                            <div id="recom_prev" class="swiper-button-prev"></div>

                        </div>

                        <script>

                            var swiper = new Swiper('.swiper-recom', {

                                nextButton: '#recom_next',

                                prevButton: '#recom_prev',

                                slidesPerView: 1,

                                paginationClickable: true,

                                spaceBetween: 30,

                                centeredSlides: true,

                                autoplay: 2500,

                                autoplayDisableOnInteraction: false,

                                loop: true

                            });

                        </script>



                    </div>

                </div>

            </div>

            <div class="g-wrap g-body-bd f-clear">

                <div class="g-main">

                    <div class="m-index-mod m-index-goods-hotest">

                        <div class="w-hd">

                            <h3 class="w-hd-title">人气商品</h3>

                            <a class="w-hd-more" href="<?php echo WEB_PATH; ?>/cgoods_list/0_0_2" target="_blank">更多商品，点击查看&gt;&gt;</a>

                        </div>

                        <div class="m-index-mod-bd">

                            <ul class="w-goodsList f-clear">

                            <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$popu_goods = $mod_common_cloud_goods->cloud_goodslist(8,1); ?>

                            <?php if(is_array($popu_goods)) foreach($popu_goods AS $goods): ?>



                            <li class="w-goodsList-item">

                            <?php if ( $goods['price'] == '100' ) { ?>

                            <img class="ico ico-label ico-label-goods" src="<?php echo G_TEMPLATES_IMAGE; ?>/icon_hundreds_goods.png">

                            <?php } else if ( $goods['price'] == '10' ) { ?>

                            <img class="ico ico-label ico-label-goods" src="<?php echo G_TEMPLATES_IMAGE; ?>/icon_tens_goods.png">

                            <?php } ?>

                                <div class="w-goods w-goods-ing">

                                    <div class="w-goods-pic">

                                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $goods['id']; ?>" target="_blank">

                                            <img width="200" height="200" alt="<?php echo $goods['g_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $goods['g_thumb']; ?>" />

                                        </a>                                        

                                    </div>

                                    <p class="w-goods-title f-txtabb"><a title="<?php echo $goods['g_title']; ?>" href="/" target="_blank"><?php echo $goods['g_title']; ?></a></p>

                                    <p class="w-goods-price">总需：<?php echo $goods['zongrenshu']; ?> 人次</p>

                                    <div class="w-progressBar">

                                        <p class="w-progressBar-wrap">

                                            <span class="w-progressBar-bar" style="width:<?php echo percentage( $goods['canyurenshu'], $goods['zongrenshu'] ); ?>;"></span>

                                        </p>

                                        <ul class="w-progressBar-txt f-clear">

                                            <li class="w-progressBar-txt-l">

                                                <p><b><?php echo $goods['canyurenshu']; ?></b></p>

                                                <p>已参与人次</p>

                                            </li>

                                            <li class="w-progressBar-txt-r">

                                                <p><b><?php echo $goods['shenyurenshu']; ?></b></p>

                                                <p>剩余人次</p>

                                            </li>

                                        </ul>

                                    </div>

                                    <p class="w-goods-progressHint">

                                        <b class="txt-blue"><?php echo $goods['canyurenshu']; ?></b>

                                        人次已参与，赶快去参加吧！剩余

                                        <b class="txt-red"><?php echo $goods['shenyurenshu']; ?></b>人次

                                    </p>

                                    <div class="w-goods-opr">                                    

                                    <a class="w-button w-button-main w-button-l w-goods-quickBuy" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $goods['id']; ?>" style="width:70px;" title="立刻购买">立刻购买</a>

                                    </div>

                                </div>

                            </li>

                            <?php endforeach; ?>

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="g-side">

                    <div class="m-index-mod m-index-recordRank m-index-recordRank-nb">



                    <div class="m-index-mod-hd">

                        <h3>一元中奖名单</h3>

                    </div>

                    <div class="m-index-mod-bd">

                        <ul class="w-intervalScroll" data-minLine="8">

                        <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$r_recordhuode = $mod_common_cloud_goods->cloud_user_recordhuode(8); ?>

                        <?php if(is_array($r_recordhuode)) foreach($r_recordhuode AS $recordhuode): ?>

                        <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$user_cgoods = $mod_common_cloud_goods->cloud_goodsdetaila($recordhuode['ogid']); ?>

                        <?php if($user_cgoods): ?>

                            <li pro="item" class="w-intervalScroll-item odd">

                                <div class="w-record-avatar">

                                <?php if(get_user_key($recordhuode['ouid'],'img','8080')=='null'): ?>

                                <img width="40" height="40" onerror="" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg"/>

                                <?php  else: ?>

                                <img width="40" height="40" onerror="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($recordhuode['ouid']); ?>.8080.jpg"/>

                                <?php endif; ?>

                                </div>

                                <div class="w-record-detail">

                                    <p class="w-record-intro">

                                        <a class="w-record-user f-txtabb" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($recordhuode['ouid']); ?>" target="_blank"><?php echo get_user_key($recordhuode['ouid'],'username'); ?></a>

                                        <span class="w-record-date">于<?php echo microt($recordhuode['otime'],'h'); ?></span>

                                    </p>

                                    <p class="w-record-title f-txtabb">

                                    <strong><?php echo $recordhuode['onum']; ?>人次</strong>

                                    夺得<a title="<?php echo useri_title($recordhuode['og_title'],'g_title'); ?>" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $recordhuode['ogid']; ?>" target="_blank"><?php echo useri_title($recordhuode['og_title'],'g_title'); ?></a>

                                    </p>

                                    <p class="w-record-price">总需：<?php echo $user_cgoods['zongrenshu']; ?> 人次</p>

                                </div>

                            </li>

                        <?php endif; ?>

                        <?php endforeach; ?>

                        </ul>

                    </div>

                    <div onClick="location.href='<?php echo WEB_PATH; ?>/index/share/init'" class="m-index-mod-ft">看看谁的狗屎运最好！</div>



                    </div>

                </div>

            </div>

<div class="g-wrap g-body-ft f-clear">



<?php if(is_array(GetCate('0',11,0))) foreach(GetCate('0',11,0) AS $two_cate): ?>

<?php $cate_info = unserialize( $two_cate['info'] ); ?>

<div class="m-index-mod m-index-goods-catlog">



<div class="w-hd">

    <h3 class="w-hd-title"> <?php echo $two_cate['name']; ?> </h3>

    <a class="w-hd-more" target="_blank" href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0">

    更多商品，点击查看&gt;&gt;

    </a>

</div>



<div class="m-index-mod-bd f-clear">

    <div class="w-slide m-index-promotGoods">

        <div class="w-slide-wrap">

            <ul class="w-slide-wrap-list" pro="list">

            <li pro="item" class="w-slide-wrap-list-item">

                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0" target="_blank">

                    <img width="239" height="400" src="<?php echo G_UPLOAD_PATH . '/' . $cate_info['thumb']; ?>">

                </a>

            </li>

            </ul>

        </div>

        <div class="w-slide-controller">

            <div class="w-slide-controller-btn" pro="controllerBtn">

                <a class="prev" pro="prev" href="javascript:void(0)">

                <i class="ico ico-arrow-large ico-arrow-large-l"></i>

                </a>

                <a class="next" pro="next" href="javascript:void(0)">

                <i class="ico ico-arrow-large ico-arrow-large-r"></i>

                </a>

            </div>

        </div>

    </div>

    <ul class="w-goodsList">

    <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$sun_cate = $mod_common_cloud_goods->cloud_parentid($two_cate['cateid']); ?>

    <?php

        /* 寻找下面子级 */

        $sun_id_str = "'" . $two_cate['cateid'] . "'";

        foreach ( $sun_cate as $v )

        {

            $sun_id_str .= ",'" . $v["cateid"] . "'";

        }

    ?>

    <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$cloud_goods = $mod_common_cloud_goods->cloud_cpgoodslist( $sun_id_str, '', 'order by g_sort', 'LIMIT 0,4' ); ?>

    <?php if(is_array($cloud_goods)) foreach($cloud_goods AS $goods): ?>

    <li class="w-goodsList-item">

    <?php if ( $goods['price'] == '100' ) { ?>

    <img class="ico ico-label ico-label-goods" src="<?php echo G_TEMPLATES_IMAGE; ?>/icon_hundreds_goods.png">

    <?php } else if ( $goods['price'] == '10' ) { ?>

    <img class="ico ico-label ico-label-goods" src="<?php echo G_TEMPLATES_IMAGE; ?>/icon_tens_goods.png">

    <?php } ?>

        <div class="w-goods w-goods-ing">

            <div class="w-goods-pic">

                <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $goods['id']; ?>" title="<?php echo $goods['g_title']; ?>" target="_blank">

                    <img width="200" height="200" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $goods['g_thumb']; ?>" />

                </a>

            </div>

            <p class="w-goods-title f-txtabb">

            <a> <?php echo $goods['g_title']; ?> </a>

            </p>

            <p class="w-goods-price">总需：<?php echo $goods['zongrenshu']; ?> 人次</p>

            <div class="w-progressBar">

                <p class="w-progressBar-wrap">

                    <span class="w-progressBar-bar" style="width:<?php echo percentage( $goods['canyurenshu'], $goods['zongrenshu'] ); ?>;"></span>

                </p>

                <ul class="w-progressBar-txt f-clear">

                    <li class="w-progressBar-txt-l">

                        <p><b><?php echo $goods['canyurenshu']; ?></b></p>

                        <p>已参与人次</p>

                    </li>

                    <li class="w-progressBar-txt-r">

                        <p><b><?php echo $goods['shenyurenshu']; ?></b></p>

                        <p>剩余人次</p>

                    </li>

                </ul>

            </div>

            <p class="w-goods-progressHint">

                <b class="txt-blue"><?php echo $goods['canyurenshu']; ?></b>人次已参与，赶快去参加吧！

                剩余<b class="txt-red"><?php echo $goods['shenyurenshu']; ?></b>人次

            </p>

            <div class="w-goods-opr">

                <a class="w-button w-button-main w-button-l w-goods-quickBuy" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $goods['id']; ?>" style="width:70px;" title="立刻购买">立刻购买</a>

                <!-- <a class="w-button w-button-addToCart" href="javascript:void(0)" title="添加到购物车"></a> -->

            </div>

        </div>

    </li>

    <?php endforeach; ?>

    </ul>

</div>



</div>

<?php endforeach; ?>



<!-- 晒单分享 Start -->

<div class="m-index-mod m-index-share">

    <div class="w-hd">

        <h3 class="w-hd-title">晒单分享</h3>

        <a class="w-hd-more" href="<?php echo WEB_PATH; ?>/index/share/init" target="_blank">更多分享，点击查看&gt;&gt;</a>

    </div>

    <div class="m-index-mod-bd">

        <ul class="w-intervalScroll f-clear" data-minLine="4" data-perLine="2">

        <?php $mod_common_share = System::load_app_model('share','common');$shareL = $mod_common_share->sharelist(0,6); ?>

        <?php if(is_array($shareL)) foreach($shareL AS $shareLeft): ?>

            <li pro="item" class="w-intervalScroll-item">

                <a class="m-index-share-picLink" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $shareLeft['sd_id']; ?>" target="_blank">

                    <img class="m-index-share-pic" width="110" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shareLeft['sd_thumbs']; ?>" />

                </a>

                <div class="m-index-share-wrap">

                    <i class="ico ico-quote ico-quote-former"></i>

                    <p class="txt">

                        <a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $shareLeft['sd_id']; ?>" target="_blank">

                        <span title="<?php echo $shareLeft['sd_title']; ?>">【<?php echo $shareLeft['sd_title']; ?>】</span>

                        <?php echo $shareLeft['sd_content']; ?>

                        </a>

                    </p>

                    <p class="author">

                        —— <a title="<?php echo Getusername($shareLeft['sd_userid']); ?>" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($shareLeft['sd_userid']); ?>" target="_blank">

                        <?php echo Getusername($shareLeft['sd_userid']); ?>

                        </a> 

                        <?php echo _put_time($shareLeft['sd_time']); ?>

                    </p>

                    <i class="ico ico-quote ico-quote-after"></i>

                </div>

            </li>

        <?php endforeach; ?>

        </ul>

    </div>

</div>

<!-- 晒单分享 End -->



        </div>

    </div>

</div>

</div>



<!-- 底部 Start -->   

<div class="g-footer">

    <div class="m-instruction">

        <div class="g-wrap f-clear">

            <div class="g-main">

                <ul class="m-instruction-list">

                <?php if(is_array(GetCate('1',5,4,1,"ASC"))) foreach(GetCate('1',5,4,1,"ASC") AS $row): ?>

                    <li class="m-instruction-list-item">

                        <h5><i class="ico ico-instruction ico-instruction-1"></i><?php echo $row['name']; ?></h5>

                        <ul class="list">

                        <?php if(is_array($row['sub_cate'])) foreach($row['sub_cate'] AS $r): ?>

                            <li><a href="<?php echo WEB_PATH; ?>/article-<?php echo $r['id']; ?>.html" target="_blank"><?php echo $r['title']; ?></a></li>

                        <?php endforeach; ?>

                        </ul>

                    </li>

                <?php endforeach; ?>

                </ul>

            </div>

            <div class="g-side">

                <div class="g-side-l">

                    <ul class="m-instruction-state f-clear">

                        <li><i class="ico ico-state-l ico-state-l-1"></i>100%公平公正公开</li>

                        <li><i class="ico ico-state-l ico-state-l-2"></i>100%正品保证</li>

                        <li><i class="ico ico-state-l ico-state-l-3"></i>100%权益保障</li>

                        

                    </ul>

                </div>

                <div class="g-side-r">

         

                   <!-- <div class="m-instruction-service">

                        <p>周一至周五：9:00-18:00</p>

                        <p>意见反馈请 <a href="javascript:void(0);" class="btn-feedback" id="btnFooterFeedback">点击这里</a></p>

                    </div>-->

                    <img width="117" style="margin-left:40px;" src="<?php echo G_TEMPLATES_STYLE; ?>/images/two-dimension_code.jpg" />

                </div>

                <div style=" clear:both; float:right">周一至周五：9:00-18:00</div>

            </div>

        </div>

    </div>

    <div class="m-copyright">

        <div class="g-wrap">

            <div class="m-copyright-logo">            

                <a href="/" target="_blank"><img width="117" src="<?php echo G_TEMPLATES_STYLE; ?>/images/yy_logo.gif" /></a>

            </div>

            <div class="m-copyright-txt">

                <p>深圳市三人行广告传媒有限公司 版权所有</p>

                <p>备案号 <a target="_blank" href="http://www.miitbeian.gov.cn">粤ICP备16092265号</a> </p>

            </div>

        </div>

    </div>

</div>

<!-- 底部 End -->   



<div class="wrap-box"></div>



<div class="fixed-bar">

	<div class="wide-bar">

		<div class="consult-box">

			<div class="consult-header clearfix">

			<h3 class="consult-title">免费咨询</h3>

			</div>

			<ul class="consult-list">

				<li class="clearfix">

					<span>售前客服：</span>

					<a target="_blank" href="tencent://message/?uin=3348427925&Site=sc.chinaz.com&Menu=yes"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/JS_qq.png" alt="QQ" title="点击开始QQ交谈/留言"></a>

				</li>

				<li class="clearfix">

					<span>售前客服：</span>

					<a target="_blank" href="tencent://message/?uin=3348427925&Site=sc.chinaz.com&Menu=yes"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/JS_qq.png" alt="QQ" title="点击开始QQ交谈/留言"></a>

				</li>

				<li class="clearfix">

					<span>售前客服：</span>

					<a target="_blank" href="tencent://message/?uin=482913276&Site=sc.chinaz.com&Menu=yes"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/JS_qq.png" alt="QQ" title="点击开始QQ交谈/留言"></a>

				</li>

				<li class="clearfix">

					<span>售前客服：</span>

					<a target="_blank" href="tencent://message/?uin=482913276&Site=sc.chinaz.com&Menu=yes"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/JS_qq.png" alt="QQ" title="点击开始QQ交谈/留言"></a>

				</li>

                <li class="clearfix">

					<span>售后客服：</span>

					<a target="_blank" href="tencent://message/?uin=2093504128&Site=sc.chinaz.com&Menu=yes"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/JS_qq.png" alt="QQ" title="点击开始QQ交谈/留言"></a>

				</li>

                 <li class="clearfix">

					<span>&nbsp;&nbsp;&nbsp;投诉部：</span>

					<a target="_blank" href="tencent://message/?uin=2627179241&Site=sc.chinaz.com&Menu=yes"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/JS_qq.png" alt="QQ" title="点击开始QQ交谈/留言"></a>

				</li>

				<li class="clearfix"><span class="tel-icon">0738-6833169</span></li> 

				<li class="clearfix"><span class="tel-icon2"><img border="0" src="<?php echo G_TEMPLATES_STYLE; ?>/images/weixin.jpg" width="110" height="110" alt="微信" title="微信"></span></li> 

				

			</ul>

		</div>

		<a href="javascript:scrollTo(0,0)" class="gotop" title="回到顶部" style="display:none;"><i class="icon">返回顶部</i><span>返回顶部</span></a>

	</div>

</div>



<script type="text/javascript">    

$(document).scroll(function(){ 

	var  scrollTop =  $(document).scrollTop(),bodyHeight = $(window).height(); 

	if(scrollTop > bodyHeight){ 

		$('.fixed-bar .gotop').css('display','block');

	}else{

		$('.fixed-bar .gotop').css('display','none');

	} 

})

</script>



</body>

</html>