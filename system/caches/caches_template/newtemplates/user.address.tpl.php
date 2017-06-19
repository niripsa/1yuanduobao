<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/area.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.Validform.min.js"></script>
<script type="text/javascript">
    $(function(){
        var demo=$(".registerform").Validform({
            tiptype:2,
            datatype:{
                "tel":/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/,
            },
        });
        demo.tipmsg.w["tel"]="请正确输入电话号码(区号、号码必填，用“-”隔开)";
        demo.addRule([
            {
                ele:"#txt_ship_tel",
                datatype:"tel",
            }]);
    });
</script>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
<div class="R-content">
<div class="subMenu">
        <a href="<?php echo WEB_PATH; ?>/member/home/modify">个人资料</a>
        <a href="<?php echo WEB_PATH; ?>/member/home/userphoto">修改头像</a>
        <a  class="current" href="<?php echo WEB_PATH; ?>/member/home/useraddress">收货地址</a>
</div>
<div id="addressListDiv" class="list-tab detailAddress gray01" style="">
        <ul class="listTitle tdTitle">
            <li class="pad">详细地址</li>
            <li class="wid70">收货人</li>
            <li class="wid110">电话号码</li>
            <li class="wid70">qq</li>
            <li class="wid70" style="margin-left:-10px;">操作</li>
        </ul>
       <?php if(is_array($data)) foreach($data AS $v): ?>
            <ul class="liBg">
                <li id="dizh_<?php echo $v['id']; ?>" class="pad"><?php echo $v['sheng']; ?>,<?php echo $v['shi']; ?>,<?php echo $v['xian']; ?>,<?php echo $v['jiedao']; ?></li>
                <li id="shr_<?php echo $v['id']; ?>" class="wid70"><?php echo $v['shouhuoren']; ?></li>
                <li id="mob_<?php echo $v['id']; ?>" class="wid110"><?php echo $v['mobile']; ?></li>
                <li id="listqq_<?php echo $v['id']; ?>" class="wid70"><?php echo $v['qq']; ?></li>
                <?php if($v['default']=='Y'): ?>
                <li class="wid80 orange">
                    默认地址
                    <a class="xiugai" href="javascript:;" id="update<?php echo $v['id']; ?>" onclick="update(<?php echo $v['id']; ?>)" title="修改">修改</a>
                </li>
                <?php  else: ?>
                <li class="wid80 lightBlue">
                    <a class="blue" href="<?php echo WEB_PATH; ?>/member/home/morenaddress/<?php echo $v['id']; ?>">设为默认地址</a>
                    <a class="xiugai" href="javascript:;"   onclick="update(<?php echo $v['id']; ?>)" title="修改">修改</a>
                    <a onclick="dell(<?php echo $v['id']; ?>)"  href="javascript:;" >删除</a>
                </li>
                <?php endif; ?>
            </ul>
       <?php endforeach; ?>


            </div>
            <div class="add"><input id="btnAddnewAddr" type="button" class="orangebut" value="新增收货地址" style="display:block;width:100px;height:35px;color:#fff;background:#db3752;border:none;cursor:pointer"></div>
            <div id="div_consignee" class="addAddress" style="display:none;">
        <dl>添加收货地址</dl>
        <form class="registerform" method="post" action="">
        <table border="0" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
        <script>var s2=["province2","city2","county2"];</script>
            <td><label>所在地区：</label></td>
            <td>
                <select datatype="*" nullmsg="请选择有效的省市区" class="select" id="province2" runat="server" name="sheng"></select>
                <select datatype="*" nullmsg="请选择有效的省市区" id="city2" runat="server" name="shi"></select>
                <select datatype="*" nullmsg="请选择有效的省市区" id="county2" runat="server" name="xian"></select>
                <em id="ship_address_valid_msg" class="red">*</em>  
                <script type="text/javascript">setup2()</script>
            </td>
            <td><div class="Validform_checktip"></div></td>
        </tr>
        <tr>
            <td><label>街道地址：</label></td>
            <td>
                <input datatype="*1-100" nullmsg="请填街道地址！" errormsg="范围在100之间！" name="jiedao" type="text" class="street" maxlength="100">
                <em id="ship_address_valid_msg" class="red">*</em>          
            </td>
            <td><div class="Validform_checktip">(不需要重复填写省/市/区)</div></td>
        </tr>
        <!-- <tr>
            <td><label>邮政编码：</label></td>
            <td>
                <input datatype="p" ignore="ignore" errormsg="邮政编码错误！" name="youbian" type="text" maxlength="6" id="txt_ship_zip" class="inputTxt" value=""> 
                <font><a href="http://alexa.ip138.com/post" class="blue" target="_blank">邮编查询</a></font>
            </td>
            <td><div class="Validform_checktip"></div></td>
        </tr> -->
        <tr>
            <td><label>收货人：</label></td>
            <td>
                <input datatype="*" nullmsg="收货人不能为空" name="shouhuoren" type="text" maxlength="20" id="txt_ship_name" class="inputTxt" value="">
                <em class="red" id="ship_name_valid_msg">*</em>
            </td>           
            <td><div class="Validform_checktip"></div></td>
        </tr>
        <tr>
            <td><label>手机号码：</label></td>
            <td>
                <input datatype="m" nullmsg="手机号不能为空" errormsg="手机号不对" name="mobile" type="text" class="inputTxt" maxlength="11">
                <em id="ship_mb_valid_msg" class="red">*</em>
                </td><td><div class="Validform_checktip"></div></td>
            
        </tr>
        <tr>
            <td><label>QQ号码：</label></td>
            <td>
                <input datatype="*" nullmsg="QQ号码不能为空" errormsg="QQ号不对" name="qq" type="text" id="txt_ship_qq" value="" class="inputTxt" maxlength="11">
                <em id="ship_qq_valid_msg" class="red">*</em>
                </td><td><div class="Validform_checktip"></div></td>    
        </tr>
        <tr>
            <td><label>&nbsp;</label></td>
            <td>
                <input style="margin-right:20px;" name="submit" type="submit" class="orangebut" id="btn_consignee_save" value="保存" title="保存"> 
                <input type="button" class="cancelBtn" value="取消" id="btn_consignee_cancle" title="取消">
            </td>
        </tr>
        </tbody>
        </table>
        </form>
    </div>
    <div id="div_consignee2" class="addAddress" style="display:none;">
        <dl>修改收货地址</dl>
        <script>var s3=["province3","city3","county3"];</script>         
        <form id="registerform3" class="registerform" method="post">
        <table border="0" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td><label>所在地区：</label></td>
            <td>
                <select datatype="*" nullmsg="请选择有效的省市区" class="select" id="province3" runat="server" name="sheng"></select>
                <select datatype="*" nullmsg="请选择有效的省市区" id="city3" runat="server" name="shi"></select>
                <select datatype="*" nullmsg="请选择有效的省市区" id="county3" runat="server" name="xian"></select>
                <em id="ship_address_valid_msg" class="red">*</em>              
            </td>
            <td><div class="Validform_checktip"></div></td>
        </tr>
        <tr>
            <td><label>街道地址：</label></td>
            <td>
                <input id="dizh2" datatype="*1-100" nullmsg="请填街道地址！" errormsg="范围在100之间！" name="jiedao" type="text" class="street" maxlength="100">
                <em id="ship_address_valid_msg" class="red">*</em>          
            </td>
            <td><div class="Validform_checktip">(不需要重复填写省/市/区)</div></td>
        </tr>
        <!-- <tr>
            <td><label>邮政编码：</label></td>
            <td>
                <input id="yb2" datatype="p" ignore="ignore" errormsg="邮政编码错误！" name="youbian" type="text" maxlength="6" class="inputTxt" value=""> 
                <font><a href="http://alexa.ip138.com/post" class="blue" target="_blank">邮编查询</a></font>
            </td>
            <td><div class="Validform_checktip"></div></td>
        </tr> -->
        <tr>
            <td><label>收货人：</label></td>
            <td>
                <input id="shr2" datatype="*" nullmsg="收货人不能为空" name="shouhuoren" type="text" maxlength="20" class="inputTxt" value="">
                <em class="red" id="ship_name_valid_msg">*</em>
            </td>
            <td><div class="Validform_checktip"></div></td>
        </tr>
        <tr>
            <td><label>手机号码：</label></td>
            <td>
                <input id="mob2" datatype="m" nullmsg="手机号不能为空" errormsg="手机号不对" name="mobile" type="text" value="" class="inputTxt" maxlength="11">
                <em id="ship_mb_valid_msg" class="red">*</em>
                </td><td><div class="Validform_checktip"></div></td>        
        </tr>
        <tr>
            <td><label>QQ号码：</label></td>
            <td>
                <input datatype="*" nullmsg="QQ号码不能为空" errormsg="QQ号不对" name="qq" type="text" id="qq2" value="" class="inputTxt" maxlength="11">
                <em id="ship_qq_valid_msg" class="red">*</em>
            </td>
            <td><div class="Validform_checktip"></div></td> 
        </tr>   
        <tr>
            <td><label>&nbsp;</label></td>
            <td>
                <input style="margin-right:20px;" name="submit" type="submit" class="orangebut" id="btn_consignee_save" value="保存" title="保存"> 
                <input type="button" class="cancelBtn" value="取消" id="btn_consignee_cancle2" title="取消">
            </td>
        </tr>
        </tbody>
        </table>
        </form>  
    </div>
</div>
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>

<script type="text/javascript">
$(function(){
    $("#btnAddnewAddr").click(function(){
        $("#div_consignee").show();
        $("#btnAddnewAddr").hide();
    });
    $("#btn_consignee_cancle").click(function(){
        $("#div_consignee").hide();
        $("#btnAddnewAddr").show();
    });
});
$(function(){
    $(".xiugai").click(function(){
        $("#btnAddnewAddr").hide();
        $("#div_consignee").hide();
    });
    $("#btn_consignee_cancle2").click(function(){
        $("#div_consignee2").hide();
        $("#btnAddnewAddr").show();
    });
});
function update(id){    
    $("#div_consignee2").show();
    setup3();
    $("#registerform3").attr("action","<?php echo WEB_PATH; ?>/member/home/updateddress/"+id);
    var str=$("#dizh_"+id).html();
    var spl=str.split(",");
    $("#province3").append('<option selected value="'+spl[0]+'">'+spl[0]+'</option>');
    $("#city3").append('<option selected value="'+spl[1]+'">'+spl[1]+'</option>');
    $("#county3").append('<option selected value="'+spl[1]+'">'+spl[1]+'</option>');
    $("#dizh2").val(spl[3]);
    $("#mob2").val($("#mob_"+id).html());
    $("#yb2").val($("#yb_"+id).html());
    $("#shr2").val($("#shr_"+id).html());
    $("#qq2").val($("#listqq_"+id).html());
    $("#div_consignee2").show();    
};
function dell(id){
    if (confirm("您确认要删除该条信息吗？")){
        window.location.href="<?php echo WEB_PATH; ?>/member/home/deladdress/"+id;
    }
}
</script>
<?php include self::includes("index.footer"); ?>