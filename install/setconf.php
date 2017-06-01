<?php
header('Content-type: text/html; charset=utf-8');
if(file_exists("ok.lock")){
    echo "程序已经安装过";
    echo "<br>";
    echo "重新安装请删除,install 文件夹下的 <font color='red'>ok.lock</font> 文件";
    exit;
}


function todatabase(){
    
    $db_host = isset($_POST['db_host']) ? trim($_POST['db_host']) : '';
    $db_user = isset($_POST['db_user']) ? trim($_POST['db_user']) : '';
    $db_pwd = isset($_POST['db_pwd']) ? trim($_POST['db_pwd']) : '';
    $db_name = isset($_POST['db_name']) ? trim($_POST['db_name']) : '';
    
    
    $conn = mysql_connect($db_host,$db_user,$db_pwd);
    
    if(!$conn){
        exit("数据库连接失败");         
    }
    mysql_query("set names utf8");
    if(!mysql_select_db($db_name,$conn)){
        $ok = mysql_query("CREATE DATABASE `$db_name` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
        if($ok){
            echo 1;
            exit;
        }else{
            exit("数据库创建失败");
        }
    }
    return;
    
}

if(isset($_GET['action']) && $_GET['action'] == 'checkdbname'){ 
    return todatabase();

}






?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>云购系统安装</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='images/install.css'>
<script src="images/JQuery.js"></script>
<style>
.checkdatabase{ color:#f60}
</style>
<style>
#test_conn{
    padding:5px 8px; font-size:12px; border:1px solid #ccc; background:#eee; color:#666;text-decoration:none
}
#test_conn:hover{
    border:1px solid #f60; background:#f70; color:#fff;text-decoration:none
}
</style>
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

        <h3>数据库设置：</h3>
        <form  method="post" action="" name="conf" id="gxform" style="margin:0; padding:0;" target="procsss" onsubmit="return start_process();">
            <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableoutline" style="font-size:12px; color:#666;">
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%" valign="top"><b>数据库主机</b></td>
                    <td width="45%"><input type="text" id="db_host" value="localhost" maxlength="50" style="width:250px;" > *</td>
                    <td><font>一般为localhost</font></td>
                </tr>
                <tr class="firstalt">
                    <td width="25%"><b>数据库用户名</b></td>
                    <td width="45%"><input type="text" id="db_user" value="" maxlength="50" style="width:250px;"> *</td>
                    <td><font></font></td>
                </tr>
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%"><b>数据库密码</b></td>
                    <td width="45%"><input type="password" value="" id="db_pwd" maxlength="50" style="width:250px;" ></td>
                    <td><font></font></td>
                </tr>
                <tr class="firstalt">
                    <td width="25%"><b>数据库名称</b></td>
                    <td width="45%"><input type="text" id="db_name" value="" maxlength="50" style="width:250px;"> *</td>
                    <td><font><a class="checkdatabase" href="#">新建数据库</a></font></td>
                </tr>
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%"><b>数据库表前缀</b></td>
                    <td width="45%"><input type="text"  id="db_prefix" value="yg"  maxlength="50"  valid="required"  style="width:250px;" > *</td>
                    <td><font>建议您修改表前缀</font></td>
                </tr>

                <tr class="firstalt">
                    <td width="25%"><b>默认数据库扩展</b></td>
                    <td width="45%">
                        <input type="radio" name="db_sql_type" value="db_mysql" checked="true" /> MYSQL
                        <?php if(function_exists("mysqli_query")){ ?>
                            <input type="radio" name="db_sql_type" checked value="db_mysqli" /> MYSQLI (PHP5.5以上选用)
                        <?php } ?>
                    </td>
                    <td><font></font></td>
                </tr>
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%"><b>是否安装默认数据</b></td>
                    <td width="45%">
                        <input type="radio" name="db_data_type" value="1" /> 是
                        <input type="radio" name="db_data_type" checked="true" value="0" /> 否
                    </td>
                    <td><font></font></td>
                </tr>
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%"><b></b></td>
                    <td width="45%" style="line-height:30px;">
                        <a href="javascript:;" id="test_conn" onclick="return test_conn();">测试链接</a>
                    </td>
                    <td id="test_alt" style="font-weight: bold;"></td>
                </tr>
            </table>
            <h3>授权码设置：</h3>
            <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableoutline" style="font-size:12px; color:#666;">
                <tr class="firstalt">
                    <td width="25%"><b>授权码</b></td>
                    <td width="45%"><input type="text" id="sqm_num" value=""  maxlength="100"  valid="required"  style="width:250px;" > *</td>
                    <td><font><a target="_blank" href="http://www.yungoucms.com/">购买授权码 </a></font></td>
                </tr>
            </table>
            <h3>后台设置：</h3>
            <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableoutline" style="font-size:12px; color:#666;">
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%"><b>管理员帐号</b></td>
                    <td width="45%"><input type="text" name="user_name" id="user_name" value="yungoucms"  maxlength="50"  valid="required"  style="width:250px;" > *</td>
                    <td><font>一般不用修改</font></td>
                </tr>
                <tr class="firstalt">
                    <td width="25%"><b>密码</b></td>
                    <td width="45%"><input type="password" name="password" id="password" value=""  maxlength="50"  valid="required"  style="width:250px;" > *</td>
                    <td><font>密码大于6位</font></td>
                </tr>
                <tr bgcolor="#fdefe5" class="firstalt">
                    <td width="25%"><b>确认密码</b></td>
                    <td width="45%"><input type="password" name="repassword" id="repassword" value=""  maxlength="50"  valid="required"  style="width:250px;" > *</td>
                    <td></td>
                </tr>
                
                 <tr class="firstalt" id="process" style="display:none">
                    <td width="25%"><b>安装进度</b></td>
                    <td width="45%">
                        <div style="border: 1px solid #f60;width: 500px;height: 20px;background:#eee">
                            <div id="process_tip" style="background:#f60;width:0%;line-height: 20px;height: 20px; color:#fff;overflow:hidden"></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                
            </table>
            
                
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr class="firstalt" style="height:10px">
                    <td height="70" colspan="2" align="center" id="hidebutton">
                        <input style="width:120px; height:30px;" type="button" class="btn"  value="上一步" onClick="history.back();"/>
                        <input style="width:120px; height:30px;" type="submit" name="edit" value="安装" class="btn" id="submit">
                        <span id="loading" style="font-size:13px;color:#FF0000;display:none"><font color="#0066CC">请稍等...正在与MYSQL数据库进行连接。</font></span>
                    </td>
                </tr>
                <tr class="firstalt" style="height:10px">
                    <td colspan="2" align="center"><div id='msgbottom'>Powered By <a target="_blank" href="http://www.yungoucms.com/">YunGouCMS </a></div></td>
                </tr>
            </table>
        </form>
    <iframe style="width: 0;height:0px;overflow:hidden; display:none" id="iframe_procsss" name="iframe_procsss"></iframe>
</div>
</body>
</html>

<script src="./jquery-1.8.3.min.js"></script>
<script>

$(".checkdatabase").click(function(){
    
    
    var dbname = $("#db_name").val();
    var dbhost = $("#db_host").val();
    var dbuser = $("#db_user").val();
    var dbpwd = $("#db_pwd").val();
    
    if(!dbname){
        alert("请填写数据库名称"); return;
    }
    if(!dbhost || !dbuser){
        alert("数据库用户名密码请填写完整在"); return;
    }   

    $.post("?action=checkdbname",{"db_host":dbhost,"db_user":dbuser,"db_pwd":dbpwd,"db_name":dbname},function(data){
        
        if(data==1){
            $(".checkdatabase").text("数据库检测通过");
        }else{
            $(".checkdatabase").text(data);
        }       
        
    });
    
    
});
</script>


<script language="javascript">

    var obj = {};
    //测试连接
    function test_conn(func){
        if(db_name.value == ''){
            alert("请填写数据库名称");return false;
        }       
        $.post("import.php",{action:"connect",host:db_host.value,user:db_user.value,pass:db_pwd.value,table:db_name.value},function(data){  
            $("#test_alt").html(data.msg);
            if(data.status==0){
                $("#test_alt").css("color","red");
                return false;
            }else{
                obj.host = db_host.value;
                obj.user = db_user.value;
                obj.pass = db_pwd.value;
                obj.table = db_name.value;      
                $("#test_alt").css("color","blue");
                if(func != undefined){
                    return func();
                }
                return true;
            }

        },"json");
    }
      
    
    function get_import(){
    
        obj.admin_user = user_name.value;
        obj.admin_pass = repassword.value;
        obj.code = sqm_num.value;
        obj.prefix = db_prefix.value;
        obj.ceshidata = $("input[name=db_data_type]:checked").val();
        obj.sqltype = $("input[name=db_sql_type]:checked").val();
        
        var query = "";
        var ret = "";
        for(var p in obj){
            query += "&"+p+"="+obj[p];
        }
        var timer;
        var process_tip = $("#process_tip");
        var iframe = $("#iframe_procsss");
            iframe.attr("src","import.php?action=import"+query);
        clearInterval(timer);
        timer = setInterval(function(){
             ret = iframe.contents().find("div:last");          
            if(ret.find("i").text() == "101%"){
                 process_tip.css("width","100%");
                 var text = ret.find("p").text();
                 process_tip.text(text);    
                 clearInterval(timer);
                 
                 var ii = 5;
                 setInterval(function(){
                    ii--;
                    if(ii==0){
                         window.location.href = "../../?index=install"; 
                    }else{
                         process_tip.text(text+" --"+ii+"秒后跳转!");
                    }
                 },1000);
                             
            }else{
                process_tip.css("width",ret.find("i").text());
                process_tip.text(ret.find("p").text());             
            }
         },100);
         
    }
    
    //初始化进度条
    function start_process(){   
    
    
    
    
        if(password.value != repassword.value){
            alert("2次密码输入不一致");return false;
        }
        if(password.value.length < 6){
            alert("密码不能小于6位");return false;
        }       
    
        test_conn(function(){           
            $("#process").show();
            $("input.btn").hide();  
            $("#hidebutton").text("安装完成前,不要关闭本页面");
            get_import();   
        })
        return false;
    }
    
    
    
    
    
</script>
