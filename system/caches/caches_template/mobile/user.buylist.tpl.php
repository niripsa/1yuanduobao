<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":  "夺宝记录",
        "Member": true,
        "Home":   true
    });
</script>

<div id="navBox" class="g-snav m_listNav">
    <div class="gray9 g-snav-lst z-sgl-crt" state="-1"><a href="javascript:;">全部(<?php echo $total; ?>)</a><b></b></div>
        <!--
        <div class="gray9 g-snav-lst" state="1"><a href="javascript:;">进行中(qqqqqq)</a><b></b></div>
        <div class="gray9 g-snav-lst" state="3"><a href="javascript:;">已揭晓(qqqqqq)</a></div>
        -->
</div>
<section class="clearfix g-Record-lst" style="display:block">
     <ul class="z-minheight" id="userrecord"></ul>
    <div id="LoadDataA">
        <a class="loading" href="javascript:void(0)">点击加载更多</a>
        <a class="loading" href="javascript:void(0)" style="display:none;">正在加载...</a>
        <a class="loading" href="javascript:void(0)" style="display:none;">没有数据了</a>
        <a class="loading" href="javascript:void(0)" style="display:none;">已经到底了</a>
    </div>
</section>

<script id="userrecord_all" type="text/html">
     {{each list as record i}}
        <li>
            {{if !record.getowin_uid}}
                <a class="fl z-Limg" href="<?php echo WEB_PATH; ?>/cgoods/{{record.ogid}}"><span class="z-Imgbg z-ImgbgC02"></span>
            {{else}}
                <a class="fl z-Limg" href="<?php echo WEB_PATH; ?>/cgdataserver/{{record.ogid}}"><span class="z-Imgbg z-ImgbgC02"></span>
            {{/if}}
                <em class="z-Imgtxt">
                    {{if !record.getowin_uid }}
                    进行中
                    {{else}}
                    已揭晓
                    {{/if}}
                </em>
                <img src="<?php echo G_UPLOAD_PATH; ?>/{{record.g_thumb}}" border="0">
            </a>
            {{if !record.getowin_uid}}
                <div class="u-sgl-r ">
                    <p class="z-sgl-tt"><a class="gray6"  href="<?php echo WEB_PATH; ?>/cgoods/{{record.ogid}}">(第{{record.oqishu}}期)　{{record.g_title}}</a></p>
                    <p><em class="blue">进行中</em></a></p>
                </div>
            {{else}}
                <div class="u-sgl-r ">
                    <p class="z-sgl-tt"><a class="gray6"  href="<?php echo WEB_PATH; ?>/cgdataserver/{{record.ogid}}">(第{{record.oqishu}}期)　{{record.g_title}}</a></p>
                    <p>获得者：<a href="<?php echo WEB_PATH; ?>/uname/{{record.getowin_uid}}"><em class="blue">{{record.getowin_uname}}</em></a></p>
                    <p>揭晓时间：<em class="gray6">{{record.q_end_time | dateFormat:'yyyy年 MM月 dd日 hh:mm:ss'}}</em></p>
                </div>
            {{/if}}
            <a href="<?php echo WEB_PATH; ?>/member/shop/userbuydetail/{{record.oid}}"><b class="z-arrow"></b></a>
        </li>
     {{/each}}
</script>

<script id="userrecord_yes" type="text/html">
</script>
<script id="userrecord_no" type="text/html">
</script>

<script type="text/javascript">
var $datas = <?php echo json_encode( $record ); ?>;
$("#userrecord").append( template( 'userrecord_all', {list:$datas} ) );
$datas = null;

$( "#LoadDataA a" ).click( function() {
    $data = $("#LoadDataA a");
    $data.data( "page", ($data.data("page")|0) + 1 );
    $data.data( "page", $data.data("page") == 1 ? 2 : $data.data("page") );
    if ( $data.data( "maxpage" ) === undefined )
    {
        $data.hide().eq(1).show()
        $.get( APP.WEB_PATH + '/' + APP.G_PARAM_URL + "/p" + $data.data("page"), function( $datas ) {
            if ( $datas.record.length < 20 )
            {
                $data.data( "maxpage", $data.data("page") );
            }
            $("#userrecord").append( template('userrecord_all', {list:$datas.record}) );
            $data.hide().eq(0).show()
        },"json")
    }
    else
    {
        $.get( APP.WEB_PATH + '/' + APP.G_PARAM_URL + "/p" + $data.data("page"), function( $datas ) {
            console.log( $datas.record.length );
            if ( $datas.record.length == 0 )
            {
                $data.hide().eq(2).show();
            }
            else
            {
                $data.data( "maxpage", $data.data("page") );
            }
            $("#userrecord").append( template('userrecord_all', {list:$datas.record}) );
        }, "json" );
    }
});
</script>

<?php include self::includes("index.footer"); ?>