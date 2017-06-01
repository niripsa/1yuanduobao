<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!-- 底部 Start -->   
<div class="g-footer" style="margin-top:20px;">
    <div class="m-instruction">
        <div class="g-wrap f-clear">
            <div class="g-main">
                <ul class="m-instruction-list">
                <?php if(is_array(GetCate('1',5,4,1,"ASC"))) foreach(GetCate('1',5,4,1,"ASC") AS $row): ?>
                    <li class="m-instruction-list-item">
                        <h5><i class="ico ico-instruction ico-instruction-1"></i><?php echo $row['name']; ?></h5>
                        <ul class="list">
                        <?php if(is_array($row['sub_cate'])) foreach($row['sub_cate'] AS $r): ?>
                            <li><a href="<?php echo WEB_PATH; ?>/article-<?php echo $r['id']; ?>.html" target="_blank"><?php echo $r['title']; ?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="g-side">
                <div class="g-side-l">
                    <ul class="m-instruction-state f-clear">
                        <li><i class="ico ico-state-l ico-state-l-1"></i>100%公平公正公开</li>
                        <li><i class="ico ico-state-l ico-state-l-2"></i>100%正品保证</li>
                        <li><i class="ico ico-state-l ico-state-l-3"></i>100%权益保障</li>
                    </ul>
                </div>
                <div class="g-side-r">
         
                    <!--div class="m-instruction-service">
                        <p>周一至周五：9:00-18:00</p>
                        <p>意见反馈请 <a href="javascript:void(0);" class="btn-feedback" id="btnFooterFeedback">点击这里</a></p>
                    </div-->
                    <img width="117" src="<?php echo G_TEMPLATES_STYLE; ?>/images/two-dimension_code.jpg" />
                </div>
            </div>
        </div>
    </div>
    <div class="m-copyright">
        <div class="g-wrap">
            <div class="m-copyright-logo">            
                <a href="/" target="_blank"><img width="117" src="<?php echo G_TEMPLATES_STYLE; ?>/images/yy_logo.gif" /></a>
            </div>
            <div class="m-copyright-txt">
                <p>深圳市三人行广告传媒有限公司 版权所有</p>
                <p>备案号</p>
            </div>
        </div>
    </div>
</div>
<!-- 底部 End -->   
