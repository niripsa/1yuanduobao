<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user.message"); ?>
<?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="layout980 clearfix">
    <?php include self::includes("user.left"); ?>
<div class="R-content">
<div class="subMenu">
    <a class="current" href="<?php echo WEB_PATH; ?>/member/home/modify">个人资料</a>
    <a href="<?php echo WEB_PATH; ?>/member/home/userphoto">修改头像</a>
    <a href="<?php echo WEB_PATH; ?>/member/home/useraddress">收货地址</a>
    <a href="<?php echo WEB_PATH; ?>/member/home/userpassword"> 密码修改</a>
    <!-- <a href="<?php echo WEB_PATH; ?>/member/home/oauth"> 多账户绑定</a> -->
</div>
<div class="prompt orange">完善以下资料，<?php echo _cfg("web_name_two"); ?>网不会以任何形式公开您的个人隐私，请放心填写！<s></s></div>
<div class="info">
    <form class="registerform" method="post" action="">
        <table border="0" cellpadding="0" cellspacing="8">
            <tbody>
            <tr>
                <?php if($member['mobile']!=null && $member['mobilecode']=='1'): ?>
                <td align="right"><em><font>*</font><label>手机：</label></em></td>
                <td>
                    <b><?php echo $member['mobile']; ?></b>
                    已验证
                </td>
                <?php  else: ?>
                <td align="right"><em><font>*</font><label>手机：</label></em></td>
                <td>
                    <a style="margin-left:0;" href="<?php echo WEB_PATH; ?>/member/home/mobilechecking" title="绑定手机">绑定手机</a>
                </td>
                <?php endif; ?>

            </tr>
            <tr>
                <?php if($member['email']!=null && $member['emailcode']=='1'): ?>
                <td align="right"><em><font>*</font><label>邮箱：</label></em></td>
                <td>
                    <b><?php echo $member['email']; ?></b>
                    已验证
                </td>
                <?php  else: ?>
                <td align="right"><em><font>*</font><label>邮箱：</label></em></td>
                <td>
                    <a style="margin-left:0;" href="<?php echo WEB_PATH; ?>/member/home/mailchecking" title="绑定邮箱">绑定邮箱</a>
                </td>
                <?php endif; ?>
            </tr>
            <!--([\u4e00-\u9fa5]{2,7})|([A-Za-z0-9 ]{4,14})-->
            <tr>
                <td align="right"><em><font>*</font><label>昵称：</label></em></td>
                <td>
                    <input id="nicxx" datatype="nic" nullmsg="昵称不能为空" name="username" value="<?php echo $member['username']; ?>" type="text" class="txt gray" maxlength="7">
                </td>                   
                <td><div class="Validform_checktip" style="display:none;">昵称为2-7个汉字、字母、数字、“_”字符组成</div></td>
            </tr>
            <tr>
                <td><em><label>银行卡号：</label></em></td>
                <td>
                    <input type="text" id="card_no" name="card_no" value="<?php echo $member['card_no']; ?>" class="txt gray" />
                </td>
            </tr>
            <tr>
                <td align="right"><em><label>开户行：</label></em></td>
                <td>
                    <input type="text" id="bank_account" name="bank_account" value="<?php echo $member['bank_account']; ?>" class="txt gray" />
                </td>
            </tr>
            <!-- <tr>
                <td align="right"><em><font>&nbsp;</font><label>签名：</label></em></td>
                <td><textarea id="qianming"  name="qianming" class="info_txtarea gray03" placeholder="不超过100个字符" onKeyUp="showLen(this);" maxlength="100"><?php echo $member['qianming']; ?></textarea></td>
            </tr>
            <tr>
                <td style="float:right;" id="shuru">还能输入100个字符</td>
            </tr> -->
            <tr> 
                <td><em>&nbsp;</em></td>
                <td><input name="submit" type="submit" class="bluebut" value="保存"></td>
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
showLen(document.getElementById("qianming"));
function showLen(obj){
    if(140-obj.value.length<0){
        return; 
    }else{
        document.getElementById('shuru').innerHTML = '还能输入'+ (100-obj.value.length) +'个字符';
    }
}
</script>
<script>
    $("#nicxx").blur(function(){
        var ss= $("#nicxx").val();
        if(!ss.match(/([\u4e00-\u9fa5]{2,7})|([A-Za-z0-9 ]{2,7})/)){
          $(".Validform_checktip").css("display","block");
          $(".bluebut").attr("alt","cur");
        }else{
          $(".Validform_checktip").css("display","none");
          $(".bluebut").attr("alt","");
        }
    })
    $(".bluebut").click(function(){
        if( $(this).attr("alt")== "cur"){
          return false;
        }
    })
</script>
<?php include self::includes("index.footer"); ?>