<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"图文详情",
        "Home":true,
        "Member":true
    }); 
    
    //$("#divRecordList").css("width",$(window).width());
</script>
<style>
#divRecordList {  
  display:block;overflow:hidden
}
#divRecordList img{  
  width:100%;!important;
}

#divRecordList table{  
  width:100%;!important
}

</style>
<div id="divRecordList" class="z-minheight">
    <?php echo $item['g_content']; ?>
</div>
<!-- footer 开始-->
<?php include self::includes("index.footer"); ?>
