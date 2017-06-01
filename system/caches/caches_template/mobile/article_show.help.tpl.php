<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("jquery.cmsapi"); ?>
<?php include self::includes("index.header_top"); ?>
<script type="text/javascript">
    $.YunCmsApi.SetTopStyle({
        "Title":"新手指南",
        "Home":true,
    }); 
$(function() {
    var a = [0, 0, 0, 0];
    $("div.helpInfo").each(function(b) {
        var d = $(this);
        a[b] = d.offset().top;
        var c = d.children().eq(0);
        var e = d.children().eq(1);
        c.click(function() {
            var f = c.find("i");
            if (f.hasClass("iOpen")) {
                c.removeClass("hShadow");
                f.removeClass("iOpen").addClass("iCollapse");
                e.hide();
                if (b == 3) {
                    c.css("border-bottom", "0 none")
                }
            } else {
                c.addClass("hShadow");
                if (b == 3) {
                    c.css("border-bottom", "")
                }
                f.removeClass("iCollapse").addClass("iOpen");
                e.show();
                d.siblings().each(function() {
                    var g = $(this);
                    g.children().eq(0).addClass("hShadow").find("i").removeClass("iOpen").addClass("iCollapse");
                    g.children().eq(1).hide()
                });
                $("body,html").animate({
                    scrollTop: a[b]
                },
                0)
            }
        })
    });
    $("#dd1").show()
}); 
</script>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/help.css"/>
    <section>
        <div class="helpCon">
            <div class="helpMain m-round">  
            <?php if(is_array($data)) foreach($data AS $key=>$v): ?>
                <div class="helpInfo">
                    <dt>
                        <h3><i class="z-arrow fr iOpen"></i><em>0<?php echo $key+1; ?>.</em><?php echo $v['name']; ?></h3>
                    </dt>
                    <dd id="dd1" class="helpBox" style="display:none;">     
                    <?php echo help($v['cateid']); ?>
                    </dd>
                </div>
            <?php endforeach; ?>  
            </div>
        </div>
    </section>
<!-- footer 开始-->
<?php include self::includes("index.footer"); ?>
