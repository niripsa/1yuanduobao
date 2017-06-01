<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.headertop"); ?>
<!--商品 wrap 开始-->
<form id="form_paysubmit" action="<?php echo WEB_PATH; ?>/<?php echo ROUTE_M; ?>/<?php echo ROUTE_C; ?>/paysubmit" method="post">
<div class="shop_payment f12">
    <ul class="payment">
        <li class="first_step">第一步：提交订单</li>
        <li class="arrow_1"></li>
        <li class="secend_step orange_Tech">第二步：支付订单</li>
        <li class="arrow_3"></li>
        <li class="third_step">第三步：支付成功 等待揭晓</li>
        <li class="arrow_2"></li>
        <li class="fourth_step">第四步：揭晓获得者</li>
    </ul>
    <div class="payment_Con">
        <ul class="order_list">
            <li class="top">
                <span class="name">商品名称</span>
                <span class="moneys">价值</span>
                <span class="money"><?php echo L('html.key'); ?>价</span>
                <span class="num1"><?php echo L('html.key'); ?>人次</span>
                <span class="all">小计</span>
            </li>
            <?php if(is_array($shoplist)) foreach($shoplist AS $shops): ?>          
            <li class="end">
                <span class="name">
                    <a class="blue" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shops['id']; ?>"><?php echo $shops['g_title']; ?></a>
                </span>
                <span class="moneyss"><?php echo $shops['g_money']; ?></span>
                <span class="moneyss"><span class="color"><b><?php echo $shops['price']; ?></b> <?php echo L('cgoods.currency'); ?></span></span>
                <span class="num1 c_red Fb"><?php echo $shops['cart_gorenci']; ?></span>
                <span class="alls"><?php echo $shops['cart_xiaoji']; ?></span>
            </li> 
            <?php endforeach; ?>           
            <li class="payment_Total">
                <div class="payment_List_Lc"><a href="<?php echo WEB_PATH; ?>/member/cart/cartlist" class="form_ReturnBut">返回购物车修改订单</a></div>
                <p class="payment_List_Rc">商品合计：<span class="c_red F20"><?php echo $MoenyCount; ?></span>  <?php echo L('cgoods.currency'); ?></p>
            </li>
            <!-- 福分 -->
            <!-- <?php if($fufen_dikou): ?>
            <li id="liPayByPoints" class="point_out">
                <div class="payment_List_Lc">
                <input type="checkbox" class="input_choice" id="shop_score" name="shop_score" value="1"/>您的列表中有可以使用<?php echo L('cgoods.credit'); ?>抵扣的商品：您的<?php echo L('cgoods.credit'); ?>(<?php echo $member['score']; ?>)本次消费最多可使用<?php echo $fufen_dikou; ?><?php echo L('cgoods.credit'); ?>抵扣
                <span class="orange Fb"><?php echo $fufen_money; ?></span><?php echo L('cgoods.currency'); ?>，我要使用 
                <input type="text" maxlength="8" class="pay_input_text_gray" id="shop_score_num" value="0" money="<?php echo $fufen_yuan; ?>" name="shop_score_num"/> <?php echo L('cgoods.credit'); ?>, 1元 = <?php echo $fufen_yuan; ?> <?php echo L('cgoods.credit'); ?></div>
                <p id="pPointsTip" class="pay_Value" style="display:none;"></p>
                <p class="payment_List_Rc"></p>
            </li>
            <?php  else: ?>
            <li id="liPayByPoints" class="point_out point_gray">
                    <div class="payment_List_Lc">
                    <input type="checkbox" class="input_choice" disabled="disabled"/>使用<?php echo L('cgoods.credit'); ?>抵扣<?php echo L('cgoods.currency'); ?>：您的<?php echo L('cgoods.credit'); ?>(<?php echo $member['score']; ?>)本次消费最多可抵扣
                    <span class="orange Fb"><?php echo $fufen_dikou; ?></span><?php echo L('cgoods.currency'); ?>)，我要使用 
                    <input type="text" maxlength="8" class="pay_input_text_gray" name="costPoint"  disabled="disabled"/> <?php echo L('cgoods.credit'); ?></div>
                    <p id="pPointsTip" class="pay_Value" style="display:none;"></p>
                    <p class="payment_List_Rc"></p>
            </li>
            <?php endif; ?> -->
            <!-- 福分 -->

            <!-- 余额支付 start-->
            <li class="point_in" id="liPayByBalance">
                <div class="payment_List_Lc">                   
                    <input type="checkbox" name="moneycheckbox" id="MoneyCheckbox" class="input_choice" >使用账户余额支付，账户余额：
                    <span class="green F18"><?php echo $member['money']; ?></span> <?php echo L('cgoods.currency'); ?>
                </div>
                <p style="" class="pay_Value" id="pBalanceTip">
                <span>◆</span><em>◆</em>账户余额支付更快捷，
                <a class="blue" target="_blank" href="<?php echo WEB_PATH; ?>/member/account/userrecharge">立即充值</a></p>
                <p class="payment_List_Rc">余额支付：<span id="pay_money" class="c_red F20">0.00</span>  <?php echo L('cgoods.currency'); ?></p>
            </li>
            <!-- 余额支付 end--> 
        </ul>
    </div>
    <!-- 默认银行隐藏域 -->
    <input type="hidden" value="cbpay106" name="account" />
    <input type="hidden" name="pay_bank" value="cbpay"  />
    <div class="payment_but" style="margin:15px 0 0 0;">
        <input type="hidden" name="submitcode" value="<?php echo $submitcode; ?>">
        <input id="submit_ok" class="shop_pay_but" type="submit" name="submit" value="">
    </div>
</form> 

</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<script>
$(function(){
    var info={'money':<?php echo $member['money']; ?>,'MoenyCount':<?php echo $MoenyCount; ?>,"shoplen":<?php echo $shoplen; ?>};
    if(info['money'] >= info['MoenyCount']){
        $("#divBankList").hide();
        $("#liPayByOther").hide();
        $("#pay_money").text(info['MoenyCount']+'.00');
        $("#MoneyCheckbox").attr("checked",true);
        $("#MoneyCheckbox").click(function(){
            if(this.checked){
                $("#pay_money").text(info['money']+'.00');
                $("#pay_bankmoney").text(info['MoenyCount']-info['money']+'.00');
                $("#divBankList").hide();
            }else{
                $("#pay_money").text('0.00');
                $("#pay_bankmoney").text(info['MoenyCount']+'.00'); 
                $("#divBankList").show();
            } 
        }); 
    }
    if(info['money'] < info['MoenyCount']){ 
       if(info['money']==0){
            $("#liPayByBalance").addClass("point_gray");
            $("#MoneyCheckbox").attr("checked",false);
            $("#MoneyCheckbox").attr("disabled",true);            
       }else{
            $("#MoneyCheckbox").attr("checked",true);
            $("#pay_money").text(info['money']+'.00');
            $("#pay_bankmoney").text(info['MoenyCount']-info['money']+'.00');
            $("#MoneyCheckbox").click(function(){
                if(this.checked){
                    $("#pay_money").text(info['money']+'.00');
                    $("#pay_bankmoney").text(info['MoenyCount']-info['money']+'.00');
                }else{
                    $("#pay_money").text('0.00');
                    $("#pay_bankmoney").text(info['MoenyCount']+'.00'); 
                } 
            });           
       }
    }
    
    
    $("#submit_ok").click(function(){   
        if(!this.cc){
            this.cc = 1;        
            return true;
        }else{      
            return false;
        }
        return false;
    });
    
    var fufen=$("#shop_score_num");    
    fufen.keyup(function(){
        if(fufen.val()><?php echo $fufen_dikou; ?>){
            fufen.val(<?php echo $fufen_dikou; ?>);        
        }
        if(isNaN(fufen.val())){
            fufen.val(0);                         
        }
        if(fufen.val()<0){
            fufen.val(0);       
        }
        fufen.blur(function(){
            var fufen = parseInt($(this).val());
            var money = parseInt($(this).attr("money"));
            $(this).val(Math.floor(fufen/money)*money);         
        });        
        
        
    });     
    
    $(".click_img li>img").click(function(){            
        $(this).prev().attr("checked",'checked');
    }); 
});

$(document).ready(function(){       
    $("#btnCXK").click(function(){  
        $("#divbtnXYK").hide();
        $("#divbtnCXK").show();
        $("#btnXYK").removeClass("tab_btn_hover");
        $("#btnCXK").addClass("tab_btn_hover");
    });
    $("#btnXYK").click(function(){  
        $("#divbtnCXK").hide();
        $("#divbtnXYK").show();
        $("#btnCXK").removeClass("tab_btn_hover");
        $("#btnXYK").addClass("tab_btn_hover");
    });
    /* 银行支付点击图片选中 */
    $("#divBankList li").click( function() {
        $(this).find( 'input' ).attr( 'checked', 'checked' );
    });
});
</script>
<!--footer 开始-->
<?php include self::includes("index.footer"); ?>