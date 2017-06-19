<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"中奖商品",
        "Member":true,
        "Home":true
    });
</script>

<section class="clearfix g-member">
    <article class="clearfix m-round g-userMoney">
        <a href="<?php echo WEB_PATH; ?>/member/account/userrecharge" class="z-Recharge-btn">去充值</a>可用余额<span class="orange"><?php echo $member_money; ?></span><?php echo L('cgoods.currency'); ?>
    </article>
    <article class="mt10 m-round">
        <ul class="m-userMoneyNav">
            <li><a id="btnConsumption" href="javascript:;" class="z-MoneyNav-crt01"><b>消费明细</b></a><s></s></li>
            <li><a id="btnRecharge" href="javascript:;"><b>充值明细</b></a></li>
        </ul>
    <ul id="ulConsumption" class="m-userMoneylst m-Consumption" style="display: block;"><!-- 消费明细 -->
    <li class="m-userMoneylst-tt"><span>消费时间</span><span>消费金额</span></li>
    </ul>
    <ul id="ulRechage" class="m-userMoneylst m-Consumption" style="display:none;">
        <li class="m-userMoneylst-tt"><span>充值时间</span><span>充值金额</span></li>
    </ul>
<script id="Consumption" type="text/html">
    {{each list as Consum i}}
        {{if Consum.type == '-1'}}
            <li class=""><span>{{Consum.time | dateFormat:'yyyy-MM-dd  hh:mm:ss'}}</span><span>{{Consum.money}}<?php echo L('cgoods.currency'); ?></span></li>
        {{/if}}
    {{/each}}
</script>
<script id="Rechage" type="text/html">
     {{each list as Rechage i}}
        {{if Rechage.type == '1'}}
            <li class=""><span>{{Rechage.time | dateFormat:'yyyy-MM-dd  hh:mm:ss'}}</span><span>{{Rechage.money}}<?php echo L('cgoods.currency'); ?></span></li>
        {{/if}}
     {{/each}}
</script>
    <ul id="ulRechage" class="m-userMoneylst" style="display:none;"></ul>
    <div id="LoadDataA">
        <a class="loading" href="javascript:void(0)">点击加载更多</a>
        <a class="loading" href="javascript:void(0)" style="display:none;">正在加载...</a>
        <a class="loading" href="javascript:void(0)" style="display:none;">没有数据了</a>
        <a class="loading" href="javascript:void(0)" style="display:none;">已经到底了</a>
    </div>
    </article>
</section>
<?php include self::includes("index.footer"); ?>
<script type="text/javascript">
var $consume_datas    = <?php echo json_encode( $consume_account ); ?>;
var $recharge_account = <?php echo json_encode( $recharge_account ); ?>;
$("#ulConsumption").append( template('Consumption', {list:$consume_datas}) );
$("#ulRechage").append( template('Rechage', {list:$recharge_account}) );
$("#LoadDataA a").click( function() {
    $data = $("#LoadDataA a");
    $data.data( "page", ($data.data("page")|0) + 1 );
    $data.data( "page", $data.data("page") == 1 ?　2 : $data.data("page") );

    if ( $data.data("maxpage") === undefined )
    {
        $data.hide().eq(1).show();
        $.get( APP.WEB_PATH + '/' + APP.G_PARAM_URL + "/p" + $data.data("page"), function( $datas ) {
            if ( $datas.consume_account.length < 10 && $datas.recharge_account.length < 10 )
            {
                $data.data( "maxpage", $data.data("page") );
            }
            $("#ulConsumption").append( template( 'Consumption', {list:$datas.consume_account} ) );
            $("#ulRechage").append( template( 'Rechage', {list:$datas.recharge_account} ) );
            $data.hide().eq(0).show();
        },"json")
    }
    else
    {
        $data.hide().eq(2).show();
    }
});

/* 两个选项卡 */
$("#btnConsumption").click( function() {
    $("#ulConsumption").show();
    $("#ulRechage").hide();
    $(this).addClass( 'z-MoneyNav-crt01' );
    $("#btnRecharge").removeClass( 'z-MoneyNav-crt01' );
});
$("#btnRecharge").click( function() {
    $("#ulConsumption").hide();
    $("#ulRechage").show();
    $(this).addClass( 'z-MoneyNav-crt01' );
    $("#btnConsumption").removeClass( 'z-MoneyNav-crt01' );
});
</script>