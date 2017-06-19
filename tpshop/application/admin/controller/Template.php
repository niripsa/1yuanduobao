<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: IT宇宙人     
 * Date: 2015-09-09
 */
namespace app\admin\controller;
use think\AjaxPage;
use think\Page;

class Template extends Base {
    
    
    /**
     *  模板列表
     */
    public function templateList()
    {
        $t = I('t', 'pc'); // pc or  mobile
        $m = ($t == 'pc') ? 'home' : 'mobile';
        $arr = scandir("./template/$t/");
        foreach ($arr as $key => $val) {
			if ($val == '.' || $val == '..' || strstr($val,'svn')|| strstr($val,'DS_Store'))
                continue;
            $template_config[$val] = include "./template/$t/$val/config.php";
        }
        $this->assign('t', $t);
        // $default_theme =  tpCache("hidden.{$t}_default_theme"); // //$default_theme = M('Config')->where("name='{$t}_default_theme'")->getField('value');
        $template_arr = include(APP_PATH."/$m/html.php");
        $this->assign('default_theme', $template_arr['template']['default_theme']);
        $this->assign('template_config', $template_config);
        return $this->fetch();
    }


    /**
     * 魔板选择
     */
    public function changeTemplate(){        
        
        $t = I('t','pc'); // pc or  mobile        
        $m = ($t == 'pc') ? 'home' : 'mobile';
        $key = $this->request->param('key');
        //$default_theme = tpCache("hidden.{$t}_default_theme"); // 获取原来的配置                
        //tpCache("hidden.{$t}_default_theme",$_GET['key']);
        //tpCache('hidden',array("{$t}_default_theme"=>$_GET['key']));                         
        // 修改文件配置  
         if(!is_writeable(APP_PATH."$m/html.php"))
            return "文件/".APP_PATH."$m/html.php不可写,不能启用魔板,请修改权限!!!";
         
		$config_html ="<?php
return [
            'template'               => [
            // 模板引擎类型 支持 php think 支持扩展
            'type'         => 'Think',
            // 模板路径
            'view_path'    => './template/$t/$key/',
            // 模板后缀
            'view_suffix'  => 'html',
            // 模板文件名分隔符
            'view_depr'    => DS,
            // 模板引擎普通标签开始标记
            'tpl_begin'    => '{',
            // 模板引擎普通标签结束标记
            'tpl_end'      => '}',
            // 标签库标签开始标记
            'taglib_begin' => '<',
            // 标签库标签结束标记
            'taglib_end'   => '>',
            //模板文件名
            'default_theme'     => '$key',
        ],
        'view_replace_str'  =>  [
            '__PUBLIC__'=>'public',
            '__STATIC__' => '/template/$t/$key/static',
            '__ROOT__'=>''
        ]
    ];
?>";
         file_put_contents(APP_PATH."/$m/html.php", $config_html);
        delFile('./runtime');
        $this->success("操作成功!!!",U('admin/template/templateList',array('t'=>$t)));      
    }
}