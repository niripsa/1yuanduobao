<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php echo css("system404"); ?>
<?php echo seo("title",_cfg("web_name")."访问出错啦！"); ?>
<?php echo seo("keywords",_cfg("web_name")."访问出错啦！"); ?>
<?php echo seo("description",_cfg("web_name")."访问出错啦！"); ?>    
<?php include self::includes("index.header"); ?>
<div id="error_contents">
    <div class="errorbox">
        <div class="error_err"></div>
        <div class="pt_error">
            <a href="<?php echo G_WEB_PATH; ?>"> &lt;返回首页 </a>
            <a href="javascript:history.go(-1);" class="pt_back"> &lt;返回上一页 </a>
            <h3>抱歉，您请求的页面没有找到哦！</h3>
        </div>
        <ul>
            <li>可能已被删除、或者暂时不可用。</li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<?php include self::includes("index.footer"); ?>