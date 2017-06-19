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
 * Author: 当燃      
 * Date: 2015-09-09
 */
namespace app\admin\controller;

use think\Page;
use app\admin\logic\ArticleCatLogic;
use think\Db;

class Article extends Base {

    private $article_system_id = array(1, 2, 3, 4, 5);//系统默认的文章分类id，不可删除
    private $article_main_system_id = array(1, 2);//系统保留分类，不允许在该分类添加文章
    private $article_top_system_id = array(1);//系统分类，不允许在该分类添加新的分类
    private $article_able_id = array(1);//系统预定义文章id，不能删除。此文章用于商品详情售后服务

    public function _initialize()
    {
        parent::_initialize();
        $this->assign('article_top_system_id', $this->article_top_system_id);
        $this->assign('article_system_id', $this->article_system_id);
        $this->assign('article_main_system_id', $this->article_main_system_id);
        $this->assign('article_able_id',$this->article_able_id);
    }

    public function categoryList(){
        $ArticleCat = new ArticleCatLogic(); 
        $cat_list = $ArticleCat->article_cat_list(0, 0, false);
        $type_arr = array('系统默认','系统帮助','系统公告');
        $this->assign('type_arr',$type_arr);
        $this->assign('cat_list',$cat_list);
        return $this->fetch('categoryList');
    }

    public function category()
    {
        $ArticleCat = new ArticleCatLogic();
        $act = I('get.act', 'add');
        $cat_id = I('get.cat_id/d');
        $parent_id = I('get.parent_id/d');
        if ($cat_id) {
            $cat_info = D('article_cat')->where('cat_id=' . $cat_id)->find();
            $parent_id = $cat_info['parent_id'];
            $this->assign('cat_info', $cat_info);
        }
        $cats = $ArticleCat->article_cat_list(0, $parent_id, true);
        $this->assign('act', $act);
        $this->assign('cat_select', $cats);
        return $this->fetch();
    }
    
    public function articleList(){
        $Article =  M('Article'); 
        $list = array();
        $p = input('p/d', 1);
        $size = input('size/d', 20);
        $where = array();
        $keywords = trim(I('keywords'));
        $keywords && $where['title'] = array('like', '%' . $keywords . '%');
        $cat_id = I('cat_id/d',0);
        $cat_id && $where['cat_id'] = $cat_id;
        $res = $Article->where($where)->order('article_id desc')->page("$p,$size")->select();
        $count = $Article->where($where)->count();// 查询满足要求的总记录数
        $pager = new Page($count,$size);// 实例化分页类 传入总记录数和每页显示的记录数
        $page = $pager->show();//分页显示输出

        $ArticleCat = new ArticleCatLogic();
        $cats = $ArticleCat->article_cat_list(0,0,false);
        if($res){
        	foreach ($res as $val){
        		$val['category'] = $cats[$val['cat_id']]['cat_name'];
        		$val['add_time'] = date('Y-m-d H:i:s',$val['add_time']);        		
        		$list[] = $val;
        	}
        }
        $this->assign('cats',$cats);
        $this->assign('cat_id',$cat_id);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$page);// 赋值分页输出
        $this->assign('pager',$pager);
        return $this->fetch('articleList');
    }
    
    public function article(){
        $ArticleCat = new ArticleCatLogic();
 		$act = I('get.act','add');
        $info = array();
        $info['publish_time'] = time()+3600*24;
        $article_id = I('get.article_id/d');
        if($article_id){
           $info = D('article')->where('article_id', $article_id)->find();
        }
        $cats = $ArticleCat->article_cat_list(0,$info['cat_id']);    //第一个分类
        $cats2 = $ArticleCat->article_cat_list(0,$info['cat_id2']); //第二个分类
        
        $this->assign('cat_select',$cats);
        $this->assign('cat_select2',$cats2);
        
        $this->assign('act',$act);
        $this->assign('info',$info);
        $this->initEditor();
        return $this->fetch();
    }
    
     
    /**
     * 初始化编辑器链接
     * @param $post_id post_id
     */
    private function initEditor()
    {
        $this->assign("URL_upload", U('Admin/Ueditor/imageUp',array('savepath'=>'article')));
        $this->assign("URL_fileUp", U('Admin/Ueditor/fileUp',array('savepath'=>'article')));
        $this->assign("URL_scrawlUp", U('Admin/Ueditor/scrawlUp',array('savepath'=>'article')));
        $this->assign("URL_getRemoteImage", U('Admin/Ueditor/getRemoteImage',array('savepath'=>'article')));
        $this->assign("URL_imageManager", U('Admin/Ueditor/imageManager',array('savepath'=>'article')));
        $this->assign("URL_imageUp", U('Admin/Ueditor/imageUp',array('savepath'=>'article')));
        $this->assign("URL_getMovie", U('Admin/Ueditor/getMovie',array('savepath'=>'article')));
        $this->assign("URL_Home", "");
    }
    
    
    public function categoryHandle(){
    	$data = I('post.');   
        if($data['act'] == 'add'){           
            $d = D('article_cat')->add($data);
        }
        
        if($data['act'] == 'edit')
        {
        	if ($data['cat_id'] == $data['parent_id']) 
			{
        		$this->error("所选分类的上级分类不能是当前分类",U('Admin/Article/category',array('cat_id'=>$data['cat_id'])));
        	}
        	$ArticleCat = new ArticleCatLogic();
        	$children = array_keys($ArticleCat->article_cat_list($data['cat_id'], 0, false)); // 获得当前分类的所有下级分类
        	if (in_array($data['parent_id'], $children))
        	{
        		$this->error("所选分类的上级分类不能是当前分类的子分类",U('Admin/Article/category',array('cat_id'=>$data['cat_id'])));
        	}
        	$d = D('article_cat')->where("cat_id",$data['cat_id'])->save($data);
        }
        
        if($data['act'] == 'del'){
            if(array_key_exists($data['cat_id'],$this->article_system_id)){
                exit(json_encode('系统预定义的分类不能删除'));
            }
        	$res = D('article_cat')->where('parent_id', $data['cat_id'])->select();
        	if ($res)
        	{
        		exit(json_encode('还有子分类，不能删除'));
        	}
        	$res = D('article')->where('cat_id', $data['cat_id'])->select();
        	if ($res)
        	{
        		exit(json_encode('该分类下有文章，不允许删除，请先删除该分类下的文章.'));
        	}      	
        	$r = D('article_cat')->where('cat_id', $data['cat_id'])->delete();
        	if($r) exit(json_encode(1));
        }
        if($d){
        	$this->success("操作成功",U('Admin/Article/categoryList'));
        }else{
        	$this->error("操作失败",U('Admin/Article/categoryList'));
        }
    }
    
    public function aticleHandle(){
        $data = I('post.');
        $data['content'] = I('content'); // 文章内容单独过滤
        $data['publish_time'] = strtotime($data['publish_time']);
        $url = $this->request->server('HTTP_REFERER');
        $referurl = !empty($url) ? $url : U('Admin/Article/articleList');
        //$data['content'] = htmlspecialchars(stripslashes($_POST['content']));
        if($data['act'] == 'add'){
            if(array_key_exists($data['cat_id'],$this->article_main_system_id)){
                $this->error("不能在系统保留分类下添加文章,操作失败",$referurl);
            }
            $data['click'] = mt_rand(1000,1300);
        	$data['add_time'] = time(); 
            $r = D('article')->add($data);
        }
       
        if($data['act'] == 'edit'){
            $r = M('article')->where('article_id', $data['article_id'])->save($data);
        }
        
        if($data['act'] == 'del'){
            if(array_key_exists($data['article_id'],$this->article_able_id)){
                exit(json_encode('系统预定义的文章不能删除'));
            }
        	$r = D('article')->where('article_id', $data['article_id'])->delete();
        	if($r) exit(json_encode(1));       	
        }
        if($r){
            $this->success("操作成功",$referurl);
        }else{
            $this->error("操作失败",$referurl);
        }
    }
    
    
    public function link(){
    	$act = I('get.act','add');
    	$this->assign('act',$act);
    	$link_id = I('get.link_id/d');
    	$link_info = array();
    	if($link_id){
    		$link_info = D('friend_link')->where('link_id', $link_id)->find();
    	}
        $this->assign('info',$link_info);
    	return $this->fetch();
    }
    
    public function linkList(){
    	$Ad =  M('friend_link');
        $p = $this->request->param('p');
    	$res = $Ad->order('orderby')->page($p.',10')->select();
    	if($res){
    		foreach ($res as $val){
    			$val['target'] = $val['target']>0 ? '开启' : '关闭';
    			$list[] = $val;
    		}
    	}
    	$this->assign('list',$list);// 赋值数据集
    	$count = $Ad->count();// 查询满足要求的总记录数
    	$Page = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show = $Page->show();// 分页显示输出
        $this->assign('pager',$Page);// 赋值分页输出
    	$this->assign('page',$show);// 赋值分页输出
    	return $this->fetch();
    }
    
    public function linkHandle(){
        $data = I('post.');
    	if($data['act'] == 'add'){
    		stream_context_set_default(array('http'=>array('timeout' =>2)));
//            send_http_status('311');
    		$r = D('friend_link')->insert($data);
    	}
    	if($data['act'] == 'edit'){
    		$r = D('friend_link')->where('link_id', $data['link_id'])->save($data);
    	}
    	
    	if($data['act'] == 'del'){
    		$r = D('friend_link')->where('link_id', $data['link_id'])->delete();
    		if($r) exit(json_encode(1));
    	}
    	
    	if($r){
    		$this->success("操作成功",U('Admin/Article/linkList'));
    	}else{
    		$this->error("操作失败",U('Admin/Article/linkList'));
    	}
    }

}