<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("xxgoods"); ?>
<?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"所有购买记录",
        "Home":true,
        "Member":true
    }); 
</script>
<!-- 夺宝记录 -->
<section id="buyRecordPage" class="goodsCon">
    <div id="divRecordList" class="recordCon z-minheight" style="display:block;">
       <?php if(is_array($go_record_list)) foreach($go_record_list AS $c): ?> 
        <ul>
            <li class="rBg"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($c['ouid']); ?>" >
                <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($c['ouid'],'img'); ?>" border="0"/>
                <s></s></a>
            </li>
            <li class="rInfo"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($c['ouid']); ?>" ><?php echo userid($c['ouid'],'username'); ?></a>
                <strong>
                    <?php if($c['oip']): ?>
                    (<?php echo get_ip($c['oip'],'ipcity'); ?>)
                    <?php endif; ?> 
                </strong><br>
                <span>购买<?php echo $c['onum']; ?>人次</span><em class="arial"><?php echo date("Y-m-d H:i:s",$c['otime']); ?></em>
            </li><i></i>
        </ul>
       <?php endforeach; ?>
    </div>
</section>
<!-- footer 开始-->
<?php include self::includes("index.footer"); ?>