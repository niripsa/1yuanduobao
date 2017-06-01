<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/comm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/color.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/css.css"/>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>   
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cookie.js"></script>
<script>
$(function(){
    window.parent.set_iframe_height("iframea_divPost","divPost",document.body.offsetHeight+120);
});

</script>
</head>
<style type="text/css">
.Single_Content {
overflow: hidden;
border-top: none;
background: #fff;
margin: auto;
}
.Single_list {
width: 918px;
overflow: hidden;
margin: 30px auto 15px;
padding: 0 0 19px 0;
border-bottom: 1px solid #E4E4E4;
}
.Single_list .Topiclist-img {
width: 80px;
overflow: hidden;
text-align: center;
float: left;
}
.Single_list .Topiclist-img .head-img {
width: 80px;
margin: 0 auto;
display: block;
}
.Single_list .Topiclist-img .head-img img {
width: 80px;
height: 80px;
}
.Single_list .Topiclist-img .blue {
white-space: nowrap;
width: 80px;
overflow: hidden;
display: block;
}
.Single_list .SingleR {
width: 782px;
margin-left: 48px;
display: inline;
}
.fl, .fl-img {
float: left;
}
.Single_list .SingleR_TC {
position: relative;
zoom: 1;
}
.Single_list .SingleR_TC i {
left: -28px;
top: 0;
background-position: -143px 0;
}
.Single_list .SingleR_TC s {
right: 0;
bottom: 12px;
background-position: -168px 0;
}
.Single_list .SingleR_TC h3 {
color: #999;
font-family: 微软雅黑,宋体;
font-size: 18px;
color: #333;
line-height: 24px;
}
.Single_list .SingleR_TC h3 span {
font-size: 14px;
}
a {
color: #333;
text-decoration: none;
outline: none;
}
.Single_list .SingleR_TC h3 em {
font-size: 12px;
}
.gray02 {
color: #999;
}
.Single_list .SingleR_TC p {
padding: 7px 25px 12px 0;
}
.gray01 {
color: #666;
}
.Single_list .SingleR_TC p {
padding: 7px 25px 12px 0;
}
.Single_list ul.SingleR_pic {
display: inline-block;
}
.Single_list .SingleR_pic li {
float: left;
margin-right: 10px;
display: inline;
}
.Single_list .SingleR_Comment .Comment_smile {
height: 25px;
padding-top: 6px;
}
.SingleR_Comment .Comment_smile span {
margin-right: 40px;
}
.SingleR_Comment .Comment_smile span i {
background: url(<?php echo G_TEMPLATES_STYLE; ?>/images/Detailsbg.png) no-repeat;
width: 18px;
height: 18px;
display: inline-block;
vertical-align: -4px;
background-position: -198px 0;
margin-right: 3px;
}
.SingleR_Comment .Comment_smile span s {
width: 18px;
height: 18px;
display: inline-block;
vertical-align: -8px;
background-position: -230px 0;
margin-right: 0;
}
</style>
<script>
function shareemHits(shareid){
    if($.cookie('Share_Envy')==shareid){
        $("#emHits"+shareid).addClass("smile-have");
        return false;
    }
    $("#emHits"+shareid).click(function(){
        if($.cookie('Share_Envy')!=shareid){
            $.post(
                "<?php echo WEB_PATH; ?>/index/share/Share_Envy/",
                {Share_Envyid:shareid},
                function(data){
                    $("#emHits"+shareid+" em").text(data);
                    $("#emHits"+shareid).addClass("smile-have");
                    $.cookie("Share_Envy",shareid, { expires:7,path: '/'});
                }
            );                        
        }      

    })
}
</script>    
<body style="width:970px; min-height:150px">
    <?php if($error==0): ?>
        <div id="divPost" class="Single_Content">
        <?php if(is_array($shareiframe)) foreach($shareiframe AS $v): ?>           
            <div class="Single_list">
                <div class="SingleL fl Topiclist-img">
                    <a rel="nofollow" class="head-img" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($member_id[$v['sd_id']]); ?>" type="showCard" uweb="1000371861" target="_blank">
                        <img border="0" alt="" src="<?php if(get_user_key($member_id[$v['sd_id']],'img','8080')): ?> <?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($member_id[$v['sd_id']]); ?>.8080.jpg<?php  else: ?><?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.8080.jpg<?php endif; ?>">
                    </a>
                    <a class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($member_id[$v['sd_id']]); ?>" type="showCard" uweb="1000371861" target="_blank"><?php echo $member_username[$v['sd_id']]; ?></a>
                    <!--span class="class-icon02"><s></s>黄金夺宝猎人</span-->
                </div>
                <div class="SingleR fl">
                    <div class="SingleR_TC"><i></i> <s></s>
                        <h3><span class="gray02">第<?php echo $v['qishu']; ?>期晒单</span><a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $v['sd_id']; ?>" target="_blank"><?php echo $v['sd_title']; ?></a>   <em class="gray02"><?php echo date("Y-m-d",$v['sd_time']); ?></em></h3>
                        <p class="gray01"><?php echo _strcut($v['sd_content'],220); ?></p>
                    </div>
                    <ul class="SingleR_pic">
                    <?php if(is_array($v['sd_photolist'])) foreach($v['sd_photolist'] AS $sd_photolist): ?>
                        <li><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd_photolist; ?>" border=0 /></li>
                    <?php endforeach; ?>
                    </ul>
                    <div class="SingleR_Comment" postID="2676" count="7">
                        <div class="moodm fl hidden"  style="display: block;margin-top: 10px;" >
                        <a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $v['sd_id']; ?>" target="_blank"> <span class="smile bg_red"><i></i><em><?php echo $v['sd_zhan']; ?></em>人羡慕嫉妒恨</span></a>
                       <a href="<?php echo WEB_PATH; ?>/index/share/detail/<?php echo $v['sd_id']; ?>" target="_blank"><span class="much"><i></i><s></s><?php echo $v['sd_ping']; ?>条评论 <span></span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if($total>$num): ?>
            <div class="pagesx" style="margin: 25px 90px 25px 0;"><?php echo $page->show('two'); ?></div>
        <?php endif; ?>
        </div>       
    <?php  else: ?>
        <div style="text-align:center;width:100%;height:80px;line-height:80px;">
            <b>该商品还未有晒单！</b>
        </div>
    <?php endif; ?> 
</body>
</html>