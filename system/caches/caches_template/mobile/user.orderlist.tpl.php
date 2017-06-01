<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"中奖商品",
        "Member":true,
        "Home":true
    });
</script>

<?php if(count($record)==0): ?>
<section class="clearfix g-Record-lst" style="display:block">
    <ul class="z-minheight">
        <div class="haveNot z-minheight"><s></s><p>暂无记录</p></div>
        <div id="divGoodsLoading" class="loading" style="display:none;"><b></b>正在加载</div>
        <a id="btnLoadMore" class="loading" href="javascript:;" style="display:none;">点击加载更多</a>
    </ul>
</section>
<?php  else: ?>
<section class="clearfix g-Record-lst" style="display:block">
<ul class="z-minheight">

<?php if(is_array($record)) foreach($record AS $recd): ?>
    <li>
        <a class="fl z-Limg" href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $recd['ogid']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo useri_title($recd['og_title'],'g_thumb'); ?>" border="0" alt=""></a>
        <div class="u-gds-r gray9">
            <p class="z-gds-tt"><a href="<?php echo WEB_PATH; ?>/cgdataserver/<?php echo $recd['ogid']; ?>" class="gray6">(第<?php echo $recd['oqishu']; ?>期)<?php echo useri_title($recd['og_title'],'g_title'); ?></a></p>
            <p>幸运<?php echo L('html.key'); ?>码：<em class="orange"><?php echo $recd['owin']; ?></em></p>
            <p>购买时间：<?php echo microt($recd['otime']); ?></p>
        </div>
        <b class="z-arrow"></b>
    </li>
<?php endforeach; ?>
<?php endif; ?>
</ul>
</section>
<?php include self::includes("index.footer"); ?>
