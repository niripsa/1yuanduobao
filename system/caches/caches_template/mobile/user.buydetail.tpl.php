<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"所有购买记录",
        "Home":true,
    }); 
</script>
<style>
.codeshow{
    width:280px;
    display: block;
    overflow: hidden;
}
.m-round li span{
    float:left;
    display: block;
}
</style>
<section class="clearfix g-Record-ct">
    <a class="fl z-Limg" href="
        <?php if($user_record['q_showtime'] == 'Y'): ?>
        <?php echo WEB_PATH; ?>/cgdataserver/<?php echo $user_record['ogid']; ?>
        <?php  else: ?>
        <?php echo WEB_PATH; ?>/cgoods/<?php echo $user_record['ogid']; ?>
        <?php endif; ?>
    "><span class="z-Imgbg z-ImgbgC02"></span><em class="z-Imgtxt">
    <?php if($user_record['q_showtime'] == 'Y'): ?>
    已揭晓...
    <?php  else: ?>
    进行中...
    <?php endif; ?>
    </em>
    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $user_record['g_thumb']; ?>">
    </a>
    <div class="u-Rcd-r gray9"><p class="z-Rcd-tt">
        <a target="_blank" href="
        <?php if($user_record['q_showtime'] == 'Y'): ?>
        <?php echo WEB_PATH; ?>/cgdataserver/<?php echo $user_record['ogid']; ?>
        <?php  else: ?>
        <?php echo WEB_PATH; ?>/cgoods/<?php echo $user_record['ogid']; ?>
        <?php endif; ?>
        " class="gray6">(第<?php echo $user_record['oqishu']; ?>期) <?php echo $user_record['g_title']; ?></a></p>      
     </div>
</section>
<section class="clearfix g-member g-Record-ctlst">
    <b class="z-arrow"></b>
    <article class="m-round">
        <h3>本期商品您总共拥有<em class="orange"><?php echo $user_record['onum']; ?></em>个<?php echo L('html.key'); ?>码</h3>
        <ul>         
            <li><p class="gray9"><?php echo microt($user_record['otime'],'r'); ?><span><?php echo $user_record['onum']; ?>人次</span></p>
            <div class="codeshow">
            <span ><?php echo yunma($user_record['ogocode']); ?></span>
            </div>
            </li>
         </ul>
    </article> 
</section>
<?php include self::includes("index.footer"); ?>