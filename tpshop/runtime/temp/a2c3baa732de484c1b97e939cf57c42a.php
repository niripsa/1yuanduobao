<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:45:"./template/pc/rainbow/goods\integralMall.html";i:1497534904;s:47:"./template/pc/rainbow/public\toolbar_index.html";i:1497795035;s:40:"./template/pc/rainbow/public\header.html";i:1497453671;s:46:"./template/pc/rainbow/public\footer_index.html";i:1497535688;s:46:"./template/pc/rainbow/public\sidebar_cart.html";i:1497452888;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>一元商城-积分商城</title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/tpshop/__PUBLIC__/js/layer/layer-min.js"></script>
		<script src="/tpshop/__PUBLIC__/js/global.js"></script>
		<script src="/tpshop/__PUBLIC__/js/pc_common.js"></script>
	</head>
	<body>
	<!--header-s-->
	<script type="text/javascript">
$(document).ready( function() {
/* 我的夺宝 指向 移除 效果 */
  $("#li_my_duobao").mouseover( function() {
    $(this).addClass( "m-toolbar-myDuobao-hover" );
  });
  $("#li_my_duobao").mouseout( function() {
    $(this).removeClass( "m-toolbar-myDuobao-hover" );
  });
});
</script>
<div class="g-header">
    <div class="m-toolbar" module="toolbar/Toolbar">
        <div class="g-wrap f-clear">
            <div class="m-toolbar-l">
                <ul id="list1" style="width:620px;">
                    <li id="summary-stock">
                        <div class="dt" id='show_area_name'></div>
                        
                        <div class="dd">
                            <div id="store-selector">
                                <div class="text"><div></div><b></b></div>
                                <div onclick="$('#store-selector').removeClass('hover')" class="close"></div>
                            </div>
                            <div id="store-prompt"><strong></strong></div>
                        </div>
                    </li>
                </ul>
          
                <script src="/statics/templates/newtemplates/js_163/location.js"></script>
            </div>
            <ul class="m-toolbar-r">
                <li class="m-toolbar-login">
                <div id="pro-view-5">
                <?php if($user_is_login['name']): ?>
                    欢迎您:　<a class="m-toolbar-nickname" href="/?/member/home/userindex" title="<?php echo $user_is_login['name']; ?>">
                    <?php echo $user_is_login['name']; ?>
                    </a>
                    <a class="m-toolbar-logout-btn" href="/?/member/user/logout">[ 退出 ]</a>
                <?php else: ?>
                    <a class="m-toolbar-login-btn" href="/?/member/user/login">请登录</a>
                    <a href="/?/member/user/register" target="_blank">免费注册</a>
                <?php endif; ?>
                </div>
                </li>
                <li id="li_my_duobao" class="m-toolbar-myDuobao">
                    <a class="m-toolbar-myDuobao-btn" href="/">我的购买 <i class="ico ico-arrow-gray-s ico-arrow-gray-s-down"></i></a>
                    <ul class="m-toolbar-myDuobao-menu">
                        <li><a href="/tpshop/index.php/home/User/order_list.html">购买记录</a></li>
                        <li><a href="/?/member/account/userrecharg">账户充值</a></li>
                    </ul>
                </li>             
            </ul>
        </div>
    </div>
    <?php if($not_display != 1): ?>
    <div class="m-header">
        <div class="g-wrap f-clear">
            <div class="m-header-logo">
                <h1><a class="m-header-logo-link" href="/">一元夺宝</a></h1>
          <!--       <div class="m-header-slogan">
                    <a class="m-header-slogan-link" href="/" target="_blank">
                    <img src="{G_TEMPLATES_STYLE}/images/logo_banner_v3.png">
                    </a>
                </div> -->
                    <div class="nav-middan-z p">
        <div class="header [w]">
            <div class="ecsc-search">
                <form id="sourch_form" name="sourch_form" method="post" action="<?php echo U('Home/Goods/search'); ?>" class="ecsc-search-form">
                    <div class="ecsc-search-tabs">
                        <i class="sc-icon-right"></i>
                        <ul class="shop_search" id="shop_search">
                            <li rev="0"><span id="sp">商品</span></li>
                        </ul>
                    </div>
                    <input autocomplete="off" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>" placeholder="搜索关键字" class="ecsc-search-input">
                    <button type="submit" class="ecsc-search-button" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();"><i></i></button>
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
                            $('#sourch_form').submit();
                        }
                        function search_key(){
                            var search_key = $.trim($('#q').val());
                            if(search_key != ''){
                                $.ajax({
                                    type:'post',
                                    dataType:'json',
                                    data: {key: search_key},
                                    url:"<?php echo U('Home/Api/searchKey'); ?>",
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
                        <?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection || $tpshop_config['hot_keywords'] instanceof \think\Paginator): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
                            <li>
                                <a href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>" target="_blank"><?php echo $wd; ?></a>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="shopingcar-index fr">
            </div>
        </div>
    </div>
            </div>
        </div>

</div>
<?php endif; ?>
	<div class="tpshop-tm-hander p">
    <div class="nav p">
        <div class="w1224 p">
        
        </div>
    </div>
</div>

		<!--header-e-->
		<div class="search-box p">
			<div class="w1224">
				<div class="search-path fl">
					<a href="<?php echo U('Home/Goods/integralMall'); ?>">全部结果</a>
					<i class="litt-xyb"></i>
					<span>积分商城</span>
				</div>
				<div class="search-clear fr">
					<span><a href="<?php echo U('Home/Goods/integralMall'); ?>">清空筛选条件</a></span>
				</div>
			</div>
		</div>
    <!--分类-s-->
		<div class="search-opt classify">
			<div class="w1224">
				<div class="opt-list">
					<dl class="brand-section">
						<dt>分类:</dt>
						<dd class="ri-section">
							<div class="lf-list">
								<div class="brand-list">
									<div class="clearfix p">
										<a href="<?php echo U('Home/Goods/integralMall'); ?>">
											<span <?php if(\think\Request::instance()->param('id') == ''): ?>class="red"<?php endif; ?>>全部</span>
										</a>
                                        <?php if(is_array($goods_category) || $goods_category instanceof \think\Collection || $goods_category instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gc): $mod = ($i % 2 );++$i;?>
                                            <a href="<?php echo U('Home/Goods/integralMall',array('id'=>$gc['id'])); ?>">
                                                <span <?php if(\think\Request::instance()->param('id') == $gc[id]): ?>class="red"<?php endif; ?>><?php echo $gc['name']; ?></span>
                                            </a>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							</div>
						</dd>
					</dl>
				</div>
			</div>
		</div>
    <!--分类-e-->
		<div class="shop-list-tour ma-to-20 p">
			<div class="w1224">
				<div class="stsho pre-sts intergra">
					<div class="sx_topb presellall">
						<div class="f-sort fl">
							<ul>
								<li <?php if(\think\Request::instance()->param('brandType') == '0'): ?>class="red"<?php endif; ?>><a href="<?php echo U('Home/Goods/integralMall',array_merge(I('get.'),array('brandType'=>0))); ?>">全部<i class="jta jta-w"></i></a></li>
								<li <?php if(\think\Request::instance()->param('brandType') == '1'): ?>class="red"<?php endif; ?>><a href="<?php echo U('Home/Goods/integralMall',array_merge(I('get.'),array('brandType'=>1))); ?>">积分+金额<i class="jta"></i></a></li>
								<li <?php if(\think\Request::instance()->param('brandType') == '2'): ?>class="red"<?php endif; ?>><a href="<?php echo U('Home/Goods/integralMall',array_merge(I('get.'),array('brandType'=>2))); ?>">全积分<i class="jta"></i></a></li>
							</ul>
						</div>
						<div class="f-total fr">
                            <div class="all-sec">共<span><?php echo $goods_list_count; ?></span>个商品</div>
							<div class="all-fy">
                                <a <?php if($nowPage > 1): ?>href="<?php echo U('Home/Goods/integralMall',array_merge(I('get.'),array('p'=>$nowPage-1))); ?>" <?php endif; ?>>&lt;</a>
                                <p class="fy-y"><span class="z-cur"><?php echo $nowPage; ?></span>/<span><?php echo $totalPages; ?></span></p>
                                <a <?php if(($nowPage+1) < $totalPages): ?>href="<?php echo U('Home/Goods/integralMall',array('p'=>$nowPage+1)); ?>"<?php endif; ?>>&gt;</a>
                            </div>
						</div>
					</div>
					<div class="he-rin p"></div>
                    <!--商品-s-->
					<div class="jpateki p">
                        <?php if(empty($goods_list) || (($goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator ) && $goods_list->isEmpty())): ?>
                            <p class="ncyekjl" style="font-size: 16px;margin:100px auto;text-align: center;">--暂无此类商品--</p>
                        <?php else: if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;if(($i-1)%3 == 0): ?>
								<ul>
							<?php endif; ?>
								<li <?php if($i%3 == 0): ?>class="mar0"<?php endif; ?>>
									<div class="sbox">
										<div class="contelim">
											<img src="/tpshop/<?php echo goods_thum_images($goods['goods_id'],165,188); ?>"/>
										</div>
										<div class="contifo">
											<p class="shop_name"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>"><?php echo $goods['goods_name']; ?></a></p>
											<p>参考价：￥<span class="lithe"><?php echo $goods['shop_price']; ?></span></p>
											<p>换购价：<span class="red">￥<em><?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?></em>积分</span></p>
											<div class="duchan">
												<span><em><?php echo $goods['sales_sum']; ?></em>人换购</span>
												<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">立即换购</a>
											</div>
										</div>
									</div>
								</li>
							<?php if($i%3 == 0): ?>
								</ul>
							<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
					</div>
                    <div class="djs">
                        <?php echo $page; ?>
                    </div>
                    <!--商品-e-->
                    <!--精品推荐-s-->
					<div class="reco-bouti">
						<h2 class="litt-titt">精品推荐</h2>
						<div class="reacommque">
							<ul>
								<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_recommend = 1 limit 5");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_recommend = 1 limit 5"); 
                                    S("sql_".$md5_key,$sql_result_v,1);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
									<li>
									<div class="boxque">
										<img src="/tpshop/<?php echo goods_thum_images($v['goods_id'],165,188); ?>"/>
										<p class="shop_name"><a href=""><?php echo $v['goods_name']; ?></a></p>
										<div class="coan-j p">
											<div class="fl">
												<p class="ckf">参考价：￥<span class="lithe"><?php echo $v['shop_price']; ?></span></p>
												<p class="ckf">换购价：<span class="red">￥<em><?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?></em>积分</span></p>
											</div>
											<div class="fr">
												<a class="changot" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">立即换购</a>
											</div>
										</div>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
                    <!--精品推荐-e-->
                    <!--热门兑换-s-->
					<div class="hotchane">
						<h2 class="litt-titt">热门兑换</h2>
						<div class="hot-change">
							<ul>
								<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_hot = 1 limit 7");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_hot = 1 limit 7"); 
                                    S("sql_".$md5_key,$sql_result_v,1);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
									<li <?php if(($k+1)%5 == 0): ?>class="mar0"<?php endif; ?>>
										<div class="lit-shcha">
											<img src="/tpshop/<?php echo goods_thum_images($v['goods_id'],165,188); ?>"/>
											<div class="duchan">
												<span><em><?php echo $goods['sales_sum']; ?></em>人换购</span>
												<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">立即换购</a>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
                    <!--热门兑换-e-->
				</div>
			</div>
		</div>
		<!--footer-s-->
		<div class="footer p">
            <!-- 底部 Start -->
<link rel="stylesheet" type="text/css" href="__STATIC__/css/163style.css">
<link rel="stylesheet" type="text/css" href="__STATIC__/css/stylekf.css">
<div class="g-footer" style="margin-top:20px;">
    <div class="m-instruction">
        <div class="g-wrap f-clear">
            <div class="g-main">
                <ul class="m-instruction-list">
                <?php if(is_array($cate_info) || $cate_info instanceof \think\Collection || $cate_info instanceof \think\Paginator): if( count($cate_info)==0 ) : echo "" ;else: foreach($cate_info as $k=>$v): ?>
                    <li class="m-instruction-list-item">
                        <h5><i class="ico ico-instruction ico-instruction-1"></i><?php echo $v['name']; ?></h5>
                        <ul class="list">
                        <?php if(is_array($v['sub_cate']) || $v['sub_cate'] instanceof \think\Collection || $v['sub_cate'] instanceof \think\Paginator): if( count($v['sub_cate'])==0 ) : echo "" ;else: foreach($v['sub_cate'] as $kk=>$vv): ?>
                            <li><a href="/?/article-<?php echo $vv['id']; ?>.html" target="_blank"><?php echo $vv['title']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>  
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
                    <img width="117" src="__STATIC__/images/two-dimension_code.jpg" />
                </div>
            </div>
        </div>
    </div>
    <div class="m-copyright">
        <div class="g-wrap">
            <div class="m-copyright-logo">            
                <a href="/tpshop/index.php?m=Home&c=Goods&a=integralMall" target="_blank"><img width="117" src="__STATIC__/images/yy_logo.gif" /></a>
            </div>
            <div class="m-copyright-txt">
                <p>深圳市三人行广告传媒有限公司 版权所有</p>
                <p>备案号</p>
            </div>
        </div>
    </div>
</div>
<!-- 底部 End -->   

			
<script src="__STATIC__/js/common.js"></script>
		</div>
		<!--footer-e-->
<script src="__STATIC__/js/lazyload.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__STATIC__/js/headerfooter.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function(){
        $('.f-sort ul li').click(function(){
            $(this).find('i').addClass('jta-w').parents('li').siblings().find('i').removeClass('jta-w');
        })
    })
</script>
</body>
</html>