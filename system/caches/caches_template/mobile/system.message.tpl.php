<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"提示",
        "Home":true
    }); 
</script>
<div class="g-pay-auto">
    <div class="z-pay-tips"><b><em class="gray6"><?php echo $string; ?></em></b></div>
</div>
<script type="text/javascript">
<?php if($defurl == ':js:'): ?>
setTimeout( "window.history.back()", "<?php echo $time*1000; ?>" );
<?php  else: ?>
setTimeout( "window.location.href='<?php echo $defurl; ?>'", "<?php echo $time*1000; ?>" );
<?php endif; ?>
</script>
<?php include self::includes("index.footer"); ?>