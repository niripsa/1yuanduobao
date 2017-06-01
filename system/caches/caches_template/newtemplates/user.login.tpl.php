<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php echo seo(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/Comm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/color.css"/>
<link href="<?php echo G_TEMPLATES_CSS; ?>/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/demo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.Validform.min.js"></script>
</head>
<style>
.loginQQ a {
display: block;
width: 36px;
height: 36px;
background: url(<?php echo G_PLUGIN_PATH; ?>/oauth/login_icon_bg.png) no-repeat;
float: left;
margin-right: 5px;
}
.loginQQ a.qq{background-position: 0 0;}
.loginQQ a.weibo{background-position: -50px 0;}
.loginQQ a.weixin{background-position: -100px 0;}
.loginQQ a.qq:hover{background-position: 0 -43px;}
.loginQQ a.weibo:hover{background-position: -50px -43px;}
.loginQQ a.weixin:hover{background-position: -100px -43px;}

</style>
<body style="background: #fff;">
<div class="login">
    <div class="login_header">
        <div class="login_top">
            <h1><a rel="nofollow" href="<?php echo G_WEB_PATH; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"></a></h1>
            <p><a rel="nofollow" href="<?php echo G_WEB_PATH; ?>" class="back_home">返回首页</a><a href="<?php echo WEB_PATH; ?>/article-1.html" target="_blank" class="help">帮助中心</a></p>
        </div>
    </div>
    <div class="login_bg">
        <div id="loadingPicBlock" class="login_banner"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/20120628180933540.jpg" width="542" height="360"></div>
        <div class="login_box" id="LoginForm">
        <form class="registerform" id="registerform" method="post" action="<?php echo WEB_PATH; ?>/member/user/UserLogin">
            <h3><?php echo _cfg('web_name_two'); ?> - 用户登录</h3>
            <ul>                
                <li class="click">
                    <span>账　号：</span>
                    <input class="text_password" name="user" type="text"  datatype="m | e" nullmsg="请填写帐号！" errormsg="手机号/邮箱！" />
                </li>
                <li class="ts"><div class="Validform_checktip">&nbsp;&nbsp;手机号/邮箱！</div></li>
                <li>
                    <span>密　码：</span>                   
                    <input class="text_password" name="pass" type="password"  datatype="*6-20" nullmsg="请设置密码！" errormsg="密码范围在6~20位之间！"/>
                    <span class="fog"><a href="<?php echo WEB_PATH; ?>/member/finduser/findpassword">忘记密码？</a></span> 
                </li>                               
                <li class="ts" id="pwd_ts"><div class="Validform_checktip">&nbsp;&nbsp;请输入登录密码</div></li>
                 <li>
                    <span>验证码：</span>
                    <input class="text_verify" ajaxurl="<?php echo G_WEB_PATH; ?>/?plugin=1&api=Captcha&action=check"
                           name="captcha" type="text"  datatype="*4-6" nullmsg="请输入验证码！" errormsg="请输入正确的验证码！"/>
                    <span class="fog"><img id="checkcode" src="<?php echo G_WEB_PATH; ?>/?plugin=true&api=Captcha"/></span>
                </li>
                <li class="ts" id="pwd_ts"><div class="Validform_checktip">&nbsp;&nbsp;请输入验证码</div></li>      
                <li class="end">
                    <span><input name="submit" type="submit" value="登录" class="login_init" ></span>
                    <span><a id="hylinkRegisterPage" style="padding:0px 10px;" tabindex="4" class="reg" href="<?php echo WEB_PATH; ?>/register">立即注册</a></span>
                </li>                   
            </ul>   
            <!-- <div class="loginQQ">
                使用合作帐号登录<br>                
                <script src="<?php echo G_WEB_PATH; ?>/?plugin=1&api=Oauth&action=list"></script>
            </div> -->
            
            <input type="hidden" id="hidurl" name="hidurl" value="<?php echo G_HTTP_REFERER; ?>" />
        </form>
        </div>
    </div>
</div>

<div class="g-copyrightCon" style="padding-top: 50px;">
    <div class="w1190">
        <div class="g-links">           
        <?php if(is_array(Getheader('foot'))) foreach(Getheader('foot') AS $footnav): ?>
        <a  href="<?php echo $footnav['url']; ?>" target="<?php echo $footnav['url_target']; ?>"><?php echo $footnav['name']; ?></a><s></s>
        <?php endforeach; ?>
        </div>
        <!-- <div class="g-copyright"><?php echo include '/mnt/wwwroot/duobao/www/system/caches/caches_codes/tag.copyright.php'; ?></div> -->
    </div>
</div>

<script type="text/javascript">
$("#registerform").Validform({
    tiptype: function( msg, o, cssctl ) 
    {
        //msg：提示信息;
        //o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
        //cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;
        if ( ! o.obj.is( 'form' ) ) 
        {
            // 验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;
            // var objtip=o.obj.siblings(".Validform_checktip");
            var objtip = o.obj.parent().next().find(".Validform_checktip");
            cssctl( objtip, o.type );
            if ( o.type == 3 ) 
            {
                $( "#checkcode" ).click();
            }
            objtip.text( msg );
        } 
        else 
        {
            var objtip = o.obj.find("#msgdemo");
            cssctl( objtip, o.type );
            objtip.text( msg );
        }
    },
    callback: function( data ) 
    {
        if ( data.status == -1 ) 
        {
            alert( data.msg );
        } 
        else 
        {
            var refer_url = $( '#hidurl' ).val();
            if ( refer_url == '' )
            {
                refer_url = '<?php echo WEB_PATH; ?>/member/home/userindex';
            }
            window.location.href = refer_url;
        }
    },
    ajaxPost:true
});

$("#checkcode").attr( 'data', $("#checkcode").attr( 'src' ) );
$("#checkcode").click( function() {
    $(this).attr( 'src', $(this).attr("data") + "&="+new Date().getTime() );
});
</script>
</body>
</html>