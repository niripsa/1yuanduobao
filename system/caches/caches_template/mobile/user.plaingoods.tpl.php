<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"商品",
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
        <a class="fl z-Limg" href="<?php echo WEB_PATH; ?>/goods/<?php echo $recd['otext']['gid']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $recd['otext']['g_thumb']; ?>" border="0" alt=""></a>
        <div class="u-gds-r gray9">
            <p class="z-gds-tt"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $recd['otext']['gid']; ?>" class="gray6"><?php echo $recd['otext']['g_title']; ?></a></p>
                <br/><br/><?php if(Getships($recd['oid'],'id',1)): ?><span>物流公司:::<?php echo Getships($recd['oid'],'eid',1); ?></span>快递单号:::<?php echo Getships($recd['oid'],'ecode',1); ?><?php endif; ?>
            <p><?php if(GetOrders($recd['oid'],'ofstatus')): ?>
                    <b ><?php echo GetOrders($recd['oid'],'ofstatus'); ?></b>
                <?php  else: ?>
                    <b>等待发货</b>
                <?php endif; ?></p>
        </div>
        <b class="z-arrow"></b>
    </li>
<?php endforeach; ?>
<?php endif; ?>
</ul>
</section>
<?php include self::includes("index.footer"); ?>
