<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo js("koala.min.1.5"); ?>            
<?php echo js("jquery.webox"); ?> 
<?php echo js("jquery.cartlist"); ?>  
<?php include self::includes("index.header"); ?>
<!--商品 wrap 开始-->
<div class="wrap w1200">
    <div class="Current_nav w1200"><a href="<?php echo WEB_PATH; ?>/cgoods_list/">首页</a> &gt;  <?php echo $daohang_title; ?></div>
    <div class="list_Curtit b_gray">
        <a  href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_0" ><h1 class="fl c_red"><?php echo $daohang_title; ?></h1></a>
        <span id="spTotalCount">(共<em class="c_red"><?php echo $total; ?></em>件相关商品)</span>
    </div>
    <div class="list_class b_gray">
        <dl>
            <dt>分类一</dt>
            <dd id="ddBrandList">
                <ul> 
                <?php if(isset($daohang['parentid'])): ?>             
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $daohang['parentid']; ?>_0_0" >全部</a></li>
                <?php  else: ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_0" class="ClassCur bg_red">全部</a></li>
                <?php endif; ?>
                <?php if(is_array(GetCate('0',50,5))) foreach(GetCate('0',50,5) AS $two_cate): ?>
                    <?php if($cid == $two_cate['cateid']||$two_cate['cateid'] == $daohang['parentid']): ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0"  class="ClassCur bg_red"><?php echo $two_cate['name']; ?></a></li>
                    <?php  else: ?>
                    <?php if($cateid): ?>
                    <?php if(is_array($cateid)) foreach($cateid AS $cate): ?>
                    <?php if($cate == $two_cate['cateid']||$two_cate['cateid'] == $daohang['parentid']): ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0"  class="ClassCur bg_red"><?php echo $two_cate['name']; ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0"><?php echo $two_cate['name']; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>               
                </ul>
            </dd>
        </dl>
    </div>
    <?php if($cid): ?>
    <?php if(!empty($one_cate_list)): ?>
    <div class="list_class b_gray">
        <dl>
            <dt>分类二</dt>
            <dd id="ddBrandList">
                <ul> 
                <?php if($one_cate_listtag=='N'): ?>              
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_0" class="ClassCur bg_red">全部</a></li>
                <?php  else: ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $daohang['parentid']; ?>_0_0" >全部</a></li>
                <?php endif; ?>     
                <?php if(is_array($one_cate_list)) foreach($one_cate_list AS $two_cate): ?>
                    <?php if($cid == $two_cate['cateid']): ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0" class="ClassCur bg_red"><?php echo $two_cate['name']; ?></a></li>
                    <?php  else: ?>
                    <?php if($cateid): ?>
                    <?php if(is_array($cateid)) foreach($cateid AS $cate): ?>
                    <?php if($cate == $two_cate['cateid']): ?>
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0"  class="ClassCur bg_red"><?php echo $two_cate['name']; ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>                 
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $two_cate['cateid']; ?>_0_0"><?php echo $two_cate['name']; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>               
                </ul>
            </dd>
        </dl>
    </div>  
    <?php endif; ?>
    <?php endif; ?>         
<?php if($brand): ?> 
    <div class="list_class b_gray">
        <dl>
            <dt>品牌</dt>
        <?php if(count($brand)>23): ?>
        <dd id="ddBrandList_brand" style="height:78px">
        <?php  else: ?>
        <dd id="ddBrandList_brand">
        <?php endif; ?>     
                <ul> 
                <?php if(!$bid): ?>               
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_<?php echo $sort; ?>" class="ClassCur bg_red">全部</a></li>
                 <?php  else: ?>  
                     <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_0_<?php echo $sort; ?>">全部</a></li>
                <?php endif; ?>             
                <?php if(is_array($brand)) foreach($brand AS $brands): ?>             
                <?php if($brands['id'] == $bid): ?>                    
                    <li><a  href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $brands['id']; ?>_<?php echo $sort; ?>" class="ClassCur bg_red"><?php echo $brands['name']; ?></a></li>
                <?php  else: ?>   
                    <li><a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $brands['id']; ?>_<?php echo $sort; ?>"><?php echo $brands['name']; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
                </ul>
            </dd>
        </dl>
    <?php if(count($brand)>23): ?>    
    <a class="list_classMore" href="javascript:;">展开<i></i></a>
    <?php endif; ?>         
    </div>
    <?php endif; ?> 
    <div class="list_Sort b_gray">
        <dl>
            <dt>排序</dt>
            <dd>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_1" <?php if($sort=='1'): ?> class="SortCur"<?php endif; ?>>即将揭晓</a>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_2" <?php if($sort=='2'): ?> class="SortCur"<?php endif; ?>>人气</a>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_3" <?php if($sort=='3'): ?> class="SortCur"<?php endif; ?>>剩余人次</a>
                <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_4" <?php if($sort=='4'): ?> class="SortCur"<?php endif; ?>>最新</a>
                <?php if($sort=='5'): ?>
                 <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_6" class="Price_Sort SortCur">价格<i></i></a>
                <?php  else: ?>
                    <?php if($sort=='6'): ?>  
                 <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_5" class="Price_Sort SortCur">价格<s></s></a>  
                 <?php  else: ?>
                  <a href="<?php echo WEB_PATH; ?>/cgoods_list/<?php echo $cid; ?>_<?php echo $bid; ?>_5" class="Price_Sort">价格</a>    
                    <?php endif; ?>
                <?php endif; ?>               
            </dd>
        </dl>
    </div>
    <?php if($cpgoodslist): ?>
    <!--夺宝商品列表--> 
    <div class="get_ready w1200">
        <ul>
        <?php if(is_array($cpgoodslist)) foreach($cpgoodslist AS $shop): ?>
            <li class="list-block">
                <div class="pic"><a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>"  target="_blank" title="<?php echo $shop['g_title']; ?> ">
                <img  alt="<?php echo $shop['g_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['g_thumb']; ?>"></a></div>
                <p class="name"><a  href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['g_title']; ?> "><?php echo $shop['g_title']; ?></a></p>
                <p class="money">价值：<span class="rmb"><?php echo $shop['g_money']; ?></span></p>
                <div class="w-progressBar" title="">
                    <p class="w-progressBar-wrap cglist_progressbar">
                        <span class="w-progressBar-bar" style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],275); ?>px;"></span>
                    </p>
                    <ul class="w-progressBar-txt f-clear">
                        <li class="w-progressBar-txt-l">
                            <p><b><?php echo $shop['canyurenshu']; ?></b></p>
                            <p>已参与人次</p>
                        </li>
                        <li class="w-progressBar-txt-r">
                            <p><b><?php echo $shop['shenyurenshu']; ?></b></p>
                            <p>剩余人次</p>
                        </li>
                    </ul>
                </div>
                <!--div class="Progress-bar" style="">
                    <p title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>">
                    <span style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],275); ?>px;"></span></p>
                    <ul class="Pro-bar-li">
                        <li class="P-bar01"><em class="c_red"><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
                        <li class="P-bar02"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
                        <li class="P-bar03"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
                    </ul>
                </div-->
                <div class="w-goods-ing">
                    <div class="shop_buttom bg_red b_red1" style="margin:0 10px;width:115px;height:30px;">
                        <a href="<?php echo WEB_PATH; ?>/cgoods/<?php echo $shop['id']; ?>" style="line-height:30px;font-size:14px;"  class="Det_Shopnow" onclick="jwebox.goshopnow(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>')"><?php echo L('cgoods.go'); ?></a>
                    </div>
                    <div class="shop_buttom1 bg_pink b_pink c_red" style="margin:0px 10px;width:115px;height:30px;">
                        <a  href="javascript:;" onclick="gcartlist.gocartlist(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>','<?php echo GetConfig('cookie_pre'); ?>')" class="c_red"  style="line-height:30px;font-size:14px;" id="car_<?php echo $shop['id']; ?>"><?php echo L('cgoods.cartlist'); ?></a>
                    </div>
                </div>
                <div class="fail" style="display:none">
                    <div class="main"></div>
                    <div class="arrow"><em>◆</em><s>◆</s></div>
                </div>
                <div class="success" style="display:none">
                    <div class="main"></div>
                    <div class="arrow"><em>◆</em><s>◆</s></div>
                </div>      
            </li>       
        <?php endforeach; ?>       
        </ul>
        <?php if($total>$num): ?>
        <div class="pagesx"><?php echo $page->show('two'); ?></div> 
        <?php endif; ?>         
        </div>
    <!--商品列表完-->
    <?php  else: ?>
    <!--未找到商品-->
    <div class="NoConMsg"><span>无相关商品记录哦~！</span></div>
    <!--未找到商品-->
    <?php endif; ?> 
</div>
<!--商品 wrap 结束-->
<script>
function showh(){
var height=$("#ddBrandList_brand").innerHeight();   
    if(height==78){
        $("#ddBrandList_brand").css("height","auto");
        $(".list_classMore").addClass("MoreClick");
        $(".list_classMore").html("收起<i></i>");
    }else{
        $("#ddBrandList_brand").css("height","78px");
        $(".list_classMore").removeClass("MoreClick");
        $(".list_classMore").html("展开<i></i>");
    };
}
$(function(){   
    $(".list_classMore").click(showh);
});
</script>
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>