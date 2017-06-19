<?php
//000000000000s:163101:"<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>首页-开源商城 | B2C商城 | B2B2C商城 | 三级分销 | 免费商城 | 多用户商城 | tpshop｜thinkphp shop｜TPshop 免费开源系统 | 微商城</title>
    <meta name="keywords" content="开源商城 B2C商城  B2B2C商城  三级分销  多用户商城  免费商城  微商城"/>
    <meta name="description" content="TPshop 开源商城 tpshop thinkphp shop B2C商城 B2B2C商城 三级分销 免费商城  微商城 多用户商城 免费开源系统"/>
    <link rel="stylesheet" type="text/css" href="/tpshop/template/pc/rainbow/static/css/alone_index.css"/>
    <script src="/tpshop/template/pc/rainbow/static/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/js/global.js"></script>
    <link rel="stylesheet" href="/tpshop/template/pc/rainbow/static/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
    <link rel="shortcut  icon" type="image/x-icon" href="/public/static/images/favicon.ico" media="screen"/>
</head>
<body class="gray_f5">
    <!--header-s-->
    <div class="tpshop-tm-hander p">
        <!--导航栏-s-->
        <div class="top-hander p">
            <div class="w1224 pr p">
                <div class="fl">
                    <!-- 收货地址，物流运费 -start-->
                    <div class="sendaddress pr fl">
                        <span>送货至：</span>
                        <span>
                            <ul class="list1">
                                <li class="summary-stock though-line">
                                    <div class="dd" style="border-right:0px;width:200px;">
                                        <div class="store-selector add_cj_p">
                                            <div class="text"><div></div><b></b></div>
                                            <div onclick="$(this).parent().removeClass('hover')" class="close"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </span>
                    </div>
                    <!-- 收货地址，物流运费 -end-->
                        <div class="fl nologin">
                            <a class="red" href="/tpshop/index.php/Home/user/login.html">Hi.请登录</a>
                            <a href="/tpshop/index.php/Home/user/reg.html">免费注册</a>
                        </div>
                        <div class="fl islogin">
                            <a class="red userinfo" href="/tpshop/index.php/Home/user/index.html" ></a>
                            <a  href="/tpshop/index.php/Home/user/logout.html"  title="退出" target="_self">安全退出</a>
                        </div>
                </div>
                <div class="top-ri-header fr">
                    <ul>
                        <li><a target="_blank" href="/tpshop/index.php/Home/User/order_list.html">我的订单</a></li>
                        <li class="spacer"></li>
                        <li><a target="_blank" href="/tpshop/index.php/Home/User/visit_log.html">我的浏览</a></li>
                        <li class="spacer"></li>
                        <li><a target="_blank" href="/tpshop/index.php/Home/User/coupon.html">我的优惠券</a></li>
                        <li class="spacer"></li>
                        <li><a target="_blank" href="/tpshop/index.php/Home/User/goods_collect.html">我的收藏</a></li>
                        <li class="spacer"></li>
                        <li><a target="_blank" title="点击这里给我发消息" href="/tpshop/index.php/Home/Article/detail/article_id/22.html" target="_blank">在线客服</a></li>
                        <li class="spacer"></li>
                        <li class="hover-ba-navdh">
                            <div class="nav-dh">
                                <span>网站导航</span>
                                <i class="share-a_a1"></i>
                                <div class="conta-hv-nav">
                                    <ul>
                                        <li>
                                            <a href="/tpshop/index.php/Home/Activity/group_list.html">团购</a>
                                        </li>
                                        <li>
                                            <a href="/tpshop/index.php/Home/Activity/flash_sale_list.html">抢购</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--导航栏-e-->
        <div class="nav-middan-z p">
            <div class="header w1224 p">
                <div class="ecsc-logo">
                    <a href="/tpshop/index.php/home/Index/index.html" class="logo"> <img src="/public/images/newLogo.png"></a>
                </div>
                <!--搜索-s-->
                <div class="ecsc-search">
                    <form id="searchForm" name="" method="get" action="/tpshop/index.php/Home/Goods/search.html" class="ecsc-search-form">
                        <input autocomplete="off" name="q" id="q" type="text" value="" placeholder="搜索关键字" class="ecsc-search-input">
                        <button type="submit" class="ecsc-search-button" onclick="if($.trim($('#q').val()) != '') $('#searchForm').submit();"><i></i></button>
                        <div class="candidate p">
                            <ul id="search_list"></ul>
                        </div>
                        <script type="text/javascript">
                            ;(function($){
                                $.fn.extend({
                                    donetyping: function(callback,timeout){
                                        timeout = timeout || 1e3;
                                        var timeoutReference,
                                                doneTyping = function(el){
                                                    if (!timeoutReference) return;
                                                    timeoutReference = null;
                                                    callback.call(el);
                                                };
                                        return this.each(function(i,el){
                                            var $el = $(el);
                                            $el.is(':input') && $el.on('keyup keypress',function(e){
                                                if (e.type=='keyup' && e.keyCode!=8) return;
                                                if (timeoutReference) clearTimeout(timeoutReference);
                                                timeoutReference = setTimeout(function(){
                                                    doneTyping(el);
                                                }, timeout);
                                            }).on('blur',function(){
                                                doneTyping(el);
                                            });
                                        });
                                    }
                                });
                            })(jQuery);

                            $('.ecsc-search-input').donetyping(function(){
                                search_key();
                            },500).focus(function(){
                                var search_key = $.trim($('#q').val());
                                if(search_key != ''){
                                    $('.candidate').show();
                                }
                            });
                            $('.candidate').mouseleave(function(){
                                $(this).hide();
                            });

                            function searchWord(words){
                                $('#q').val(words);
                                $('#searchForm').submit();
                            }
                            function search_key(){
                                var search_key = $.trim($('#q').val());
                                if(search_key != ''){
                                    $.ajax({
                                        type:'post',
                                        dataType:'json',
                                        data: {key: search_key},
                                        url:"/tpshop/index.php/Home/Api/searchKey.html",
                                        success:function(data){
                                            if(data.status == 1){
                                                var html = '';
                                                $.each(data.result, function (n, value) {
                                                    html += '<li onclick="searchWord(\''+value.keywords+'\');"><div class="search-item">'+value.keywords+'</div><div class="search-count">约'+value.goods_num+'个商品</div></li>';
                                                });
                                                html += '<li class="close"><div class="search-count">关闭</div></li>';
                                                $('#search_list').empty().append(html);
                                                $('.candidate').show();
                                            }else{
                                                $('#search_list').empty();
                                            }
                                        }
                                    });
                                }
                            }
                        </script>
                    </form>
                    <div class="keyword">
                        <ul>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/search/q/%E6%89%8B%E6%9C%BA.html" target="_blank">手机</a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/search/q/%E5%B0%8F%E7%B1%B3.html" target="_blank">小米</a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/search/q/iphone.html" target="_blank">iphone</a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/search/q/%E4%B8%89%E6%98%9F.html" target="_blank">三星</a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/search/q/%E5%8D%8E%E4%B8%BA.html" target="_blank">华为</a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/search/q/%E5%86%B0%E7%AE%B1.html" target="_blank">冰箱</a>
                                </li>
                                                    </ul>
                    </div>
                </div>
                <!--搜索-e-->
                <!--购物车-s-->
                <div class="shopingcar-index fr">
                    <div class="u-g-cart fr fixed" id="hd-my-cart">
                        <a href="/tpshop/index.php/Home/Cart/cart.html">
                            <div class="c-n fl" >
                                <i class="share-shopcar-index"></i>
                                <span>我的购物车</span>
                            </div>
                        </a>
                        <div class="u-fn-cart u-mn-cart" id="show_minicart"></div>
                    </div>
                </div>
                <!--购物车-e-->
            </div>
        </div>
        <!--商品分类-s-->
        <div class="nav p">
            <div class="w1224 p">
                <div class="categorys home_categorys">
                    <div class="dt">
                        <a href="/tpshop/index.php/Home/Goods/all_category.html" target="_blank"><i class="share-a_a2"></i>全部商品分类</a>
                    </div>
                    <!--全部商品分类-s-->
                    <div class="dd">
                        <div class="cata-nav">
                            <!-- 外层循环点-->
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/1.html" title="手机 、 数码 、 通信">手机 、 数码 、 通信</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/12.html" target="_blank">手机配件<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/100.html" target="_blank">电池 电源 充电器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/102.html" target="_blank">贴膜,保护套</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/13.html" target="_blank">摄影摄像<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/103.html" target="_blank">数码相机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/104.html" target="_blank">单反相机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/105.html" target="_blank">摄像机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/106.html" target="_blank">镜头</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/107.html" target="_blank">数码相框</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/14.html" target="_blank">运营商<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/108.html" target="_blank">选号码</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/109.html" target="_blank">办套餐</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/110.html" target="_blank">合约机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/111.html" target="_blank">中国移动</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/15.html" target="_blank">数码配件<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/112.html" target="_blank">充值卡</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/113.html" target="_blank">读卡器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/114.html" target="_blank">支架</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/115.html" target="_blank">滤镜</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/16.html" target="_blank">娱乐影视<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/116.html" target="_blank">音响麦克风</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/117.html" target="_blank">耳机/耳麦</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/17.html" target="_blank">电子教育<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/118.html" target="_blank">学生平板</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/119.html" target="_blank">点读机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/120.html" target="_blank">电纸书</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/121.html" target="_blank">电子词典</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/122.html" target="_blank">复读机</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/18.html" target="_blank">手机通讯<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/124.html" target="_blank">对讲机</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/123.html" target="_blank">手机<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                            </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/2.html" title="家用电器">家用电器</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/19.html" target="_blank">生活电器<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/125.html" target="_blank">录音机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/126.html" target="_blank">饮水机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/127.html" target="_blank">烫衣机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/128.html" target="_blank">电风扇</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/129.html" target="_blank">电话机</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/20.html" target="_blank">大家电<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/130.html" target="_blank">电视</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/131.html" target="_blank">冰箱</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/132.html" target="_blank">空调</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/133.html" target="_blank">洗衣机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/134.html" target="_blank">热水器</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/21.html" target="_blank">厨房电器<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/135.html" target="_blank">料理/榨汁机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/136.html" target="_blank">电饭锅</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/137.html" target="_blank">微波炉</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/138.html" target="_blank">豆浆机</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/22.html" target="_blank">个护健康<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/139.html" target="_blank">剃须刀</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/140.html" target="_blank">吹风机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/141.html" target="_blank">按摩器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/142.html" target="_blank">足浴盆</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/143.html" target="_blank">血压计</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/23.html" target="_blank">五金交电<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/144.html" target="_blank">厨卫五金</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/145.html" target="_blank">门铃门锁</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/146.html" target="_blank">开关插座</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/147.html" target="_blank">电动工具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/148.html" target="_blank">监控安防</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/149.html" target="_blank">仪表仪器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/150.html" target="_blank">电线线缆</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/151.html" target="_blank">浴霸/排气扇</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/152.html" target="_blank">灯具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/153.html" target="_blank">水龙头</a>                                                    </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/3.html" title="电脑、办公">电脑、办公</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/24.html" target="_blank">网络产品<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/154.html" target="_blank">网络配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/155.html" target="_blank">路由器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/156.html" target="_blank">网卡</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/157.html" target="_blank">交换机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/158.html" target="_blank">网络存储</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/159.html" target="_blank">3G/4G/5G上网</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/160.html" target="_blank">网络盒子</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/25.html" target="_blank">办公设备<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/161.html" target="_blank">复合机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/162.html" target="_blank">办公家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/163.html" target="_blank">摄影机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/164.html" target="_blank">碎纸机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/165.html" target="_blank">白板</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/166.html" target="_blank">投影配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/167.html" target="_blank">考勤机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/168.html" target="_blank">多功能一体机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/169.html" target="_blank">收款/POS机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/170.html" target="_blank">打印机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/171.html" target="_blank">会员视频音频</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/172.html" target="_blank">传真设备</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/173.html" target="_blank">保险柜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/174.html" target="_blank">验钞/点钞机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/175.html" target="_blank">装订/封装机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/176.html" target="_blank">扫描设备</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/177.html" target="_blank">安防监控</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/26.html" target="_blank">文具耗材<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/178.html" target="_blank">文具管理</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/179.html" target="_blank">本册便签</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/180.html" target="_blank">硒鼓/墨粉</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/181.html" target="_blank">计算器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/182.html" target="_blank">墨盒</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/183.html" target="_blank">笔类</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/184.html" target="_blank">色带</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/185.html" target="_blank">画具画材</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/186.html" target="_blank">纸类</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/187.html" target="_blank">财会用品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/188.html" target="_blank">办公文具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/189.html" target="_blank">刻录碟片</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/190.html" target="_blank">学生文具</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/27.html" target="_blank">电脑整机<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/191.html" target="_blank">平板电脑</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/192.html" target="_blank">台式机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/193.html" target="_blank">一体机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/194.html" target="_blank">笔记本</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/195.html" target="_blank">超极本</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/28.html" target="_blank">电脑配件<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/196.html" target="_blank">内存</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/197.html" target="_blank">组装电脑</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/198.html" target="_blank">机箱</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/199.html" target="_blank">电源</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/200.html" target="_blank">CPU</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/201.html" target="_blank">显示器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/202.html" target="_blank">主板</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/203.html" target="_blank">刻录机/光驱</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/204.html" target="_blank">显卡</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/205.html" target="_blank">声卡/扩展卡</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/206.html" target="_blank">硬盘</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/207.html" target="_blank">散热器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/208.html" target="_blank">固态硬盘</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/209.html" target="_blank">装机配件</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/29.html" target="_blank">外设产品<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/210.html" target="_blank">线缆</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/211.html" target="_blank">鼠标</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/212.html" target="_blank">手写板</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/213.html" target="_blank">键盘</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/214.html" target="_blank">电脑工具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/215.html" target="_blank">网络仪表仪器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/216.html" target="_blank">UPS</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/217.html" target="_blank">U盘</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/218.html" target="_blank">插座</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/219.html" target="_blank">移动硬盘</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/220.html" target="_blank">鼠标垫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/221.html" target="_blank">摄像头</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/30.html" target="_blank">游戏设备<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/222.html" target="_blank">游戏软件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/223.html" target="_blank">游戏周边</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/224.html" target="_blank">游戏机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/225.html" target="_blank">游戏耳机</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/226.html" target="_blank">手柄方向盘</a>                                                    </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/4.html" title="家居、家具、家装、厨具">家居、家具、家装、厨具</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/31.html" target="_blank">生活日用<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/227.html" target="_blank">清洁工具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/228.html" target="_blank">收纳用品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/229.html" target="_blank">雨伞雨具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/230.html" target="_blank">浴室用品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/231.html" target="_blank">缝纫/针织用品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/232.html" target="_blank">洗晒/熨烫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/233.html" target="_blank">净化除味</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/32.html" target="_blank">家装软饰<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/234.html" target="_blank">节庆饰品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/235.html" target="_blank">手工/十字绣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/236.html" target="_blank">桌布/罩件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/237.html" target="_blank">钟饰</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/238.html" target="_blank">地毯地垫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/239.html" target="_blank">装饰摆件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/240.html" target="_blank">沙发垫套/椅垫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/241.html" target="_blank">花瓶花艺</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/242.html" target="_blank">帘艺隔断</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/243.html" target="_blank">创意家居</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/244.html" target="_blank">相框/照片墙</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/245.html" target="_blank">保暖防护</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/246.html" target="_blank">装饰字画</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/247.html" target="_blank">香薰蜡烛</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/248.html" target="_blank">墙贴/装饰贴</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/33.html" target="_blank">宠物生活<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/249.html" target="_blank">水族用品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/250.html" target="_blank">宠物玩具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/251.html" target="_blank">宠物主粮</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/252.html" target="_blank">宠物牵引</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/253.html" target="_blank">宠物零食</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/254.html" target="_blank">宠物驱虫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/255.html" target="_blank">猫砂/尿布</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/256.html" target="_blank">洗护美容</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/257.html" target="_blank">家居日用</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/258.html" target="_blank">医疗保健</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/259.html" target="_blank">出行装备</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/34.html" target="_blank">厨具<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/260.html" target="_blank">剪刀菜饭</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/261.html" target="_blank">厨房配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/262.html" target="_blank">水具酒具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/263.html" target="_blank">餐具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/264.html" target="_blank">茶具/咖啡具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/265.html" target="_blank">烹饪锅具</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/35.html" target="_blank">家装建材<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/266.html" target="_blank">电工电料</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/267.html" target="_blank">墙地材料</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/268.html" target="_blank">装饰材料</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/269.html" target="_blank">装修服务</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/270.html" target="_blank">沐浴花洒</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/271.html" target="_blank">灯饰照明</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/272.html" target="_blank">开关插座</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/273.html" target="_blank">厨房卫浴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/274.html" target="_blank">油漆涂料</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/275.html" target="_blank">五金工具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/276.html" target="_blank">龙头</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/36.html" target="_blank">家纺<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/277.html" target="_blank">床品套件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/278.html" target="_blank">抱枕靠垫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/279.html" target="_blank">被子</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/280.html" target="_blank">布艺软饰</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/281.html" target="_blank">被芯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/282.html" target="_blank">窗帘窗纱</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/283.html" target="_blank">床单被罩</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/284.html" target="_blank">蚊帐</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/285.html" target="_blank">床垫床褥</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/286.html" target="_blank">凉席</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/287.html" target="_blank">电地毯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/288.html" target="_blank">毯子</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/289.html" target="_blank">毛巾浴巾</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/37.html" target="_blank">家具<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/290.html" target="_blank">餐厅家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/291.html" target="_blank">电脑椅</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/292.html" target="_blank">书房家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/293.html" target="_blank">衣柜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/294.html" target="_blank">储物家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/295.html" target="_blank">茶几</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/296.html" target="_blank">阳台/户外</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/297.html" target="_blank">电视柜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/298.html" target="_blank">商业办公</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/299.html" target="_blank">餐桌</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/300.html" target="_blank">卧室家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/301.html" target="_blank">床</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/302.html" target="_blank">电脑桌</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/303.html" target="_blank">客厅家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/304.html" target="_blank">床垫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/305.html" target="_blank">鞋架/衣帽架</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/306.html" target="_blank">客厅家具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/307.html" target="_blank">沙发</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/38.html" target="_blank">灯具<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/308.html" target="_blank">吸顶灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/309.html" target="_blank">吊灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/310.html" target="_blank">筒灯射灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/311.html" target="_blank">氛围照明</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/312.html" target="_blank">LED灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/313.html" target="_blank">节能灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/314.html" target="_blank">落地灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/315.html" target="_blank">五金电器</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/316.html" target="_blank">应急灯/手电</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/317.html" target="_blank">台灯</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/318.html" target="_blank">装饰灯</a>                                                    </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/5.html" title="男装、女装、童装、内衣">男装、女装、童装、内衣</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/39.html" target="_blank">女装<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/319.html" target="_blank">短外套</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/320.html" target="_blank">羊毛衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/321.html" target="_blank">雪纺衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/322.html" target="_blank">礼服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/323.html" target="_blank">风衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/324.html" target="_blank">羊绒衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/325.html" target="_blank">牛仔裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/326.html" target="_blank">马甲</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/327.html" target="_blank">衬衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/328.html" target="_blank">半身裙</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/329.html" target="_blank">休闲裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/330.html" target="_blank">吊带/背心</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/331.html" target="_blank">羽绒服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/332.html" target="_blank">T恤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/333.html" target="_blank">大码女装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/334.html" target="_blank">正装裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/335.html" target="_blank">设计师/潮牌</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/336.html" target="_blank">毛呢大衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/337.html" target="_blank">小西装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/338.html" target="_blank">中老年女装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/339.html" target="_blank">加绒裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/340.html" target="_blank">棉服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/341.html" target="_blank">打底衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/342.html" target="_blank">皮草</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/343.html" target="_blank">短裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/344.html" target="_blank">连衣裙</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/345.html" target="_blank">打底裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/346.html" target="_blank">真皮皮衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/347.html" target="_blank">婚纱</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/348.html" target="_blank">卫衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/349.html" target="_blank">针织衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/350.html" target="_blank">仿皮皮衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/351.html" target="_blank">旗袍/唐装</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/40.html" target="_blank">男装<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/352.html" target="_blank">羊毛衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/353.html" target="_blank">休闲裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/354.html" target="_blank">POLO衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/355.html" target="_blank">加绒裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/356.html" target="_blank">衬衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/357.html" target="_blank">短裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/358.html" target="_blank">真皮皮衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/359.html" target="_blank">毛呢大衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/360.html" target="_blank">中老年男装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/361.html" target="_blank">卫衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/362.html" target="_blank">风衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/363.html" target="_blank">大码男装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/364.html" target="_blank">羽绒服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/365.html" target="_blank">T恤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/366.html" target="_blank">仿皮皮衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/367.html" target="_blank">羊绒衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/368.html" target="_blank">棉服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/369.html" target="_blank">马甲/背心</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/370.html" target="_blank">西服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/371.html" target="_blank">设计师/潮牌</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/372.html" target="_blank">针织衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/373.html" target="_blank">西服套装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/374.html" target="_blank">西裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/375.html" target="_blank">工装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/376.html" target="_blank">夹克</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/377.html" target="_blank">牛仔裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/378.html" target="_blank">卫裤/运动裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/379.html" target="_blank">唐装/中山装</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/41.html" target="_blank">内衣<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/380.html" target="_blank">保暖内衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/381.html" target="_blank">大码内衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/382.html" target="_blank">吊带/背心</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/383.html" target="_blank">秋衣秋裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/384.html" target="_blank">文胸</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/385.html" target="_blank">内衣配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/386.html" target="_blank">睡衣/家居服</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/387.html" target="_blank">男式内裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/388.html" target="_blank">泳衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/389.html" target="_blank">打底裤袜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/390.html" target="_blank">女式内裤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/391.html" target="_blank">塑身美体</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/392.html" target="_blank">休闲棉袜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/393.html" target="_blank">连裤袜/丝袜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/394.html" target="_blank">美腿袜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/395.html" target="_blank">商务男袜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/396.html" target="_blank">打底衫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/397.html" target="_blank">情趣内衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/398.html" target="_blank">情侣睡衣</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/399.html" target="_blank">少女文胸</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/400.html" target="_blank">文胸套装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/401.html" target="_blank">抹胸</a>                                                    </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/7.html" title="鞋、箱包、珠宝、手表">鞋、箱包、珠宝、手表</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/49.html" target="_blank">精品男包<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/436.html" target="_blank">商务公文包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/437.html" target="_blank">单肩/斜挎包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/438.html" target="_blank">男士手包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/439.html" target="_blank">双肩包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/440.html" target="_blank">钱包/卡包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/441.html" target="_blank">钥匙包</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/50.html" target="_blank">功能箱包<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/442.html" target="_blank">旅行包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/443.html" target="_blank">妈咪包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/444.html" target="_blank">电脑包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/445.html" target="_blank">休闲运动包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/446.html" target="_blank">相机包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/447.html" target="_blank">腰包/胸包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/448.html" target="_blank">登山包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/449.html" target="_blank">旅行配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/450.html" target="_blank">拉杆箱/拉杆包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/451.html" target="_blank">书包</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/51.html" target="_blank">珠宝<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/452.html" target="_blank">彩宝</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/453.html" target="_blank">时尚饰品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/454.html" target="_blank">铂金</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/455.html" target="_blank">钻石</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/456.html" target="_blank">天然木饰</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/457.html" target="_blank">翡翠玉石</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/458.html" target="_blank">珍珠</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/459.html" target="_blank">纯金K金饰品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/460.html" target="_blank">金银投资</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/461.html" target="_blank">银饰</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/462.html" target="_blank">水晶玛瑙</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/52.html" target="_blank">钟表<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/463.html" target="_blank">座钟挂钟</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/464.html" target="_blank">男表</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/465.html" target="_blank">女表</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/466.html" target="_blank">儿童表</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/467.html" target="_blank">智能手表</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/53.html" target="_blank">时尚女鞋<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/468.html" target="_blank">女靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/469.html" target="_blank">布鞋/绣花鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/470.html" target="_blank">鱼嘴鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/471.html" target="_blank">雪地靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/472.html" target="_blank">凉鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/473.html" target="_blank">雨鞋/雨靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/474.html" target="_blank">单鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/475.html" target="_blank">拖鞋/人字拖</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/476.html" target="_blank">鞋配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/477.html" target="_blank">高跟鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/478.html" target="_blank">马丁靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/479.html" target="_blank">帆布鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/480.html" target="_blank">休闲鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/481.html" target="_blank">妈妈鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/482.html" target="_blank">踝靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/483.html" target="_blank">防水台</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/484.html" target="_blank">内增高</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/485.html" target="_blank">松糕鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/486.html" target="_blank">坡跟鞋</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/54.html" target="_blank">流行男鞋<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/487.html" target="_blank">增高鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/488.html" target="_blank">鞋配件</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/489.html" target="_blank">拖鞋/人字拖</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/490.html" target="_blank">凉鞋/沙滩鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/491.html" target="_blank">休闲鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/492.html" target="_blank">雨鞋/雨靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/493.html" target="_blank">商务休闲鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/494.html" target="_blank">定制鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/495.html" target="_blank">正装鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/496.html" target="_blank">男靴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/497.html" target="_blank">帆布鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/498.html" target="_blank">传统布鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/499.html" target="_blank">工装鞋</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/500.html" target="_blank">功能鞋</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/55.html" target="_blank">潮流女包<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/501.html" target="_blank">钥匙包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/502.html" target="_blank">单肩包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/503.html" target="_blank">手提包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/504.html" target="_blank">斜挎包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/505.html" target="_blank">双肩包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/506.html" target="_blank">钱包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/507.html" target="_blank">手拿包/晚宴包</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/508.html" target="_blank">卡包/零钱包</a>                                                    </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                        <div class="item fore1">
                                                                <div class="item-left">
                                    <div class="cata-nav-name">
                                        <h3>
                                            <div class="contiw-cer"><span class="share-icon-phone"></span></div>
                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/6.html" title="个人化妆">个人化妆</a>
                                        </h3>
                                    </div>
                                    <b>&gt;</b>
                                </div>
                                                                <div class="cata-nav-layer">
                                    <div class="cata-nav-left">
                                        <div class="subitems">
                                                                                            <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/42.html" target="_blank">身体护肤<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/402.html" target="_blank">沐浴</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/403.html" target="_blank">润肤</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/404.html" target="_blank">颈部</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/405.html" target="_blank">手足</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/406.html" target="_blank">纤体塑形</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/407.html" target="_blank">美胸</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/408.html" target="_blank">套装</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/43.html" target="_blank">口腔护理<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/409.html" target="_blank">牙膏/牙粉</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/410.html" target="_blank">牙刷/牙线</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/411.html" target="_blank">漱口水</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/412.html" target="_blank">套装</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/44.html" target="_blank">女性护理<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/413.html" target="_blank">卫生巾</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/414.html" target="_blank">卫生护垫</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/415.html" target="_blank">私密护理</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/416.html" target="_blank">脱毛膏</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/45.html" target="_blank">香水彩妆<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/417.html" target="_blank">唇部</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/418.html" target="_blank">美甲</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/419.html" target="_blank">美容工具</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/420.html" target="_blank">套装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/421.html" target="_blank">香水</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/422.html" target="_blank">底妆</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/423.html" target="_blank">腮红</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/424.html" target="_blank">眼部</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/46.html" target="_blank">清洁用品<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/95.html" target="_blank">纸品湿巾</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/96.html" target="_blank">衣物清洁</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/97.html" target="_blank">家庭清洁</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/98.html" target="_blank">一次性用品</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/99.html" target="_blank">驱虫用品</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/47.html" target="_blank">面部护肤<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/425.html" target="_blank">面膜</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/426.html" target="_blank">剃须</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/427.html" target="_blank">套装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/428.html" target="_blank">清洁</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/429.html" target="_blank">护肤</a>                                                    </dd>
                                                </dl>
                                                                                                <dl><!-- 2级循环点-->
                                                    <dt>
                                                        <a href="/tpshop/index.php/Home/Goods/goodsList/id/48.html" target="_blank">洗发护发<i>&gt;</i></a>
                                                    </dt>
                                                    <dd>
                                                                                                                    <a href="/tpshop/index.php/Home/Goods/goodsList/id/430.html" target="_blank">套装</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/431.html" target="_blank">洗发</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/432.html" target="_blank">护发</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/433.html" target="_blank">染发</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/434.html" target="_blank">造型</a>                                                            <a href="/tpshop/index.php/Home/Goods/goodsList/id/435.html" target="_blank">假发</a>                                                    </dd>
                                                </dl>
                                                                                            <!--商品分类底部广告-s-->
                                            <div class="advertisement_down">
                                                <ul>                                                
                                                                                                            <li>
                                                            <a href="http://www.tp-shop.cn/" >
                                                                <img src="/public/upload/ad/2017/05-20/b6978d49ea385b990772c356af29d54f.jpg" title="" style="" width="129" height="45"/>
                                                            </a>
                                                        </li>
                                                                                                    
                                                </ul>
                                            </div>
                                            <!--商品分类底部广告-e-->
                                        </div>
                                    </div>
                                    <!--商品分类右侧广告-s-->
                                    <div class="cata-nav-rigth">
                                                                                    <a href="http://www.tp-shop.cn" target="_blank">
                                                <img src="/public/upload/ad/2017/05-20/aa6a2d01e781859ca75eb915c7fa27ce.jpg" title="" style=""/>
                                            </a>
                                                                            </div>
                                    <!--商品分类右侧广告-e-->
                                </div>
                            </div>
                                                    </div>
                    </div>
                    <!--全部商品分类-e-->
                </div>
                <!--导航栏-s-->
                 <div class="navitems" id="nav">
                    <ul>
                        <li class="index_modify">
                            <a href="/tpshop/index.php/home/Index/index.html" class="selected">首页</a>
                        </li>
                                                    <li class="page"><a href="/index.php?m=Home&amp;c=Goods&amp;a=goodsList&amp;id=123" target="_blank" <span>手机城</span></a></li>
                                                    <li class="page"><a href="/index.php?m=Home&amp;c=Goods&amp;a=goodsList&amp;id=51" target="_blank" <span>珠宝</span></a></li>
                                                    <li class="page"><a href="/index.php?m=Home&amp;c=Goods&amp;a=goodsList&amp;id=20" target="_blank" <span>家电城</span></a></li>
                                                    <li class="page"><a href="/index.php?m=Home&c=Activity&a=promoteList" <span>促销商品</span></a></li>
                                                    <li class="page"><a href="/index.php?m=Home&amp;c=Goods&amp;a=goodsList&amp;id=45" target="_blank" <span>化妆品</span></a></li>
                                                    <li class="page"><a href="/index.php/Home/Goods/goodsList/id/1.html" target="_blank" <span>数码城</span></a></li>
                                                    <li class="page"><a href="/index.php?m=Home&amp;c=Activity&amp;a=group_list" <span>团购</span></a></li>
                                                    <li class="page"><a href="/index.php?m=Home&amp;c=Goods&amp;a=integralMall" <span>积分商城</span></a></li>
                                            </ul>
                    <!-- <div class="wrap-line" style="width: 72px; left: 20px;">
                        <span style="left:15px;"></span>
                    </div> -->
                </div>
                <!--导航栏-e-->
            </div>
        </div>
        <!--商品分类-e-->
    </div>
    <!--header-e-->
    <!--轮播图-s-->
    <div id="myCarousel" class="carousel slide p header-tp" data-ride="carousel">
        <ol class="carousel-indicators">

        </ol>
        <div class="carousel-inner">
        	                <div class="item active" style="background:;">
                    <a href="http://www.tp-shop.cn"  target="_blank">
                        <img  src="/public/upload/ad/2017/05-20/5b3261f64a247198d8c23a2d4bf3f8b7.jpg" title="" style="">
                    </a>
                </div>
                            <div class="item " style="background:;">
                    <a href="http://www.tp-shop.cn"  target="_blank">
                        <img  src="/public/upload/ad/2017/05-20/d4dff2e69fc808175a0babf32b31dece.jpg" title="" style="">
                    </a>
                </div>
                            <div class="item " style="background:;">
                    <a href="http://www.tp-shop.cn"  target="_blank">
                        <img  src="/public/upload/ad/2017/05-20/0987cc2bba830e3e941d4e1f17fc7c2a.jpg" title="" style="">
                    </a>
                </div>
                            <div class="item " style="background:;">
                    <a href="http://www.tp-shop.cn"  target="_blank">
                        <img  src="/public/upload/ad/2017/05-20/5b3261f64a247198d8c23a2d4bf3f8b7.jpg" title="" style="">
                    </a>
                </div>
                            <div class="item " style="background:;">
                    <a href="http://www.tp-shop.cn"  target="_blank">
                        <img  src="/public/upload/ad/2017/05-20/d4dff2e69fc808175a0babf32b31dece.jpg" title="" style="">
                    </a>
                </div>
                    </div>
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        <!--轮播图右侧广告-s-->
        <div class="adcertiserment_head">
            <div class="w1224">
                <ul>
                                            <li>
                            <a href="http://www.tp-shop.cn" target="_blank">
                            <img src="/public/upload/ad/2017/05-20/3a7d38f409a1729fb14b14b3df6fe2ee.png" title="" style=""/>
                            </a>
                        </li>
                                            <li>
                            <a href="http://www.tp-shop.cn" target="_blank">
                            <img src="/public/upload/ad/2017/05-20/86ffc745a959b360f9307d844ae3d562.png" title="" style=""/>
                            </a>
                        </li>
                                    </ul>
            </div>
        </div>
        <!--轮播图右侧广告-e-->
    </div>
    <!--轮播图-e-->
    <!--轮播图底部广告-s-->
    <div class="adv3 p">
        <div class="w1224">
            <ul>
                                    <li>
                        <a href="http://www.tp-shop.cn" target="_blank">
                            <img src="/public/upload/ad/2017/05-20/8ef6780ae11a771bae7a18e4b7f7f26a.jpg" title="" style=""/>
                        </a>
                    </li>
                                    <li>
                        <a href="http://www.tp-shop.cn" target="_blank">
                            <img src="/public/upload/ad/2017/05-20/a5029f75c12b2abe25e06910f105f27a.jpg" title="" style=""/>
                        </a>
                    </li>
                                    <li>
                        <a href="http://www.tp-shop.cn" target="_blank">
                            <img src="/public/upload/ad/2017/05-20/8e173c51d5d7589b43258d09c9bd2078.jpg" title="" style=""/>
                        </a>
                    </li>
                            </ul>
        </div>
    </div>
    <!--轮播图底部广告-e-->
    <div class="adver_line">
        <div class="w1224">
                            <a href="http://www.tp-shop.cn" target="_blank">
                <img src="/public/upload/ad/2017/05-20/650182d2eb12c7e3918922546e3046a8.jpg" width="1200" height="160"  title="" style=""/>
                </a>
                    </div>
    </div>

<!--------楼层-开始-------------->
        <!--商品楼层-s-->
        <div class="layer-floor " id="floor1">
            <div class="w1224">
            <div class="top_title_layer p">
                <div class="part-title">手机 、 数码 、 通信</div>
                <div class="part-hot">
                    <ul>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/12.html">手机配件</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/13.html">摄影摄像</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/14.html">运营商</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/15.html">数码配件</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/16.html">娱乐影视</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/17.html">电子教育</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/18.html">手机通讯</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/123.html">手机</a>
                            </li>
                                            </ul>
                </div>
            </div>
            <div class="main_layer p">
                <div class="hoste_le">  
                                           <a class="big_adve" href="http://www.tp-shop.cn" target="_blank">
                        <img src="/public/upload/ad/2017/05-20/beb9499df9215c2412c8cc8b5a46a75f.jpg" width="232" height="571"  title="" style=""/>
                        </a>
                                        
                    
                </div>
                <div class="hoste_ri">
                    <ul>
                                                        <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/115.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">爸爸2陆毅代言索扬20000毫...</span>
                                        <!--<span class="intro_main">电池 电源 充电器</span>-->
                                        <span class="price_main"><i>￥</i>84.90</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/105.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">原封国行【优惠套餐】Apple...</span>
                                        <!--<span class="intro_main">手机</span>-->
                                        <span class="price_main"><i>￥</i>5588.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/104.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">小米手机5,十余项黑科技，很轻...</span>
                                        <!--<span class="intro_main">手机</span>-->
                                        <span class="price_main"><i>￥</i>2999.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/116.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">ROMOSS/罗马仕 sens...</span>
                                        <!--<span class="intro_main">电池 电源 充电器</span>-->
                                        <span class="price_main"><i>￥</i>89.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/117.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">小派M-20000超薄充电宝适...</span>
                                        <!--<span class="intro_main">电池 电源 充电器</span>-->
                                        <span class="price_main"><i>￥</i>69.90</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/132.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">中国电信4G号卡手机卡电话卡上...</span>
                                        <!--<span class="intro_main">选号码</span>-->
                                        <span class="price_main"><i>￥</i>1200.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/133.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">电信手机卡 电信4G流量卡全国...</span>
                                        <!--<span class="intro_main">选号码</span>-->
                                        <span class="price_main"><i>￥</i>100.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/134.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">中国电信4G号卡手机卡电话卡上...</span>
                                        <!--<span class="intro_main">选号码</span>-->
                                        <span class="price_main"><i>￥</i>120.00</span>
                                    </a>
                                </li>
                                                </ul>
                </div>
            </div>
        </div>
        </div>
    <!--商品楼层-e-->
        <!--商品楼层-s-->
        <div class="layer-floor " id="floor2">
            <div class="w1224">
            <div class="top_title_layer p">
                <div class="part-title">家用电器</div>
                <div class="part-hot">
                    <ul>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/19.html">生活电器</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/20.html">大家电</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/21.html">厨房电器</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/22.html">个护健康</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/23.html">五金交电</a>
                            </li>
                                            </ul>
                </div>
            </div>
            <div class="main_layer p">
                <div class="hoste_le">  
                                           <a class="big_adve" href="http://www.tp-shop.cn" target="_blank">
                        <img src="/public/upload/ad/2017/05-20/13cab56b9c1214bbff54208884e54713.png" width="232" height="571"  title="" style=""/>
                        </a>
                                        
                    
                </div>
                <div class="hoste_ri">
                    <ul>
                                                        <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/65.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">长虹(CHANGHONG) 4...</span>
                                        <!--<span class="intro_main">电视</span>-->
                                        <span class="price_main"><i>￥</i>2799.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/106.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Haier/海尔 BCD-57...</span>
                                        <!--<span class="intro_main">冰箱</span>-->
                                        <span class="price_main"><i>￥</i>3399.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/107.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Littleswan/小天鹅 ...</span>
                                        <!--<span class="intro_main">洗衣机</span>-->
                                        <span class="price_main"><i>￥</i>1788.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/108.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Haier/海尔 EG8012...</span>
                                        <!--<span class="intro_main">洗衣机</span>-->
                                        <span class="price_main"><i>￥</i>1999.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/109.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Midea/美的 BCD-53...</span>
                                        <!--<span class="intro_main">冰箱</span>-->
                                        <span class="price_main"><i>￥</i>3499.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/110.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Ronshen/容声 BCD-...</span>
                                        <!--<span class="intro_main">冰箱</span>-->
                                        <span class="price_main"><i>￥</i>1599.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/111.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Haier/海尔 BCD-16...</span>
                                        <!--<span class="intro_main">冰箱</span>-->
                                        <span class="price_main"><i>￥</i>1099.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/112.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Haier/海尔 BCD-64...</span>
                                        <!--<span class="intro_main">冰箱</span>-->
                                        <span class="price_main"><i>￥</i>3999.00</span>
                                    </a>
                                </li>
                                                </ul>
                </div>
            </div>
        </div>
        </div>
    <!--商品楼层-e-->
        <!--商品楼层-s-->
        <div class="layer-floor " id="floor3">
            <div class="w1224">
            <div class="top_title_layer p">
                <div class="part-title">电脑、办公</div>
                <div class="part-hot">
                    <ul>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/24.html">网络产品</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/25.html">办公设备</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/26.html">文具耗材</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/27.html">电脑整机</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/28.html">电脑配件</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/29.html">外设产品</a>
                            </li>
                                                    <li>
                                <a href="/tpshop/index.php/Home/Goods/goodsList/id/30.html">游戏设备</a>
                            </li>
                                            </ul>
                </div>
            </div>
            <div class="main_layer p">
                <div class="hoste_le">  
                                           <a class="big_adve" href="http://www.tp-shop.cn" target="_blank">
                        <img src="/public/upload/ad/2017/05-20/b2c6cdbcb6e1e83febabeec75ffdd94f.png" width="232" height="571"  title="" style=""/>
                        </a>
                                        
                    
                </div>
                <div class="hoste_ri">
                    <ul>
                                                        <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/52.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">荣耀路由Pro 大户型穿墙王1...</span>
                                        <!--<span class="intro_main">路由器</span>-->
                                        <span class="price_main"><i>￥</i>328.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/53.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">华为 HUAWEI Media...</span>
                                        <!--<span class="intro_main">网络盒子</span>-->
                                        <span class="price_main"><i>￥</i>349.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/54.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">荣耀盒子 标准版（4K，H.2...</span>
                                        <!--<span class="intro_main">网络盒子</span>-->
                                        <span class="price_main"><i>￥</i>258.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/55.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">华为（HUAWEI）WS832...</span>
                                        <!--<span class="intro_main">路由器</span>-->
                                        <span class="price_main"><i>￥</i>259.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/39.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">华为（HUAWEI） M2 1...</span>
                                        <!--<span class="intro_main">平板电脑</span>-->
                                        <span class="price_main"><i>￥</i>2288.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/40.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">荣耀X2 标准版 双卡双待双通...</span>
                                        <!--<span class="intro_main">平板电脑</span>-->
                                        <span class="price_main"><i>￥</i>1999.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/41.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">华为（HUAWEI） M2 8...</span>
                                        <!--<span class="intro_main">平板电脑</span>-->
                                        <span class="price_main"><i>￥</i>1588.00</span>
                                    </a>
                                </li>
                                                            <li>
                                    <a href="/tpshop/index.php/Home/Goods/goodsInfo/id/42.html">
                                        <img class="picture_main" src="/tpshop/"/>
                                        <span class="name_main">Teclast/台电 X80 ...</span>
                                        <!--<span class="intro_main">平板电脑</span>-->
                                        <span class="price_main"><i>￥</i>499.00</span>
                                    </a>
                                </li>
                                                </ul>
                </div>
            </div>
        </div>
        </div>
    <!--商品楼层-e-->
        <!--楼层导航-s-->
    <div class="floornav_left">
        <ul>
                            <li class="elevators">
                    <a >1F<span class="cofin_floor">数码产品</span></a>
                </li>
                            <li class="elevators">
                    <a >2F<span class="cofin_floor">家用电器</span></a>
                </li>
                            <li class="elevators">
                    <a >3F<span class="cofin_floor">电脑</span></a>
                </li>
                    </ul>
    </div>
    <!--楼层导航-e-->
<!--------楼层-结束-------------->

    <!--footer-s-->
    <div class="foot-alone">
        <div class="foot-banner">
            <div class="w1224">
                <div class="sum_baner">
                    <div class="baner-item">
                        <a href="">
                            <i class="icon1">7</i>
                            7天无理由退货
                        </a>
                    </div>
                    <div class="baner-item">
                        <a href="">
                            <i class="icon1">15</i>
                            15天免费换货
                        </a>
                    </div>
                    <div class="baner-item">
                        <a href="">
                            <i class="icon1">99</i>
                            满99元包邮
                        </a>
                    </div>
                    <div class="baner-item">
                        <a href="">
                            <i class="icon1">服</i>
                            手机特色服务
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="foot-main">
            <div class="w1224">
                <div class="sum_main">
                                            <dl class="foot-con">
                            <dt>售后服务</dt>
                                                        <dd>
                                <a target="_blank" href="/tpshop/index.php/Home/Article/detail/article_id/1.html">保修日期</a>
                            </dd>
                                                        <dd>
                                <a target="_blank" href="/tpshop/index.php/Home/Article/detail/article_id/12.html">保修政策</a>
                            </dd>
                                                        <dd>
                                <a target="_blank" href="/tpshop/index.php/Home/Article/detail/article_id/13.html">退换货政策</a>
                            </dd>
                                                        <dd>
                                <a target="_blank" href="/tpshop/index.php/Home/Article/detail/article_id/14.html">退换货流程</a>
                            </dd>
                                                    </dl>
                                            <dl class="foot-con">
                            <dt>关于我们</dt>
                                                    </dl>
                                            <dl class="foot-con">
                            <dt>新手上路 </dt>
                                                    </dl>
                                            <dl class="foot-con">
                            <dt>购物指南</dt>
                                                    </dl>
                                            <dl class="foot-con">
                            <dt>配送方式 </dt>
                                                    </dl>
                                        <dl class="foot-con continue">
                        <dt>联系我们</dt>
                        <dd>
                            <span class="cellphone_con">123456789</span>
                            <span class="time_con">周一至周日8:00-18:00</span>
                            <span class="cost_con">（仅收市话费）</span>
                            <a class="software_con" href="tencent://message/?uin=123456789&amp;Site=TPshop商城&amp;Menu=yes" target="_blank">
                                <img src="/tpshop/template/pc/rainbow/static/images/continue.png"/>
                            </a>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="foot-bottom">
            <p>Copyright © 2016-2025 TPshop商城 版权所有 保留一切权利 备案号:粤12345678号号</p>
        </div>
    </div>
    <!--侧边栏-s-->
    <div class="slidebar_alo">
        <ul>
            <li class="re_cuso"><a title="点击这里给我发消息" href="tencent://message/?uin=123456789&amp;Site=TPshop商城&amp;Menu=yes" target="_blank">客服服务</a></li>
            <li class="re_wechat">
                <a target="_blank" href="" >微信关注</a>
                <div class="rtipscont" style="">
                    <span class="arrowr-bg"></span>
                    <span class="arrowr"></span>
                    <img src="/tpshop/template/pc/rainbow/static/images/qrcode.png" />
                    <p class="tiptext">扫码关注官方微信<br>先人一步知晓促销活动</p>
                </div>
            </li>
            <li class="re_phone">
                <a target="_blank" href="/tpshop/index.php/Mobile/Index/index.html" >手机商城</a>
                <div class="rtipscont rstoretips" style="">
                    <span class="arrowr-bg"></span>
                    <span class="arrowr"></span>
                    <img src="/tpshop/template/pc/rainbow/static/images/qrcode.png" />
                    <p class="tiptext">扫码关注官方微信<br>先人一步知晓促销活动</p>
                </div>
            </li>
            <li class="re_top"><a target="_blank" href="javascript:void(0);" >回到顶部</a></li>
        </ul>
    </div>
    <!--侧边栏-e-->
    <!--footer-e-->
    <script src="/tpshop/template/pc/rainbow/static/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script src="/tpshop/template/pc/rainbow/static/js/carousel.js" type="text/javascript" charset="utf-8"></script>
    <script src="/tpshop/template/pc/rainbow/static/js/transition.js" type="text/javascript" charset="utf-8"></script>
    <script src="/tpshop/template/pc/rainbow/static/js/headerfooter_alone.js" type="text/javascript" charset="utf-8"></script>
    <!--------收货地址，物流运费-开始-------------->
    <script src="/tpshop/template/pc/rainbow/static/js/location.js"></script>
    <!--------收货地址，物流运费--结束-------------->
    <script type="text/javascript">
        $(function() {
            //首页商品分类显示
            $('.categorys .dd').show();

                var uname= getCookie('uname');
                if(uname == ''){
                    $('.islogin').hide();
                    $('.nologin').show();
                }else{
                    $('.nologin').hide();
                    $('.islogin').show();
                    //获取用户名
                    $('.userinfo').html(decodeURIComponent(uname));
                }
        })
        $(function() { //轮播自动播放
            $(".carousel").carousel({interval: 2000});
        });
        $(function() { //floor分类鼠标滑动
            $(".f_tab li").each(function() {
                $(this).hoverDelay({
                    hoverEvent: function() {
                        $(this).addClass('ft');
                        $(this).siblings().removeClass('ft');
                    },
//			    		outEvent: function(){
//			        		$(this).siblings().removeClass('ft'); 
//			    		}
                });
            })
        });
        /**
         * 鼠标移动端到头部购物车上面 就ajax 加载
         */
        // 鼠标是否移动到了上方
        var header_cart_list_over = 0;
        $("#hd-my-cart > .c-n").hover(function(){
            if(header_cart_list_over == 1)
                return false;
            header_cart_list_over = 1;
            $.ajax({
                type : "GET",
                url:"/tpshop/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
                success: function(data){
                    $("#show_minicart").html(data);
                }
            });
        }).mouseout(function(){

            (typeof(t) == "undefined") || clearTimeout(t);
            t = setTimeout(function () {
                header_cart_list_over = 0; /// 标识鼠标已经离开
            }, 1000);
        });
    //楼层按钮
        //楼层添加data-mid
    $(function(){
        var Dum = {};
        Dum.brand = {
            i:0,
            ri:function(e){
                $(e).each(function(){
                    $(this).attr('id','brand_' + Dum.brand.i);
                    Dum.brand.i++
                })
                Dum.brand.i = 0;
                return Dum.brand.i;
            },
        }
        Dum.brand.ri(".layer-floor");
    })
    //侧边导航
    $(function(){
        $(window).scroll(function(){
            var main_brand = $('.adv3').offset().top;
            var scr = $(document).scrollTop();
            if(scr >= main_brand){
                $('.floornav_left').addClass('showfloornav');
            }else{
                $('.floornav_left').removeClass('showfloornav');
            }
        })

        var _index=0;
        var scr = $(document).scrollTop();
        $(".floornav_left ul li").click(function(){
            _index=$(this).index();
            //通过拼接字符串获取元素，再取得相对于文档的高度
            var _top=$("#brand_"+_index).offset().top + 1;//Firefox有1px的误差
            //scrollTop滚动到对应高度
            $("body,html").animate({scrollTop:_top},500);
        });
        $(window).scroll(function(){
            var tj = [];
            var strlength = $('.layer-floor').length;
            var stheigh = $('.layer-floor').eq(strlength - 1).height();//最后一个楼层的高度
            var scr = $(document).scrollTop();
            $('.layer-floor').each(function(i){
                var sthei = $(this).offset().top;
                tj.push(sthei);//楼层距离顶部的高度添加进数组
            })
            for(var n = 0;n < strlength;n++){
                if(scr >= tj[n] && scr <= tj[n] + stheigh){
                    $(".floornav_left ul li").eq(n).addClass("darkshow").siblings().removeClass("darkshow");
                }
            }
        });
    })
    </script>
</body>
</html>
";
?>