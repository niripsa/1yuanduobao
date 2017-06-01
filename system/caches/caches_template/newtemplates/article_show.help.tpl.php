<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("user"); ?>
<?php include self::includes("index.header"); ?>
<div class="help-main">
    <div id="ltlContents" class="help-right-part">
        <div class="help-right-part">
            <div class="help-in-rihgt-part">
                <h2> <?php echo $article['title']; ?></h2>
                <div class="help-content">
                    <?php echo $article['content']; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="help-left-part">
        <div class="help-nav">
            <h3>帮助中心</h3>
            <?php if(is_array($data)) foreach($data AS $v): ?>
            <h4><?php echo $v['name']; ?></h4>
            <ul>
                <?php echo help($v['cateid'],$cateid); ?>
            </ul>
            <?php endforeach; ?>
        </div>
        <div class="help-contact">
            <p>如果不能在帮助内容中找到答案，或者您有其他建议、投诉，您还可以：</p>
            <ul>
                <li class="CustomerCon"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg('qq'); ?>&site=qq&menu=yes" target="_blank" class="Customer"><b></b>在线客服</a></li>
                <li>电话客服热线(免长途费)</li>
                <li class="tel"><span><?php echo _cfg("cell"); ?></span></li>
            </ul>
        </div>
    </div>
</div>
<?php include self::includes("index.footer"); ?>