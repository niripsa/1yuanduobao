<?php
header('Content-type: text/html; charset=utf-8');



function safe_replace($string) {
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','&lt;',$string);
    $string = str_replace('>','&gt;',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
    $string = str_replace('\\','',$string);
    return $string;
}

function get_web_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
    $path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

    $path = get_web_url();
    $path = explode("/",$path);
    array_pop($path);
    array_pop($path);
    $path= implode("/",$path);
    
    $houtai_url= $path.'?/admin/';
    $qiantai_url= $path.'?/';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>云购系统安装</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel='stylesheet' type='text/css' href='images/install.css'>
    <script src="images/JQuery.js"></script>
</head>
<body>
<div id='installbox'>
    <div class='msgtitle'>云购系统 安装向导</div>
    <table width="780" height="30" border="0" cellpadding="0" cellspacing="0" class="intable3">
        <tr>
            <td style="color:#f5f5f5; text-align:center">
                <span style="display:block;float:left;width:23%;font-size:12px;">1. 许可协议</span>
                <span style="display:block;float:left;width:25%;font-size:12px;">2. 环境检测</span>
                <span style="display:block;float:left;width:25%;font-size:12px;">3. 数据库设置</span>
                <span style="display:block;float:left;width:25%;font-size:12px;color:#FFF;">4. 安装完成</span>
            </td>
        </tr>
    </table>


  <div id='msgbody'>
<h3 style="text-align:center; line-height:100px;">恭喜你！云购系统 安装成功！</h3>
<div style="text-align:center; font-size:16px;font-family:'黑体';color:#f60;">现在就开始体验！</div>
<div style="margin-top:2em;align:center;width:100%;">
    <div style="min-height: 400px;">
<table width="50%" height="80" align=center>
    <tr>
        <td align=left><a href='<?php echo $qiantai_url; ?>' target="_top">进入网站首页</a></td>
        <td align=left><a href='<?php echo $houtai_url; ?>' target="_top">登陆网站后台</a></td>
    </tr>
</table>
        </div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr class="firstalt" style="height:10px">
        <td colspan="2" align="center"><div id='msgbottom'>Powered By 云购系统</div></td>
    </tr>
</table>
</div>
</div>
</body>
</html>
