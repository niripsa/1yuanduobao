<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <?php echo seo(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/comm.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/goods.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/user.css"/>
    <?php echo css(); ?>
    <script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cookie.js"></script>
    <script>;
    var APP = {
      WEB_PATH : '<?php echo WEB_PATH; ?>',
      G_WEB_PATH : '<?php echo G_WEB_PATH; ?>',
      G_PARAM_URL : '<?php echo G_PARAM_URL; ?>'
    };
</script>
    <?php echo js(); ?>
</head>
<body>

<header class="g-header">
    <div class="head-l">
        <a href="javascript:;" onclick="history.go(-1)" class="z-HReturn"><s></s><b>返回</b></a>
    </div>
     <h2 id="top_title"></h2>   
        <div class="head-r">
            <a id="top_userindex" href="<?php echo WEB_PATH; ?>/member/home/userindex" class="z-Member"  style="display:none"></a>
            <a id="top_btnCart" href="<?php echo WEB_PATH; ?>/member/cart/cartlist" class="z-shop"  style="display:none"><em id="sCartTotal" style="display:none">0</em></a>
            <a id="top_userbalance" href="<?php echo WEB_PATH; ?>/mobile/home/userbalance" class="z-RCornerBtn" style="display:none"><i></i>帐户明细</a>
            <a id="top_btnCalMethod" href="javascript:;" class="z-RCornerBtn" style="display:none"><i></i>计算方法</a>
            <a id="top_index" href="<?php echo WEB_PATH; ?>" class="z-Home" style="display:none"></a>                
        </div>          
</header>
<script type="text/javascript">
$(document).ready(function(){
    $.get("<?php echo WEB_PATH; ?>/member/cart/getnumber/"+new Date().getTime(),function(data){
        if(data&&data!=0){      
            $("#sCartTotal").show();
            $("#sCartTotal").text(data);    
        }
    });
});
</script>
