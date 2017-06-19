<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:42:"./application/admin/view2/index\index.html";i:1497680733;s:45:"./application/admin/view2/public\menubox.html";i:1495621976;s:42:"./application/admin/view2/public\left.html";i:1497685826;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" type="image/x-icon" href="/tpshop/__PUBLIC__/images/favicon.ico" media="screen"/>
<title>一元商城</title>
<script type="text/javascript">
  

var SITEURL = window.location.host +'/tpshop/index.php/admin';
 
</script>

<link href="/tpshop/__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="/tpshop/__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="/tpshop/__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/common.js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/jquery.bgColorSelector.js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/admincp.js"></script>
<script type="text/javascript" src="/tpshop/__PUBLIC__/static/js/jquery.validation.min.js"></script>

<script src="/tpshop/__PUBLIC__/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/--> 
<script src="/tpshop/__PUBLIC__/js/upgrade.js"></script>
</head>
<body>
<div class="admincp-map ui-widget-content" tptype="map_nav" style="display:none;" id="draggable" >
  <div class="title ui-widget-header" >
    <h3>管理中心全部菜单</h3>
    <h5>切换显示全部管理菜单，通过点击勾选可添加菜单为管理常用操作项，最多添加10个</h5>
    <span><a tptype="map_off" href="JavaScript:void(0);">X</a></span> </div>
  <div class="content"> 
	  <ul class="admincp-map-nav">
	  <li><a href="javascript:void(0);" data-param="map-system">平台</a></li>
	  <li><a href="javascript:void(0);" data-param="map-shop">商城</a></li>
	  <li><a href="javascript:void(0);" data-param="map-mobile">手机端</a></li>
	  <li><a href="javascript:void(0);" data-param="map-resource">资源</a></li>
	  </ul>
	  <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $mk=>$vo): ?>
	  <div class="admincp-map-div" data-param="map-<?php echo $mk; ?>">
		  <?php if(is_array($vo[child]) || $vo[child] instanceof \think\Collection || $vo[child] instanceof \think\Paginator): if( count($vo[child])==0 ) : echo "" ;else: foreach($vo[child] as $key=>$v2): ?>
		  <dl><dt><?php echo $v2['name']; ?></dt>
		  	<?php if(is_array($v2[child]) || $v2[child] instanceof \think\Collection || $v2[child] instanceof \think\Paginator): if( count($v2[child])==0 ) : echo "" ;else: foreach($v2[child] as $key=>$v3): ?>
		  	<dd class=""><a href="javascript:void(0);" data-param="<?php echo $v3['act']; ?>|<?php echo $v3['op']; ?>"><?php echo $v3['name']; ?></a><i class="fa fa-check-square-o"></i></dd>
		  	<?php endforeach; endif; else: echo "" ;endif; ?>
		  </dl>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
	  </div>
	  <?php endforeach; endif; else: echo "" ;endif; ?> 
  </div>
  <script>
//固定层移动
$(function(){
	//管理显示与隐藏
            $("#admin-manager-btn").click(function () {
                if ($(".manager-menu").css("display") == "none") {
                    $(".manager-menu").css('display', 'block'); 
					$("#admin-manager-btn").attr("title","关闭快捷管理"); 
					$("#admin-manager-btn").removeClass().addClass("arrow-close");
                }
                else {
                    $(".manager-menu").css('display', 'none');
					$("#admin-manager-btn").attr("title","显示快捷管理");
					$("#admin-manager-btn").removeClass().addClass("arrow");
                }           
            });
	
	$("#draggable").draggable({
		handle: "div.title"
	});
	$("div.title").disableSelection()

	$('#_pic').change(uploadChange);
	function uploadChange(){
		var filepath=$(this).val();
		var extStart=filepath.lastIndexOf(".");
		var ext=filepath.substring(extStart,filepath.length).toUpperCase();
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("file type error");
			$(this).attr('value','');
			return false;
		}
		if ($(this).val() == '') return false;
		ajaxFileUpload();
	}
	function ajaxFileUpload()
	{
		$.ajaxFileUpload
		(
			{
				url:'http://www.tpshop.cn/admin/index.php?act=common&op=pic_upload&type=admin_avatar&form_submit=ok&uploadpath=admin/avatar',
				secureuri:false,
				fileElementId:'_pic',
				dataType: 'json',
				success: function (data, status)
				{
					if (data.status == 1){
						ajax_form('cutpic','裁剪','http://www.tpshop.cn/admin/index.php?act=common&op=pic_cut&type=admin_avatar&x=100&y=100&resize=1&ratio=1&url='+data.url,690);
					}else{
						alert(data.msg);
					}
					$('#_pic').bind('change',uploadChange);
				},
				error: function (data, status, e)
				{
					alert('上传失败');
					$('#_pic').bind('change',uploadChange);
				}
			}
		)
	};
});
//裁剪图片后返回接收函数
function call_back(picname){
    $.getJSON('index.php?act=index&op=save_avatar&avatar=' + picname, function(data){
        if (data) {
            $('img[tptype="admin_avatar"]').attr('src', 'http://www.tpshop.cn/data/upload/admin/avatar/' + picname);
        }
    });
}
</script> 
</div>
<div class="admincp-header">
  <div class="bgSelector"></div>
  <div id="foldSidebar"><i class="fa fa-outdent " title="展开/收起侧边导航"></i></div>
  <div class="admincp-name" onClick="javascript:openItem('welcome|Index');">
    <!-- <h2 style="cursor:pointer;">TPshop2.0<br>平台系统管理中心</h2> -->
    <img src="/tpshop/__PUBLIC__/static/images/TPlogo.png" alt="">
  </div>
  <div class="nc-module-menu">
    <ul class="nc-row">
      <!-- <li data-param="system"><a href="javascript:void(0);">系统</a></li> -->
      <li data-param="shop"><a href="javascript:void(0);">商城</a></li>
<!--      <li data-param="mobile"><a href="javascript:void(0);">模板</a></li>-->
      <!-- <li data-param="resource"><a href="javascript:void(0);">插件</a></li>  -->     
    </ul>
  </div>
  <div class="admincp-header-r">
    <div class="manager">
      <!--服务器升级-->
      <textarea id="textarea_upgrade" style="display:none;"><?php echo $upgradeMsg['1']; ?></textarea>    
      <?php if($upgradeMsg[0] != null): ?>
      <dl style="text-align:left; font-size:15px;">
        <dd class="group"><a href="javascript:void(0);" id="a_upgrade" style="color:#FF0;"><?php echo $upgradeMsg['0']; ?></a></dd>
      </dl>
      <?php endif; ?>
      <!--服务器升级 end-->
      
      <dl>
        <dt class="name"></dt>
        <dd class="group"></dd>
      </dl>    
      <dl>
        <dt class="name"><?php echo $admin_info['user_name']; ?></dt>
        <dd class="group">管理员</dd>
      </dl>
      <span class="avatar">
      <!-- 屏蔽管理员头像上传 -->
      <!-- input name="_pic" type="file" class="admin-avatar-file" id="_pic" title="设置管理员头像"/ -->
      <img alt="" tptype="admin_avatar" src="/tpshop/__PUBLIC__/static/images/admint.png"> </span><i class="arrow" id="admin-manager-btn" title="显示快捷管理菜单"></i>
      <div class="manager-menu">
        <div class="title">
          <h4>最后登录</h4>
          <a href="javascript:void(0);" onClick="CUR_DIALOG = ajax_form('modifypw', '修改密码', '<?php echo U('Admin/modify_pwd',array('admin_id'=>$admin_info['admin_id'])); ?>');" class="edit-password">修改密码</a> </div>
        <div class="login-date"> <?php echo date('Y-m-d H:i:s',session('last_login_time'));?> <span>(IP: <?php echo session('last_login_ip');?> )</span> </div>
        <div class="title">
          <h4>常用操作</h4>
          <a href="javascript:void(0)" class="add-menu">添加菜单</a> </div>
                <ul class="nc-row" tptype="quick_link">
                <li><a href="javascript:void(0);" onClick="openItem('index|System')">站点设置</a></li>
                  </ul>
      </div>
    </div>
    <ul class="operate nc-row">
      <li style="display: none !important;" tptype="pending_matters"><a class="toast show-option" href="javascript:void(0);" onClick="$.cookie('commonPendingMatters', 0, {expires : -1});ajax_form('pending_matters', '待处理事项', 'http://www.tpshop.cn/admin/index.php?act=common&op=pending_matters', '480');" title="查看待处理事项">&nbsp;<em>0</em></a></li>
      <!-- li><a class="sitemap show-option" tptype="map_on" href="javascript:void(0);" title="查看全部管理菜单">&nbsp;</a></li -->
      <!-- li><a class="style-color show-option" id="trace_show" href="javascript:void(0);" title="给管理中心换个颜色">&nbsp;</a></li -->
       <!--  <li><a class="sitemap show-option" id="trace_show" href="<?php echo U('System/cleanCache'); ?>" target="workspace" title="更新缓存">&nbsp;</a></li> -->
      <li><a class="homepage show-option" target="_blank" href="/tpshop/index.php?m=Home&c=Goods&a=integralMall" title="新窗口打开商城首页">&nbsp;</a></li>
      <li><a class="login-out show-option" href="<?php echo U('Admin/logout'); ?>" title="安全退出管理中心">&nbsp;</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="admincp-container unfold">
<div class="admincp-container-left">
    <div class="top-border"><span class="nav-side"></span><span class="sub-side"></span></div>
    <div id="admincpNavTabs_index" class="nav-tabs">
    	<dl>
		    <dt><a href="javascript:void(0);"><span class="ico-microshop-1"></span><h3>概览</h3></a></dt>
		    <dd class="sub-menu">
			    <ul>
				    <li><a href="javascript:void(0);" data-param="welcome|Index">系统后台</a></li>
			    </ul>
		    </dd>
	    </dl>
    </div>
    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $mk=>$vo): ?>
    <div id="admincpNavTabs_<?php echo $mk; ?>" class="nav-tabs">
    	<?php if(is_array($vo[child]) || $vo[child] instanceof \think\Collection || $vo[child] instanceof \think\Paginator): if( count($vo[child])==0 ) : echo "" ;else: foreach($vo[child] as $key=>$v2): ?>
	    <dl>
		    <dt><a href="javascript:void(0);"><span class="ico-<?php echo $mk; ?>-<?php echo $key; ?>"></span><h3><?php echo $v2['name']; ?></h3></a></dt>
		    <dd class="sub-menu">
			    <ul>
			    	<?php if(is_array($v2[child]) || $v2[child] instanceof \think\Collection || $v2[child] instanceof \think\Paginator): if( count($v2[child])==0 ) : echo "" ;else: foreach($v2[child] as $key=>$v3): ?>
				    	<li><a href="javascript:void(0);" data-param="<?php echo $v3['act']; ?>|<?php echo $v3['op']; ?>"><?php echo $v3['name']; ?></a></li>
				    <?php endforeach; endif; else: echo "" ;endif; ?>
			    </ul>
		    </dd>
	    </dl>
    	<?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?> 
    <div class="about" title="关于系统" onclick="ajax_form('about', '', 'http://www.tpshop.cn/admin/index.php?act=aboutus&op=index', 640);"><i class="fa fa-copyright"></i><span>tpshop.cn</span></div>
</div>

  <!--  
  <div class="admincp-container-left">
    <div class="top-border"><span class="nav-side"></span><span class="sub-side"></span></div>
    
    <div id="admincpNavTabs_system" class="nav-tabs">
    <dl><dt><a href="javascript:void(0);"><span class="ico-system-0"></span><h3>设置</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="system|setting">站点设置</a></li>
    <li><a href="javascript:void(0);" data-param="system|upload">上传设置</a></li>
    <li><a href="javascript:void(0);" data-param="system|message">邮件设置</a></li>
    <li><a href="javascript:void(0);" data-param="system|taobao_api">淘宝接口</a></li>
    <li><a href="javascript:void(0);" data-param="system|admin">权限设置</a></li>
    <li><a href="javascript:void(0);" data-param="system|admin_log">操作日志</a></li>
    <li><a href="javascript:void(0);" data-param="system|area">地区设置</a></li>
    <li><a href="javascript:void(0);" data-param="system|cache">清理缓存</a></li></ul></dd>
    </dl>
    
    <dl><dt><a href="javascript:void(0);"><span class="ico-system-1"></span><h3>会员</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="system|member">会员管理</a></li>
    <li><a href="javascript:void(0);" data-param="system|account">账号同步</a></li></ul></dd>
    </dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-system-2"></span><h3>网站</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="system|article_class">文章分类</a></li>
    <li><a href="javascript:void(0);" data-param="system|article">文章管理</a></li>
    <li><a href="javascript:void(0);" data-param="system|document">会员协议</a></li>
    <li><a href="javascript:void(0);" data-param="system|navigation">页面导航</a></li>
    <li><a href="javascript:void(0);" data-param="system|adv">广告管理</a></li>
    <li><a href="javascript:void(0);" data-param="system|rec_position">推荐位</a></li></ul></dd>
    </dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-system-3"></span><h3>应用</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="system|link">友情连接</a></li>
    <li><a href="javascript:void(0);" data-param="system|hao">基本设置</a></li>
    <li><a href="javascript:void(0);" data-param="system|goods">商品管理</a></li>
    <li><a href="javascript:void(0);" data-param="system|db">数据库管理</a></li>
    <li><a href="javascript:void(0);" data-param="system|member">会员管理</a></li></ul></dd>
    </dl>
    </div>
    
    <div id="admincpNavTabs_shop" class="nav-tabs"><dl>
    <dt><a href="javascript:void(0);"><span class="ico-shop-0"></span><h3>设置</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|setting">商城设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|upload">图片设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|search">搜索设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|seo">SEO设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|message">消息通知</a></li>
    <li><a href="javascript:void(0);" data-param="shop|payment">支付方式</a></li>
    <li><a href="javascript:void(0);" data-param="shop|express">快递公司</a></li>
    <li><a href="javascript:void(0);" data-param="shop|waybill">运单模板</a></li>
    <li><a href="javascript:void(0);" data-param="shop|web_config">首页管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|web_channel">频道管理</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-1"></span><h3>商品</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|goods">商品管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|goods_class">分类管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|brand">品牌管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|type">类型管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|spec">规格管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|goods_album">图片空间</a></li>
    <li><a href="javascript:void(0);" data-param="shop|goods_recommend">商品推荐</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-2"></span><h3>店铺</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|store">店铺管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|store_grade">店铺等级</a></li>
    <li><a href="javascript:void(0);" data-param="shop|store_class">店铺分类</a></li>
    <li><a href="javascript:void(0);" data-param="shop|domain">二级域名</a></li>
    <li><a href="javascript:void(0);" data-param="shop|sns_strace">店铺动态</a></li>
    <li><a href="javascript:void(0);" data-param="shop|help_store">店铺帮助</a></li>
    <li><a href="javascript:void(0);" data-param="shop|store_joinin">商家入驻</a></li>
    <li><a href="javascript:void(0);" data-param="shop|ownshop">自营店铺</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-3"></span><h3>会员</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|member">会员管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|member_exp">等级经验值</a></li>
    <li><a href="javascript:void(0);" data-param="shop|points">积分管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|sns_sharesetting">分享绑定</a></li>
    <li><a href="javascript:void(0);" data-param="shop|sns_malbum">会员相册</a></li>
    <li><a href="javascript:void(0);" data-param="shop|snstrace">会员动态</a></li>
    <li><a href="javascript:void(0);" data-param="shop|sns_member">会员标签</a></li>
    <li><a href="javascript:void(0);" data-param="shop|predeposit">预存款</a></li>
    <li><a href="javascript:void(0);" data-param="shop|chat_log">聊天记录</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-4"></span><h3>交易</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|order">商品订单</a></li>
    <li><a href="javascript:void(0);" data-param="shop|vr_order">虚拟订单</a></li>
    <li><a href="javascript:void(0);" data-param="shop|refund">退款管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|return">退货管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|vr_refund">虚拟订单退款</a></li>
    <li><a href="javascript:void(0);" data-param="shop|consulting">咨询管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|inform">举报管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|evaluate">评价管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|complain">投诉管理</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-5"></span><h3>运营</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|operating">运营设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|bill">结算管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|vr_bill">虚拟订单结算</a></li>
    <li><a href="javascript:void(0);" data-param="shop|mall_consult">平台客服</a></li>
    <li><a href="javascript:void(0);" data-param="shop|rechargecard">平台充值卡</a></li>
    <li><a href="javascript:void(0);" data-param="shop|delivery">物流自提服务站</a></li>
    <li><a href="javascript:void(0);" data-param="shop|contract">消费者保障服务</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-6"></span><h3>促销</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|operation">促销设定</a></li>
    <li><a href="javascript:void(0);" data-param="shop|groupbuy">抢购管理</a></li>
    <li><a href="javascript:void(0);" data-param="shop|vr_groupbuy">虚拟抢购设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_cou">加价购</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_xianshi">限时折扣</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_mansong">店铺满即送</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_bundling">优惠套装</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_booth">推荐展位</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_book">预售商品</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_fcode">Ｆ码商品</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_combo">推荐组合</a></li>
    <li><a href="javascript:void(0);" data-param="shop|promotion_sole">手机专享</a></li>
    <li><a href="javascript:void(0);" data-param="shop|pointprod">积分兑换</a></li>
    <li><a href="javascript:void(0);" data-param="shop|voucher">店铺代金券</a></li>
    <li><a href="javascript:void(0);" data-param="shop|redpacket">平台红包</a></li>
    <li><a href="javascript:void(0);" data-param="shop|activity">活动管理</a></li></ul></dd></dl>
    <dl><dt><a href="javascript:void(0);"><span class="ico-shop-7"></span><h3>统计</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="shop|stat_general">概述及设置</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_industry">行业分析</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_member">会员统计</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_store">店铺统计</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_trade">销量分析</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_goods">商品分析</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_marketing">营销分析</a></li>
    <li><a href="javascript:void(0);" data-param="shop|stat_aftersale">售后分析</a></li></ul></dd></dl>
    </div>

    <div id="admincpNavTabs_mobile" class="nav-tabs">
    <dl><dt><a href="javascript:void(0);"><span class="ico-mobile-0"></span><h3>设置</h3></a></dt>
    <dd class="sub-menu"><ul><li><a href="javascript:void(0);" data-param="mobile|mb_setting">手机端设置</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_special">模板设置</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_category">分类图片</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_app">应用安装</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_feedback">意见反馈</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_payment">手机支付</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_wx">微信二维码</a></li>
    <li><a href="javascript:void(0);" data-param="mobile|mb_connect">第三方登录</a></li></ul></dd></dl>
    </div>  
    <div class="about" title="关于系统" onclick="ajax_form('about', '', 'http://www.tpshop.cn/admin/index.php?act=aboutus&op=index', 640);"><i class="fa fa-copyright"></i><span>tpshop.cn</span></div>
  </div>
  -->
  <div class="admincp-container-right">
    <div class="top-border"></div>
    <iframe src="" id="workspace" name="workspace" style="overflow: visible;" frameborder="0" width="100%" height="94%" scrolling="yes" onload="window.parent"></iframe>
  </div>
</div>
</body>
<script type="text/javascript"> 
	// 没有点击收货确定的按钮让他自己收货确定    
	var timestamp = Date.parse(new Date());
	$.ajax({
        type:'post',
        url:"<?php echo U('Admin/System/login_task'); ?>",
        data:{timestamp:timestamp},
        timeout : 100000000, //超时时间设置，单位毫秒
        success:function(){
            // 执行定时任务
        }
	});
</script>
</html>