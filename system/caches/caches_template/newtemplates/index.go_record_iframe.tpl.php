<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/Comm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/color.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/css.css"/>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<style>
.AllRecW .AllRecR .AllRecR_T span.user_see_code{
    color: #fff;
}
.AllRecR{ border:1px solid #f8f8f8; background:#f8f8f8; padding:5px 0px; position:relative;}
.user_codes_box{ display:none }
.user_codes { color:#aaa; padding-left:35px;word-break:break-all;overflow:hidden;}
.user_codes i{ width:75px; display:inline-block; text-align:center; height:20px;}
.user_codes_js { width:100%; line-height:40px; background:#f8f8f8;text-align:center; color:#999; cursor:pointer;}
.user_see_code{border-radius:5px; position:absolute; right:10px; width:75px; text-align:center; height:25px; line-height:25px; background:#db3752; cursor:pointer; display:none;}
</style>
</head>

<body style="width:970px; min-height:35px;  padding-top:20px;background-color:#fff">
        <?php if(!$go_record_list): ?>
            <h1 style=" text-align:center;width:100%;font-size:22px; font-weight:bold;color:#555;">还没有购买记录,赶快购买吧!</h1>
        <?php endif; ?>
        <!--获取当前会商品的购买记录50条-->     
        <?php if(is_array($go_record_list)) foreach($go_record_list AS $user): ?>
        <?php if($user['tag']=='2'): ?>
        <div class="AllRecW AllRecTime"><p><?php echo date("Y-m-d",$user['otime']); ?></p> <b></b></div>
        <?php endif; ?>
        <?php if($user['tag']=='3'): ?>
        <div class="AllRecW AllRecTime"><p><?php echo date("Y-m-d",$user['otime']); ?></p> <b></b></div>
        <?php endif; ?>
        <div class="AllRecW AllReclist"><div class="AllRecL fl"><?php echo microt($user['otime']); ?><i></i></div>
            <div class="AllRecR fl">
            <p class="AllRecR_T">
                <span name="spCodeInfo" class="AllRecR_Over">
                <a class="Headpic" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['ouid']); ?>" target="_blank">
                <?php if(get_user_key($user['ouid'],'img','3030')=='null'): ?>
                <img src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg.3030.jpg" border="0" width="20" height="20"></a>
                <?php  else: ?>
                <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getuserimg($user['ouid']); ?>.3030.jpg" border="0" width="20" height="20"></a>               
                <?php endif; ?>
                <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($user['ouid']); ?>" target="_blank" class="blue"><?php echo get_user_key($user['ouid'],'username'); ?></a>
                购买了<em class="Fb orange"><?php echo $user['onum']; ?></em>人次
                </span>
                <span class="user_see_code" see="off">查看夺宝码</span>
            </p>
                <div class="user_codes_box">
                    <div class="user_codes" style="max-height:260px;">
                    <?php if(is_array(explode(",",$user['ogocode']))) foreach(explode(",",$user['ogocode']) AS $c): ?>
                    <i><?php echo $c; ?></i>
                    <?php endforeach; ?>
                    </div>
                   <?php if($user['onum'] > '98'): ?><div class="user_codes_js" click="off" num="<?php echo $user['onum']; ?>">展开查看全部↓</div><?php endif; ?>
                </div>
            </div>
        </div>
         <?php endforeach; ?>
        <!--/获取当前会商品的购买记录-->
            <!--<div class="pagesx" style=" padding-right:30px;"> <?php echo $total; ?></div>-->
<script>
$(function(){
    
    window.parent.set_iframe_height("iframea_bitem","bitem",document.body.offsetHeight+120);
    window.onclick=function(){
        window.parent.set_iframe_height("iframea_bitem","bitem",document.body.offsetHeight+120);
    };
    
    

    $(".AllRecR").mousemove(function(){
        $(this).css("border","1px solid #eee");
        $(this).find(".user_see_code").show();
    });
    
    
    $(".AllRecR").mouseleave(function(){
        $(this).css("border","1px solid #f8f8f8");
        if($(this).find(".user_see_code").attr("see") == 'off'){
        $(this).find(".user_see_code").hide();
        }
    });
    
    $(".user_see_code").click(function(){
        if($(this).attr("see")=='off'){
            $(this).attr("see","on");
            $(this).text("关闭夺宝码");           
    
            $(this).parent("p.AllRecR_T").next().show();
        }else{
            $(this).text("显示夺宝码")
            $(this).attr("see","off");      
         $(this).parent("p.AllRecR_T").next().hide();
        }
    }); 
    
    $(".user_codes_js").click(function(){   
        var codes = $(this).prev();
        if($(this).attr("click") == 'off'){
            var num = $(this).attr("num");      
            var line = Math.ceil(num / 7) * 20; 
            codes.css("max-height",line+"px");
            $(this).attr("click","on");
            $(this).text("收起全部↑");
        }else{
            codes.css("max-height","260px");
            $(this).attr("click","off");
            $(this).text("展开查看全部↓");
        }   
    });
});
</script>
</body>
</html>