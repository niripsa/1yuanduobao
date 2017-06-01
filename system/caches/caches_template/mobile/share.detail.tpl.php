<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("jquery.Validform.min"); ?>
<?php echo js("jquery.pageDialog"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"晒单详情",
        "Home":true
    }); 
</script>
        <section class="clearfix g-share-lucky">        
            <!-- <s class="z-Reward"></s> -->
            <a class="fl u-lucky-img" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($share_user_record['ouid']); ?>">
            <?php if(get_user_key($share_user_record['ouid'],'img','8080')=='null'): ?>
            <img   src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg" width="58" height="58"></a>
            <?php  else: ?>
            <img   src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($share_user_record['ouid']); ?>" width="58" height="58"></a>
            <?php endif; ?> 
            <div class="u-lucky-r">
                <p>幸运获得者：<a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($share_user_record['ouid']); ?>" class="z-user blue">
                <?php echo $share_user_record['ou_name']; ?></a></p>
                <p>幸运<?php echo L('html.key'); ?>码：<em class="orange"><?php echo $share_user_record['owin']; ?></em></p>
                <p>本期<?php echo L('html.key'); ?>：<em class="orange"><?php echo $share_user_record['onum']; ?></em>人次</p>
                <p>揭晓时间：<em class="arial"><?php echo microt(get_shop_if_jiexiao($share_user_record['ogid'],'q_end_time'),'r'); ?></em></p> 
                
            </div>                
        </section>
        <section class="clearfix g-share-ct">       
            <b class="z-aw-es z-arrow"></b> 
            <article class="m-share-con">
                <h2><?php echo $share_detail['sd_title']; ?></h2>
                <em class="arial"><?php echo microt($share_detail['sd_time'],'r'); ?></em>
                <p class="z-share-pad" id="shareContent"><?php echo $share_detail['sd_content']; ?></p>
                    <?php if(is_array($share_detail['sd_photolist'])) foreach($share_detail['sd_photolist'] AS $G_share_detailimg): ?>     
                    <p><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $G_share_detailimg; ?>"></p>
                    <?php endforeach; ?>                           
            </article>          
            <!--<aside class="clearfix m-share-goods" onclick="location.href='/lottery/detail-17474.html'">
                <h3 class="fl">获得的商品</h3>
                <a class="fl u-goods-img" href="javascript:void(0)"><img border="0" alt="" src="http://mimg.1yyg.com/GoodsPic/Pic-200-200/20130528150540192.jpg"></a>
                <div class="u-goods-r">
                    <p class="z-goods-tt"><a href="javascript:void(0)" class="gray6">(第78期)羽博（Yaoboo）YB-637 移动电源</a></p>
                    <p>价值：<em class="arial">￥178.00</em></p>
                </div>
                <a href="/lottery/detail-17474.html" class="u-rs-m1"><b class="z-arrow"></b></a>
            </aside>-->
            <div class="m-share-fixed">
                <div id="CommentNav"> 
                    <div class="m-share-btn">
                        <div id="divtest" class="u-btn-w"><a id="emHits" class="z-btn-mood"><s></s>羡慕嫉妒恨(<em><?php echo $share_detail['sd_zhan']; ?></em>)</a></div>
                        <div class="u-btn-w"><a id="btnComment" href="javascript:void(0);" class="z-btn-comment"><s></s>我要评论</a></div>
                        <div class="u-btn-w"><a id="btnShare" href="javascript:void(0);" class="z-btn-Share"><s></s>分享</a></div>
                    </div>
                    <div class="m-comment" style="display:none;">
                    <form action="" method="post" id="sharepostform">
                        <div class="u-comment ">
                            <textarea name="sdhf_content" id="comment" rows="3" class="z-comment-txt" ></textarea>
                        </div>
                        <input type="hidden" name="share_submit" value="晒单评论" >
                    </form> 
                        <div class="u-Btn">
                            <div class="u-Btn-li"><a id="btnCancel" href="javascript:;" class="z-CloseBtn">取 消</a></div>
                            <div class="u-Btn-li"><a id="btnPublish" href="javascript:;" class="z-DefineBtn">发表评论</a></div>
                        </div>
                    </div>
                    <div class="m-shareT-round"></div>
                </div>
                <div id="fillDiv" style="display:none;"></div>
            </div>        
            <article class="m-share-comment m-round">
                <h3>共<span id="ReplyCount"  class="z-user orange"><?php echo $share_detail['sd_ping']; ?></span>条评论</h3>
                <ul id="replyList">
                    <?php $mod_common_share = System::load_app_model('share','common');$shaidan_hueifu = $mod_common_share->GetSharePost($share_detail['sd_id'],'10'); ?>   
                    <?php if($shaidan_hueifu): ?>      
                    <?php if(is_array($shaidan_hueifu)) foreach($shaidan_hueifu AS $sdhf): ?>  
                    <li>
                        <a class="fl u-comment-img" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sdhf['sdhf_userid']); ?>">
                            <?php if(!Getuserimg($sdhf['sdhf_userid'])): ?>
                            <img src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg" />
                            <?php  else: ?>
                            <img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($sdhf['sdhf_userid']); ?>"  border="0"/>
                            <?php endif; ?>     
                        </a>
                        <div class="u-comment-r">
                            <p class="z-comment-name"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sdhf['sdhf_userid']); ?>" class="blue"><?php echo userid($sdhf['sdhf_userid'],'username'); ?></a></p>
                            <p class="gray6"><span><?php echo $sdhf['sdhf_content']; ?></span><b><?php echo date("Y-m-d H:i",$sdhf['sdhf_time']); ?></b></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>                 
                </ul>
                <!-- <a id="btnLoadMore" class="loading" href="javascript:void(0);" style="display:none;">点击加载更多</a>
                <div id="divLoading" class="loading"style="display:none;"><b></b>正在加载</div> -->
            </article>
        </section>
<div id="pageDialog" class="pageDialog" style="width:300px; height:100px; position: fixed; display: none;">
    <div class="clearfix m-round f-share-tips"><div class="f-share-tit">请选择以下方式分享</div>
    <a id="btnMsgCancel" href="javascript:void(0)" class="f-share-Close"></a>
    <ul id="shareType" class="f-share-li">
        <li><a href="javascript:void(0);"><b class="z-sina"><s></s></b><em>新浪微博</em></a></li>
        <li><a href="javascript:void(0);"><b class="z-qq"><s></s></b><em>腾讯微博</em></a></li>
        <li><a href="javascript:void(0);"><b class="z-qzone"><s></s></b><em>QQ空间</em></a></li>
    </ul>
    <!-- JiaThis Button BEGIN -->
    <div class="jiathis_style" style="display:none;">   
        <a class="jiathis_button_tsina"></a>
        <a class="jiathis_button_tqq"></a>
        <a class="jiathis_button_qzone"></a>
    </div>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1383891407386925" charset="utf-8"></script>
    <!-- JiaThis Button END -->
    </div> 
</div>      
<script language="javascript" type="text/javascript">
$("#sharepostform").Validform({
    tiptype:function(msg,o,cssctl){ 
        //msg：提示信息;
        //o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
        //cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;     
        if(!o.obj.is("form")){//验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;       
            //$.PageDialog.ok(msg);
        }
    },
    callback:function(data){
        $.PageDialog.ok(data.string);   
        window.location.reload();       
    },
    ajaxPost:true
});
$(function(){   
    //展开发表评论
    $("#btnComment").click(function(){
        $(".m-comment").show();         
    });
    //取消发表
    $("#btnCancel").click(function(){
        $(".m-comment").hide();
    });
    //发表评论
    $("#btnPublish").click(function(){
        if(this.disabled){
            return false;
        }
        //$(this).removeClass("z-DefineBtn").addClass("z-DefineBtngrey");       
        this.disabled = true;           
        var c=$("#comment").val();
        if(!c){
            $.PageDialog.ok('不能为空!');
        }else if(c.length<3){
            $.PageDialog.ok('字符不能少于3个!');
        }else{
            $("#sharepostform").submit();
        }
    });
})
    //分享
    $("#btnShare").click(function(){
        var w=($(window).width()-300)/2,
            h=(window.document.body.clientHeight-100)/2;
            $("#pageDialog").css({top:h,left:w});
            $("#pageDialog").show();
    });
    $("#btnMsgCancel").click(function(){
        $("#pageDialog").hide();
    });
    $("#shareType li").click(function(){
        var n=$(this).index();
        $(".jiathis_style a").eq(n).click();
    });
</script>
<!-- footer 开始-->
<?php include self::includes("index.footer"); ?>