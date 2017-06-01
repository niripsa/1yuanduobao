<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"晒单列表",
        "Home":true,
        "Member":true
    }); 
</script>

    <input name="hidCodeID" type="hidden" id="hidCodeID" value="18101" />
    <input name="hidIsEnd" type="hidden" id="hidIsEnd" value="1" />
    <!-- 晒单记录 -->
    <section class="goodsCon">
        <div class="cSingleCon">            
            <p class="cEntry">已有<em class="orange"><?php echo count($shaidan); ?></em>个幸运者晒单，<em class="orange"><?php echo $totalpl; ?></em>条评论！</p>
            <div id="postList" class="cSingleCon2" style="display:block;" z-minheight>
                <?php if(is_array($shareiframe)) foreach($shareiframe AS $sd): ?>
                <div class="cSingleInfo">
                    <dl class="fl"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $sd['sd_userid']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($sd['sd_userid'],'img'); ?>"><b></b></a></dl>
                    <div class="cSingleR m-round" id="<?php echo $sd['sd_id']; ?>">
                        <ul>
                            <li><em class="blue" uweb="<?php echo $sd['sd_userid']; ?>"><?php echo userid($sd['sd_userid'],'username'); ?></em><strong>：</strong><span><?php echo $sd['sd_title']; ?></span></li>
                            
                            <li><h3><b>第<?php echo $sd['qishu']; ?>期晒单</b> <?php echo date('Y-m-d H:i:s',$sd['sd_time']); ?></h3></li>
                            <li><p><?php echo $sd['sd_content']; ?></p></li>
                            <li class="maxImg">
                                <?php if(is_array($sd['sd_photolist'])) foreach($sd['sd_photolist'] AS $sd_photolist): ?>
                                    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd_photolist; ?>" border=0 />
                                <?php endforeach; ?>                           
                            </li>
                            <li><dd><s></s><strong><?php echo $sd['sd_zhan']; ?></strong>人羡慕嫉妒</dd><dd><i></i><strong><?php echo $sd['sd_ping']; ?></strong>条评论</dd></li>
                        </ul><b class="z-arrow"></b>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
 <!-- footer 开始-->
<?php include self::includes("index.footer"); ?>

<script language="javascript" type="text/javascript">
//跳转页面
    $(".cSingleInfo li:not(:first)").click(function(){
        var id=$(this).parent().parent().attr('id');
        if(id){
            window.location.href="<?php echo WEB_PATH; ?>/mobile/shaidan/detail/"+id;
        }           
    });
    $(".cSingleInfo .blue").click(function(){
        var id=$(this).attr('uweb');
        if(id){
            window.location.href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/"+id;
        }   
    }); 
</script>

</div>

