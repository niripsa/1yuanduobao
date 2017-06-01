<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="links_txt">
    <h3><b>文字链接</b></h3>
    <ul>
        <?php $mod_common_index = System::load_app_model('index','common');$link_size = $mod_common_index->link_list(1); ?> 
        <?php if(is_array($link_size)) foreach($link_size AS $size): ?>
        <li><a href="<?php echo $size['url']; ?>" target="_blank"><?php echo $size['name']; ?></a></li>            
        <?php endforeach; ?>   
    </ul>
</div>
<div class="links_txt">
    <h3><b>图片链接</b></h3>
    <ul>
    <?php $mod_common_index = System::load_app_model('index','common');$link_img = $mod_common_index->link_list(2); ?> 
    <?php if(is_array($link_img)) foreach($link_img AS $img): ?>    
        <li><a href="<?php echo $img['url']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $img['logo']; ?>"/></a></li>
    <?php endforeach; ?>           
    </ul>
</div>
<div class="links_exp">
    <h3><b>联系方式</b></h3>
    <p>
        电话：<?php echo _cfg("cell"); ?><br>
    </p>                 
</div>
<!--商品 wrap 结束-->
<div class="clear"></div>
<script>
$(function(){
    $("#referDocument li").bind({       
        mouseover:function(){
            var number=$("#referDocument li").index(this)+1;
            $(".S0"+number).removeClass("hidden");
        },
        mouseout:function(){
            var number=$("#referDocument li").index(this)+1;
            $(".S0"+number).addClass("hidden");
        }
    })
})
</script>
<?php include self::includes("index.footer"); ?>
