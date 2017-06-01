<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("goods"); ?>
<?php echo js("jquery.cmsapi"); ?>
<?php echo js("template"); ?>
<?php echo js("template.fun"); ?>
<?php echo js("jquery.cartlist"); ?>
<?php include self::includes("index.header"); ?>
<!-- 栏目导航 开始-->
<!-- <?php include self::includes("index.navs"); ?> -->
<!-- 栏目导航 结束-->
<section class="goodsCon" style="background:#fff;">
    <!-- 导航 -->
<!--     <div class="goodsNav">
        <ul id="divGoodsNav">
        
            <li order="10" <?php if($sort=='1' ): ?> class="current" <?php endif; ?>>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_1#b">即将揭晓<b></b></a>
            </li>
            <li order="20" <?php if($sort=='2' ): ?> class="current" <?php endif; ?>>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_2#b">人气<b></b></a>
            </li>
            <li order="40" <?php if($sort=='4' ): ?> class="current" <?php endif; ?>>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_4#b">最新<b></b></a>
            </li>
            <li order="50" type="price" <?php if($sort=='5' ): ?> class="current" <?php endif; ?>>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_5#b">价值<em></em><s></s><b></b></a>
            </li>
            <li order=""><?php if($cid=='0'): ?>
                <a href="javascript:;">商品分类<s class="arrowUp"></s></a><?php  else: ?>
                <a href="javascript:;"><?php echo catname($cid); ?><s class="arrowUp"></s></a><?php endif; ?>
                <dl style="display:none;">
                    <dd type="0" class="sOrange">
                        <a href="<?php echo WEB_PATH; ?>/cgoods_list/0_0_<?php echo $sort; ?>">全部</a>
                    </dd><?php if(is_array(GetCate('0',12,10))) foreach(GetCate('0',12,10) AS $v): ?>
                    <dd>
                        <a id="<?php echo $v['cateid']; ?>" href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $v['cateid']; ?>_0_<?php echo $sort; ?>"><?php echo $v['name']; ?></a>
                    </dd><?php endforeach; ?></dl>
            </li>
        </ul>
    </div> -->
    <!-- 列表 -->
    <div class="goodsList" id="goodsList">
        <?php if(is_array($cpgoodslist)) foreach($cpgoodslist AS $shop): ?>
        <ul>
            <li>
                <span class="z-Limg">
                    <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"></a>
                </span>
                <div class="goodsListR">
                    <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>"><h2 ><?php echo $shop['g_title']; ?></h2></a>
                    <div class="pRate">
                        <div class="Progress-bar">
                            <p class="u-progress">
                                <span class="pgbar" style="width:<?php echo intval(width($shop['canyurenshu'],$shop['zongrenshu'],100)); ?>%;">
                                    <span class="pging"></span>
                                </span>
                            </p>
                            <ul class="Pro-bar-li">
                                <li class="P-bar01">
                                    <em><?php echo $shop['canyurenshu']; ?></em>已参与</li>
                                <li class="P-bar02">
                                    <em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                                <li class="P-bar03">
                                    <em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</li>
                            </ul>
                        </div>
                        <a class="add " codeid="16901" onclick="gcartlist.gocartlist(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>','<?php echo GetConfig('cookie_pre'); ?>')" href="javascript:;"><s></s></a>

                    </div>
                </div>
            </li>
        </ul>
        <?php endforeach; ?>
    </div>
        <!--  <div id="LoadDataA">
            <a class="loading" href="javascript:void(0)">点击加载更多</a>
            <a class="loading" href="javascript:void(0)" style="display:none;">正在加载...</a>
            <a class="loading" href="javascript:void(0)" style="display:none;">没有数据了</a>
            <a class="loading" href="javascript:void(0)" style="display:none;">已经到底了</a>
        </div> -->
</section>
<!-- footer 开始-->
<script id="goodsListData" type="text/html">
    {{each list as shop i}}
       <ul>
            <li>
                <span class="z-Limg">
                    <a href="<?php echo WEB_PATH; ?>/cgoods/{{shop.id}}"><img src="<?php echo G_UPLOAD_PATH; ?>/{{shop.g_thumb}}"></a>
                </span>
                <div class="goodsListR">
                    <a href="<?php echo WEB_PATH; ?>/cgoods/{{shop.id}}"><h2 >{{shop.g_title}}</h2></a>
                    <div class="pRate">
                        <div class="Progress-bar">
                            <p class="u-progress">
                                <span class="pgbar" style="width:{{null | width:shop.canyurenshu,shop.zongrenshu}};">
                                    <span class="pging"></span>
                                </span>
                            </p>
                            <ul class="Pro-bar-li">
                                <li class="P-bar01">
                                    <em>{{shop.canyurenshu}}</em>已参与</li>
                                <li class="P-bar02">
                                    <em>{{shop.zongrenshu}}</em>总需人次</li>
                                <li class="P-bar03">
                                    <em>{{shop.shenyurenshu}}</em>剩余</li>

                            </ul>
                        </div>
                       <a class="add" onclick="gcartlist.gocartlist({{shop.id}},'<?php echo WEB_PATH; ?>','<?php echo GetConfig('cookie_pre'); ?>')" href="javascript:;"><s></s></a>
                    </div>
                </div>
            </li>
        </ul>
    {{/each}}
</script>


<script type="text/javascript">
    $(document).ready(function(){

        $("#LoadDataA a").click(function(){
            $data = $("#LoadDataA a");
            $data.data("page",($data.data("page")|0) + 1)
            $data.data("page",$data.data("page")==1 ?　2 : $data.data("page"))
            if($data.data("maxpage") === undefined){
                $data.hide().eq(1).show()
                $.get(APP.G_WEB_PATH + "/index/cloud_goods/search_goods"+"/p"+$data.data("page"),function($datas){
                        //$($datas).each(function(index) {  })
                        if($datas.cpgoodslist.length < 20 ){
                            $data.data("maxpage",$data.data("page"))
                        }
                        $("#goodsList").append(template('goodsListData', {list:$datas.cpgoodslist}))
                        $data.hide().eq(0).show()
                },"json")
            } else {
                $data.hide().eq(2).show()
            }
        });


        //商品分类
        var dl=$("#divGoodsNav dl"),
                last=$("#divGoodsNav li:last"),
                first=$("#divGoodsNav dd:first");
        $("#divGoodsNav li:last a:first").click(function(){
            if(dl.css("display")=='none'){
                dl.show();
                last.addClass("gSort");
                first.addClass("sOrange");
            }else{
                dl.hide();
                last.removeClass("gSort");
                first.removeClass("sOrange");
            }
        });

    });
</script>
<?php include self::includes("index.footer"); ?>