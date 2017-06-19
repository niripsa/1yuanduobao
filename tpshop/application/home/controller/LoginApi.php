<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * 微信交互类
 */
namespace app\home\controller;
use app\home\logic\UsersLogic;
use app\home\logic\CartLogic;
use think\Request;
class LoginApi extends Base {
    public $config;
    public $oauth;
    public $class_obj;

    public function __construct(){
        parent::__construct();
//        unset($_GET['oauth']);   // 删除掉 以免被进入签名
//        unset($_REQUEST['oauth']);// 删除掉 以免被进入签名
        
        $this->oauth = I('get.oauth');
        //获取配置
        $data = M('Plugin')->where("code",$this->oauth)->where("type","login")->find();
        $this->config = unserialize($data['config_value']); // 配置反序列化
        if(!$this->oauth)
            $this->error('非法操作',U('User/login'));
        include_once  "plugins/login/{$this->oauth}/{$this->oauth}.class.php";
        $class = '\\'.$this->oauth; //
        $this->class_obj = new $class($this->config); //实例化对应的登陆插件
    }

    public function login(){
        if(!$this->oauth)
            $this->error('非法操作',U('User/login'));
        include_once  "plugins/login/{$this->oauth}/{$this->oauth}.class.php";
        $this->class_obj->login();
    }
    
    public function callback(){
        $data = $this->class_obj->respon();
        $logic = new UsersLogic();
        if(session('?user')){
        	$res = $logic->oauth_bind($data);//已有账号绑定第三方账号
        	if($res['status'] == 1){
        		$this->success('绑定成功',U('User/index'));
        	}else{
        		$this->error('绑定失败',U('User/index'));
        	}
        }
        $data = $logic->thirdLogin($data);
        if($data['status'] != 1)
            $this->error($data['msg']);
        session('user',$data['result']);
        setcookie('user_id',$data['result']['user_id'],null,'/');
        setcookie('is_distribut',$data['result']['is_distribut'],null,'/');
        $nickname = empty($data['result']['nickname']) ? '第三方用户' : $data['result']['nickname'];
        setcookie('uname',urlencode($nickname),null,'/');
        setcookie('cn',0,time()-3600,'/');
        // 登录后将购物车的商品的 user_id 改为当前登录的id            
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($data['result']['user_id']);
        $cartLogic->doUserLoginHandle();// 用户登录后 需要对购物车 一些操作
//    	$cartLogic->login_cart_handle($this->session_id,$data['result']['user_id']);  //用户登录后 需要对购物车 一些操作
        if(isMobile())
            $this->success('登陆成功',U('Mobile/User/index'));
        else
            $this->success('登陆成功',U('User/index'));
    }
}