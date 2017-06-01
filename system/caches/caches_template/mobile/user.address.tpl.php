<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php echo js("jquery.jsAddress"); ?>
<?php echo js("jquery.pageDialog"); ?>

<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"地址",
        "Member":true,
        "Home":true
    });
</script>

<style type="text/css">
    .m-member-nav{ text-align: center;color:#999; }
    .ress_btn{
        line-height: 35px;       
        text-align: center;
        color: #fff;
        border: 1px solid #ca0626;
        display: inline-block;
        border-radius: 3px;
        box-shadow: 0 1px 2px #fff;
        background: #db3752;
        width:100%;
        font-size: 1.5em;
    }   
    .ress_btn:hover{
        color: #fff;
    }
    #ress_list li{position: relative;text-align:left;}
    #ress_list span{display: inline-block;text-indent: 10px;width: 70%}
    #ress_list li i{ 
        position: absolute;
        display: inline-block;
        right: 10px;
        top:8px;
        color: #fff;
        border-radius: 3px; 
        background: #ccc;
        cursor: pointer;
        text-align: center;
        line-height: 30px;
        padding: 0px 5px;
    }
    #ress_list li i.hover{
        background: #db3752;color: #fff;
    }
    #select{
        text-align: left;text-indent: 10px;
    }
    #select select{
        padding-right: 10px;
    }
    #select input,select{border-radius: 3px; padding-right: 10px;border: 1px solid #bbb;    border-radius: 3px; padding: 5px 8px;}
    .ress_new_box_btn a{ width: 48%; margin-left: 1%;}
    .ress_new_box_btn a:nth-child(1){
        background: #ccc; border: 1px solid #aaa;
    }
</style>

<section class="clearfix g-member" id="ress_list_box">
    <div class="m-round m-member-nav">
        <ul id="ress_list">
            <?php if(is_array($data)) foreach($data AS $row): ?>
                <li><span><?php echo $row['sheng']; ?>,<?php echo $row['shi']; ?>,<?php echo $row['xian']; ?>,<?php echo $row['jiedao']; ?></span>
                <?php if($row['default']=='Y'): ?>
                <i rid="<?php echo $row['id']; ?>" class="hover">默　　认</i>
                <?php  else: ?>
                <i rid="<?php echo $row['id']; ?>">设为默认</i>
                <?php endif; ?>
                </li>                
            <?php endforeach; ?>
        </ul>
    </div>
    <br/>
    <a class="ress_btn" id="new_ress" href="javascript:void(0);">新建地址</a>
    <br/>
</section>

<section class="clearfix g-member" id="ress_new_box" style="display:none">
    <div class="m-round m-member-nav" id="select">
        <li>选择省：<select id="Select1"></select></li>
        <li>选择市：<select id="Select2"></select></li>
        <li>选择区：<select id="Select3"></select></li>
        <li>街　道：<input type="text"></li>
        <li>联系人：<input type="text"></li>
        <li>手　机：<input type="text"></li>
    </div>
    <br/>
    <div class="ress_new_box_btn">
        <a class="ress_btn" href="javascript:void(0);">返回</a><a class="ress_btn" id="new_ress_submit" href="javascript:void(0);">新建地址</a>
    </div>
</section>

<section class="clearfix g-member">
    <div class="m-round m-member-nav">
        <ul>        
            <li>还未添加任何记录</li>
        </ul>
    </div>
</section>

<script type="text/javascript">
    $( function() {
        addressInit('Select1', 'Select2', 'Select3');
        $("#ress_list i").click(function(){
            $("#ress_list i").removeClass("hover").text("设为默认");
            $(this).addClass("hover").text("默　　认");
            $.get("<?php echo WEB_PATH; ?>/member/home/morenaddress/" + $(this).attr("rid"),{},function(data){
                $.PageDialog.ok(data.string);
            },"json");
        });

        $(".ress_new_box_btn a").eq(0).click(function(){
            $("section").hide();
            $("section").eq(0).show();
        });
        $("#new_ress").click(function(){
            $("section").hide();
            $("section").eq(1).show();
        });

        $(".ress_new_box_btn a").eq(1).click( function() {
            var datas = {}
            datas.sheng      = $("select").eq(0).find("option:selected").text();
            datas.shi        = $("select").eq(1).find("option:selected").text();
            datas.xian       = $("select").eq(2).find("option:selected").text();
            datas.jiedao     = $("input").eq(0).val();
            datas.shouhuoren = $("input").eq(1).val();
            datas.mobile     = $("input").eq(2).val();
            datas.submit     = 1;
            $.post( "", datas, function( data ) {
                $.PageDialog.ok( data.string );
                // $(".ress_new_box_btn a").eq(0).click();
                location.reload();
            },'json')
        });
    });
</script>
<?php include self::includes("index.footer"); ?>