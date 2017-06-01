<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include self::includes("index.header"); ?>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.Validform.min.js"></script>
<div class="clear"></div>
<!--商品 wrap 开始-->
<div class="wrap w1200">
    <div class="Current_nav w1200"><a href="index.html">首页</a><a href="<?php echo WEB_PATH; ?>/index/share/init/"> &gt; 晒单分享</a> &gt; 晒单详情</div>
    <div class="share_box b_gray">
        <div class="share_box_left fl br_gray">
            <div class="share_main">
                <div class="share_title">
                    <h3><?php echo $share_detail['sd_title']; ?></h3>
                    <div class="share_time">晒单时间：<span><?php echo microt($share_detail['sd_time'],'r'); ?></span></div>
                </div>
                <div class="share_goods b_gray">            
                    <div class="share-get">
                        <a class="fl-img" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($share_user_record['ouid']); ?>"  target="_blank">
                    <?php if(get_user_key($share_user_record['ouid'],'img','8080')=='null'): ?>
                    <img   src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="58" height="58"></a>
                    <?php  else: ?>
                    <img   src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($share_user_record['ouid'],'img','8080'); ?>" width="58" height="58"></a>
                    <?php endif; ?>     
                        <div class="share-getinfo">
                            <p class="getinfo-name">幸运获得者：<a class="blue Fb" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($share_user_record['ouid']); ?>" target="_blank"><?php echo get_user_key($share_user_record['ouid'],'username'); ?></a></p>
                            <p>总共<?php echo L('html.key'); ?>：<b class="c_red"><?php echo $share_user_record['onum']; ?></b>人次</p>
                            <p>幸运<?php echo L('html.key'); ?>码：<?php echo $share_user_record['owin']; ?></p>
                            <p>揭晓时间：<?php echo microt(get_shop_if_jiexiao($share_user_record['ogid'],'q_end_time'),'r'); ?></p>
                        </div>
                    </div>
                    <div class="share-Conduct bl_gray">
                        <a class="fl-img b_gray" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $cloud_goodsdetail['id']; ?>" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $cloud_goodsdetail['g_thumb']; ?>"></a>
                        <div class="share-getinfo">                       
                            <p class="getinfo-title">
                                <a class="gray01" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $cloud_goodsdetail['id']; ?>" target="_blank">(第<?php echo $cloud_goodsdetail['qishu']; ?>期)<?php echo $cloud_goodsdetail['g_title']; ?></a>
                            </p>
                            <p>价值：<?php echo $cloud_goodsdetail['g_money']; ?>   <?php echo L('cgoods.currency'); ?></p>
                            <?php $mod_common_cloud_goods = System::load_app_model('cloud_goods','common');$lastone = $mod_common_cloud_goods->cloud_goodslastone($cloud_goodsdetail['gid']); ?> 
                            <?php if($lastone): ?>
                            <p><a class="getbut-a c_red b_gray" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $lastone['id']; ?>"  target="_blank">(第<?php echo $lastone['qishu']; ?>期)进行中……</a></p>
                            <?php  else: ?>
                            <p><a class="getbut-a c_red b_gray" href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $cloud_goodsdetail['id']; ?>"  target="_blank">已揭晓</a></p>
                            <?php endif; ?>
                        </div>
                    </div>                      
                </div>
                <div class="share_content">
                    <p class="content-pad"></p><p><?php echo $share_detail['sd_content']; ?></p><p></p>
                    <?php if(is_array($share_detail['sd_photolist'])) foreach($share_detail['sd_photolist'] AS $G_share_detailimg): ?>     
                    <p><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $G_share_detailimg; ?>"> </p>
                    <?php endforeach; ?>
                </div>
                <div class="mood">
                    <div class="moodwm">
                        <div class="moodm fl hidden" style="display: block;">
                             <span class="smile bg_red" id="emHits"><i></i><b>羡慕嫉妒恨(<em><?php echo $share_detail['sd_zhan']; ?></em>)</b></span>
                             <span class="much"><i></i>评论(<em id="emReplyCount"><?php echo $share_detail['sd_ping']; ?></em>)</span>
                        </div>                  
                        <div class="share">
                            <span class="fen fl">分享到：</span>
                                <div style="margin-top:4px;">
                                    <!-- JiaThis Button BEGIN -->           
                                    <div class="jiathis_style">
                                        <a class="jiathis_button_qzone"></a>
                                        <a class="jiathis_button_tsina"></a>
                                        <a class="jiathis_button_tqq"></a>
                                        <a class="jiathis_button_weixin"></a>
                                        <a class="jiathis_button_renren"></a>
                                        <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                                    </div>
                                    <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
                                    <!-- JiaThis Button END -->
                                </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php if($user=login('bool')): ?> 
            <div id="bottomComment" class="qcomment_bottom_reply clearfix"><!--登录后-->
                <div class="Comment_Reply clearfix">
                    <div class="Comment-pic">
                        <img id="imgUserPhoto" src="<?php echo G_TEMPLATES_IMAGE; ?>//u859.png" width="50" height="50">
                    </div>
                    <div class="Comment_form">
                        <div class="Comment_textbox">
                            <form action="" method="post" id="sharepostform" onsubmit="getElById('sharepostsubmit').disabled = true;">
                                <textarea name="sdhf_content" class="Comment-txt"></textarea>           
                                <div style="line-height:25px;margin-top:5px;display: inline-block;padding:0px;">
                                    <span style="color:#aaa;float:left;font-size:12px">验证码: </span>
                                    <input type="text" name="sdhf_code" style="margin-left:3px;width:80px;height:25px;float:left;padding-left:4px;" ajaxurl="<?php echo G_WEB_PATH; ?>/?plugin=1&api=Captcha&action=check" datatype="*4-6" nullmsg="请输入验证码！" errormsg="请输入正确的验证码！">
                                    <img style="float:left;" id="checkcode" src="<?php echo WEB_PATH; ?>/plugin=true&api=Captcha"/>      
                                    <span class="Validform_checktip" style="display:block;float:left;width:100px;height:30px;line-height:34px;"></span>
                                </div>                      
                                <input type="submit" name="share_submit" id="sharepostsubmit" value="发表评论" class="reply_unbotton">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php  else: ?>
            <div id="bottomComment" class="qcomment_bottom_reply clearfix"><!--登录前-->
                <div class="Comment_Reply clearfix">
                    <div class="Comment-pic"><img src="<?php echo G_TEMPLATES_IMAGE; ?>/u859.png" width="50" height="50"></div>
                    <div class="Comment_form">
                        <div class="Comment_textbox">           
                            <div id="notLogin" name="replyLogin" class="Comment_login">
                                请您<a href="<?php echo WEB_PATH; ?>/login/" target="_blank" class="blue" name="replyLoginBtn">登录</a>
                                或<a href="<?php echo WEB_PATH; ?>/register/" target="_blank" class="blue">注册</a>后再回复评论
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div id="commentMain" class="qcomment_main">
                <ul>
                    <?php $mod_common_share = System::load_app_model('share','common');$shaidan_hueifu = $mod_common_share->GetSharePost($share_detail['sd_id'],'10'); ?>   
                    <?php if($shaidan_hueifu): ?>      
                    <?php if(is_array($shaidan_hueifu)) foreach($shaidan_hueifu AS $sdhf): ?>                  
                    <li class="Comment_single">
                        <div class="Comment_box_con clearfix">
                            <div class="User_head">
                            <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sdhf['sdhf_userid']); ?>" target="_blank" >
                                <?php if(!Getuserimg($sdhf['sdhf_userid'])): ?>
                                <img src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg" width="50" height="50" />
                                <?php  else: ?>
                                <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($sdhf['sdhf_userid']); ?>.8080.jpg" width="50" height="50" border="0"/>
                                <?php endif; ?>     
                            </a>
                            </div>
                            <div class="Comment_con">
                                <div class="Comment_User">
                                    <span><a class="blue" href="#" target="_blank"><?php echo userid($sdhf['sdhf_userid'],'username'); ?></a></span>
                                </div>
                                <div class="C_summary"><?php echo $sdhf['sdhf_content']; ?>
                                <br/><span class="Summary-time"><?php echo date("Y-m-d H:i",$sdhf['sdhf_time']); ?></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

            </div>
             
        </div>
        <div class="Comment_right">
            <div class="Comment_victory">
                <div class="Comment_share">
                    <h4>最新晒单</h4>
                    <?php $mod_common_share = System::load_app_model('share','common');$G_ShareListnew = $mod_common_share->GetShareListnew(7); ?> 
                    <?php if(is_array($G_ShareListnew)) foreach($G_ShareListnew AS $G_sharelist): ?>
                    <div class="New-single">
                        <p class="New-single-time"><a class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($G_sharelist['sd_userid']); ?>" target="_blank"><?php echo Getusername($G_sharelist['sd_userid']); ?></a><?php echo microt($G_sharelist['sd_time'],'r'); ?></p>
                        <p class="New-single-C"><a href=""></a></p><p><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $G_sharelist['sd_id']; ?>" target="_blank"><?php echo $G_sharelist['sd_title']; ?></a></p><p></p>
                        <div class="New-singleImg">
                            <div class="arrow arrow_Rleft"><em>◆</em></div>
                        <?php if(is_array($G_sharelist['sd_photolist'])) foreach($G_sharelist['sd_photolist'] AS $G_sharelistimg): ?>  
                        <a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $G_sharelist['sd_id']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $G_sharelistimg; ?>"></a>
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>  
    </div>
</div>
<!--商品 wrap 结束-->
<script>
$(function(){
/*
    $("#sharepostform").Validform({
        tiptype:function(msg,o,cssctl){
            var objtip=o.obj.parent().find(".Validform_checktip");
            cssctl(objtip,o.type);
            if(o.type==3){
                $("#checkcode").click();
            }           
        },
        ajaxPost:true,
        callback:function(data){
            console.log(data);
            console.log(data.status);           
            if(data.status != 1){
            console.log(11);
                $("#checkcode").click();
            }else{
            console.log(22);
                location.reload();
            }
        }

    });
*/  
    if($.cookie('Share_Envy')==<?php echo $share_detail['sd_id']; ?>){
        $("#emHits").addClass("smile-have");
        return false;
    }else{
        $("#emHits").click(function(){
           if($.cookie('Share_Envy')!=<?php echo $share_detail['sd_id']; ?>){
            $.post(
                "<?php echo WEB_PATH; ?>/index/share/Share_Envy/",
                {Share_Envyid:"<?php echo $share_detail['sd_id']; ?>"},
                function(data){
                    $("#emHits em").text(data);
                    $("#emHits").addClass("smile-have");
                    $.cookie("Share_Envy","<?php echo $share_detail['sd_id']; ?>", { expires:7,path: '/'});
                }
            );                           
               
           }

        })     
       
    }

})
$("#checkcode").attr("data",$("#checkcode").attr("src"));
$("#checkcode").click(function(){
    $(this).attr("src",$(this).attr("data")+"&="+new Date().getTime());     
});
</script>
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>
