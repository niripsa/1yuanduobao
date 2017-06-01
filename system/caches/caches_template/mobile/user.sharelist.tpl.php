<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"晒单",
        "Member":true,
        "Home":true
    });
</script>

<div id="navBox" class="g-snav m_listNav">
    <div id="div_share_1" class="g-snav-lst z-sgl-crt" state="-1"><a onclick="the_sun( 1 );" class="gray9">已晒单</a><b></b></div>
    <div id="div_share_0" class="g-snav-lst" state="1"><a onclick="the_sun( 0 );" class="gray9">未晒单</a><b></b></div>
</div>

<!-- 已晒单 Start -->
<span id="share" style="display: block;">
<?php if(!$shareed): ?>
<section class="clearfix g-Record-lst"><!-- 无记录 -->
    <ul class="z-minheight">
        <div class="haveNot z-minheight"><s></s><p>暂无记录</p></div>
        <div id="divGoodsLoading" class="loading" style="display:none;"><b></b>正在加载</div>
        <a id="btnLoadMore" class="loading" href="javascript:;" style="display:none;">点击加载更多</a>
    </ul>
</section>
<?php  else: ?>
<section id="divUnPost" class="clearfix g-Single-lst z-minheight"><!-- 有记录 -->
    <ul>
    <?php if(is_array($shareed)) foreach($shareed AS $sd): ?>
    <li class="bornone" onclick="location.href='<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>'">
    <a class="fl z-Limg" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>">
    <img width="40" alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>" border="0">
    </a>
    <div class="u-sgl-r"><p class="z-sgl-tt">
    <a class="gray6" href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $sd['sd_id']; ?>">​<?php echo $sd['sd_title']; ?></a>
    </p>
    <p class="z-sgl-info gray9"><p><?php echo _strcut($sd['sd_content'],50); ?></p><p></p>
    <p>晒单时间：<?php echo date('Y-m-d H:i:s',$sd['sd_time']); ?></p></div><b class="z-arrow"></b>
    </li>
    <?php endforeach; ?>
    </ul>
</section>
<?php endif; ?>
</span>
<!-- 已晒单 End -->

<!-- 未晒单 Start -->
<span id="share_no" style="display: none;">
<?php if(!$share): ?>
<section class="clearfix g-Record-lst"><!-- 无记录 -->
    <ul class="z-minheight">
        <div class="haveNot z-minheight"><s></s><p>暂无记录</p></div>
        <div id="divGoodsLoading" class="loading" style="display: none;"><b></b>正在加载</div>
        <a id="btnLoadMore" class="loading" href="javascript:;" style="display:none;">点击加载更多</a>
    </ul>
</section>
<?php  else: ?>
<section class="clearfix g-Single-lst z-minheight"><!-- 有记录 -->
    <ul>
    <?php if(is_array($share)) foreach($share AS $sd): ?>
    <li class="bornone" onclick="location.href='<?php echo WEB_PATH; ?>/member/share/share_mobile/<?php echo $sd['oid']; ?>'">
    <a class="fl z-Limg" href="#">
    <img width="40" alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['g_thumb']; ?>" border="0">
    </a>
    <div class="u-sgl-r"><p class="z-sgl-tt">
    <a class="gray6" href="#">​<?php echo $sd['sd_title']; ?></a>
    </p>
    <p class="z-sgl-info gray9"><p><?php echo _strcut($sd['sd_content'],50); ?></p><p></p>
    <p>中奖时间：<?php echo $sd['sd_time']; ?></p></div><b class="z-arrow"></b>
    </li>
    <?php endforeach; ?>
    </ul>
</section>
<?php endif; ?>
</span>
<!-- 未晒单 End -->
<script type="text/javascript">
    function the_sun( status )
    {
        if ( status == 1 )
        {
            $( '#div_share_0' ).removeClass( 'z-sgl-crt' );
            $( '#div_share_1' ).addClass( 'z-sgl-crt' );
            $( '#share_no' ).hide();
            $( '#share' ).show();
        }
        else
        {
            $( '#div_share_0' ).addClass( 'z-sgl-crt' );
            $( '#div_share_1' ).removeClass( 'z-sgl-crt' );
            $( '#share_no' ).show();
            $( '#share' ).hide();
        }
    }
</script>
<?php include self::includes("index.footer"); ?>