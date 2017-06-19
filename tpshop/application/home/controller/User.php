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
 * 2015-11-21
 */
namespace app\home\controller; 
use app\home\logic\UsersLogic;
use app\home\logic\CartLogic;
use app\home\model\Message;
use think\Controller;
use think\Url;
use think\Page;
use think\Config;
use think\Verify;
use think\Db;
class User extends Base{

	public $user_id = 0;
	public $user = array();
	
    public function _initialize() {      
        parent::_initialize();
        $user_yydb_id = intval(cookie('duobao_uid'));
        if(empty($user_yydb_id)){
            header("Location:/index.php/?/member/user/login");
            exit;
        }

       	$user = session('user');
        $user = D('Yydb')->getUserInfo($user_yydb_id);
        session('user',$user);  //覆盖session 中的 user               
    	$this->user = $user;
    	$this->user_id = $user_yydb_id;
    	$this->assign('user',$user); //存储用户信息
    	$this->assign('user_id',$this->user_id);
        //获取用户信息的数量
        $user_message_count = D('Message')->getUserMessageCount();
        $this->assign('user_message_count', $user_message_count);       
    }

    /*
     * 用户中心首页
     */
    public function index(){
        $logic = new UsersLogic();
        $user = $logic->get_info($this->user_id);
        $user = $user['result'];
        $level = M('user_level')->select();
        $level = convert_arr_key($level,'level_id');
        $this->assign('level',$level);
        $this->assign('user',$user);
        return $this->fetch();
    }


    public function logout(){
    	setcookie('uname','',time()-3600,'/');
    	setcookie('cn','',time()-3600,'/');
    	setcookie('user_id','',time()-3600,'/');
        setcookie('PHPSESSID','',time()-3600,'/');
        session_unset();
        session_destroy();
        //$this->success("退出成功",U('Home/Index/index'));
        $this->redirect('Home/Index/index');
        exit;
    }

    /*
     * 账户资金
     */
    public function account(){
        $user = session('user');
        //获取账户资金记录
        $logic = new UsersLogic();
        $data = $logic->get_account_log($this->user_id,I('get.type'));
        $account_log = $data['result'];

        $this->assign('user',$user);
        $this->assign('account_log',$account_log);
        $this->assign('page',$data['show']);
        $this->assign('active','account');
        return $this->fetch();
    }
    /*
     * 优惠券列表
     */
    public function coupon(){
        $logic = new UsersLogic();
        $data = $logic->get_coupon($this->user_id,I('type'));
        $coupon_list = $data['result'];
        $this->assign('coupon_list',$coupon_list);
        $this->assign('page',$data['show']);
        $this->assign('active','coupon');
        return $this->fetch();
    }
    /**
     *  登录
     */
    public function login(){
        if($this->user_id > 0){
            $this->redirect('Home/User/index');
        }
        $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("Home/User/index");
        $this->assign('referurl',$referurl);
        return $this->fetch();
    }

    public function pop_login(){
    	if($this->user_id > 0){
            $this->redirect('Home/User/index');
    	}
        $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("Home/User/index");
        $this->assign('referurl',$referurl);
    	return $this->fetch();
    }
    
    public function do_login(){
        $username = trim(I('post.username'));
        $password = trim(I('post.password'));
    	$verify_code = I('post.verify_code');
     
        $verify = new Verify();
        if (!$verify->check($verify_code,'user_login'))
        {
             $res = array('status'=>0,'msg'=>'验证码错误');
             exit(json_encode($res));
        }
    	         
    	$logic = new UsersLogic();
    	$res = $logic->login($username,$password);

    	if($res['status'] == 1){
    		$res['url'] =  urldecode(I('post.referurl'));
    		session('user',$res['result']);
    		setcookie('user_id',$res['result']['user_id'],null,'/');
    		setcookie('is_distribut',$res['result']['is_distribut'],null,'/');
    		$nickname = empty($res['result']['nickname']) ? $username : $res['result']['nickname'];
            setcookie('uname',urlencode($nickname),null,'/');
            setcookie('cn',0,time()-3600,'/');
    		$cartLogic = new CartLogic();
            $cartLogic->setUserId($res['result']['user_id']);
            $cartLogic->doUserLoginHandle();// 用户登录后 需要对购物车 一些操作
//    		$cartLogic->login_cart_handle($this->session_id,$res['result']['user_id']);  //用户登录后 需要对购物车 一些操作
    	}
    	exit(json_encode($res));
    }
    /**
     *  注册
     */
    public function reg(){
    	if($this->user_id > 0){
            $this->redirect('Home/User/index');
        }
        $reg_sms_enable = tpCache('sms.regis_sms_enable');
        $reg_smtp_enable = tpCache('smtp.regis_smtp_enable');
        if(IS_POST){
            $logic = new UsersLogic();
            //验证码检验
//            $this->verifyHandle('user_reg');
            $username = I('post.username','');
            $password = I('post.password','');
            $password2 = I('post.password2','');
            $code = I('post.code','');
            $scene = I('post.scene', 1);
            $session_id = session_id();
            if(check_mobile($username)){
                if($reg_sms_enable){   //是否开启注册验证码机制
                    //手机功能没关闭
                    $check_code = $logic->check_validate_code($code, $username, 'phone', $session_id, $scene);
                    if($check_code['status'] != 1){
                        $this->error($check_code['msg']);
                    }
                }else{
                    $this->verifyHandle('user_reg');
                }
            }
            if(check_email($username)){
                if($reg_smtp_enable){        //是否开启注册邮箱验证码机制
                    //邮件功能未关闭
                    $check_code = $logic->check_validate_code($code, $username);
                    if($check_code['status'] != 1){
                        $this->error($check_code['msg']);
                    }
                }else{
                    $this->verifyHandle('user_reg');
                }
            }
            $data = $logic->reg($username,$password,$password2);
            if($data['status'] != 1){
                $this->error($data['msg']);
            }
            session('user',$data['result']);
    		setcookie('user_id',$data['result']['user_id'],null,'/');
    		setcookie('is_distribut',$data['result']['is_distribut'],null,'/');
            $nickname = empty($data['result']['nickname']) ? $username : $data['result']['nickname'];
            setcookie('uname',$nickname,null,'/');
            $cartLogic = new CartLogic();
            $cartLogic->setUserId($data['result']['user_id']);
            $cartLogic->doUserLoginHandle();// 用户登录后 需要对购物车 一些操作
//            $cartLogic->login_cart_handle($this->session_id,$data['result']['user_id']);  //用户登录后 需要对购物车 一些操作
            $this->success($data['msg'],U('Home/User/index'));
            exit;
        }
        $this->assign('regis_sms_enable',tpCache('sms.regis_sms_enable')); // 注册启用短信：
        $this->assign('regis_smtp_enable',tpCache('smtp.regis_smtp_enable')); // 注册启用邮箱：
        $sms_time_out = tpCache('sms.sms_time_out')>0 ? tpCache('sms.sms_time_out') : 120;
        $this->assign('sms_time_out', $sms_time_out); // 手机短信超时时间
        return $this->fetch();
    }

    /*
     * 订单列表
     */
    public function order_list(){
        $user_yydb_id = intval(cookie('duobao_uid'));
        if(empty($user_yydb_id)){
            header("Location:/index.php/?/member/user/login");
            exit;
        }
        $this->user_id = $user_yydb_id;
        $where = ' user_id=:user_id AND `pay_status` = 1';
        $bind['user_id'] = $this->user_id;
        //条件搜索
       if(I('get.type')){
           $where .= C(strtoupper(I('get.type')));
       }
       // 搜索订单 根据商品名称 或者 订单编号
       $search_key = trim(I('search_key'));       
       if($search_key)
       {
          $where .= " and (order_sn like :search_key1 or order_id in (select order_id from `".C('database.prefix')."order_goods` where goods_name like :search_key2) )";
           $bind['search_key1'] = "%$search_key%";
           $bind['search_key2'] = "%$search_key%";
       }
       
        $count = M('order')->where($where)->bind($bind)->count();
        $Page = new Page($count,10);

        $show = $Page->show();
        $order_str = "order_id DESC";
        $order_list = M('order')->order($order_str)->where($where)->bind($bind)->limit($Page->firstRow.','.$Page->listRows)->select();

        //获取订单商品
        $model = new UsersLogic();
        foreach($order_list as $k=>$v)
        {
            $order_list[$k] = set_btn_order_status($v);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
            //$order_list[$k]['total_fee'] = $v['goods_amount'] + $v['shipping_fee'] - $v['integral_money'] -$v['bonus'] - $v['discount']; //订单总额
            $data = $model->get_order_goods($v['order_id']);
            $order_list[$k]['goods_list'] = $data['result'];
            if($order_list[$k]['order_prom_type'] == 4){
                $pre_sell_item =  M('goods_activity')->where(array('act_id'=>$order_list[$k]['order_prom_id']))->find();
                $pre_sell_item = array_merge($pre_sell_item,unserialize($pre_sell_item['ext_info']));
                $order_list[$k]['pre_sell_is_finished'] = $pre_sell_item['is_finished'];
                $order_list[$k]['pre_sell_retainage_start'] = $pre_sell_item['retainage_start'];
                $order_list[$k]['pre_sell_retainage_end'] = $pre_sell_item['retainage_end'];
            }else{
                $order_list[$k]['pre_sell_is_finished'] = -1;//没有参与预售的订单
            }
        }
        $this->assign('order_status',C('ORDER_STATUS'));
        $this->assign('shipping_status',C('SHIPPING_STATUS'));
        $this->assign('pay_status',C('PAY_STATUS'));
        $this->assign('page',$show);
        $this->assign('lists',$order_list);
        $this->assign('active','order_list');
        $this->assign('active_status',I('get.type'));
        $this->assign('not_display', 1);
        $this->assign('cate_info', D('Yydb')->getCateInfo());
        $this->assign('user_is_login', D('Yydb')->getUserInfo($user_yydb_id));
        return $this->fetch();
    }

    /*
     * 订单详情
     */
    public function order_detail(){
        $user_yydb_id = intval(cookie('duobao_uid'));
        if(empty($user_yydb_id)){
            header("Location:/index.php/?/member/user/login");
            exit;
        }
        $this->user_id = $user_yydb_id;

        $id = I('get.id/d');
        $map['order_id'] = $id;
        $map['user_id'] = $this->user_id;
        $order_info = M('order')->where($map)->find();
        $order_info = set_btn_order_status($order_info);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
        if(!$order_info){
            $this->error('没有获取到订单信息');
            exit;
        }
        //获取订单商品
        $model = new UsersLogic();
        $data = $model->get_order_goods($order_info['order_id']);
        $order_info['goods_list'] = $data['result'];
        if($order_info['order_prom_type'] == 4){
            $pre_sell_item =  M('goods_activity')->where(array('act_id'=>$order_info['order_prom_id']))->find();
            $pre_sell_item = array_merge($pre_sell_item,unserialize($pre_sell_item['ext_info']));
            $order_info['pre_sell_is_finished'] = $pre_sell_item['is_finished'];
            $order_info['pre_sell_retainage_start'] = $pre_sell_item['retainage_start'];
            $order_info['pre_sell_retainage_end'] = $pre_sell_item['retainage_end'];
            $order_info['pre_sell_deliver_goods'] = $pre_sell_item['deliver_goods'];
        }else{
            $order_info['pre_sell_is_finished'] = -1;//没有参与预售的订单
        }
        //获取订单进度条
        $sql = "SELECT action_id,log_time,status_desc,order_status FROM ((SELECT * FROM __PREFIX__order_action WHERE order_id = :id AND status_desc <>'' ORDER BY action_id) AS a) GROUP BY status_desc ORDER BY action_id";
        $bind['id'] = $id;
        $items = DB::query($sql,$bind);
        $items_count = count($items);

        $ids = $order_info['province'].','.$order_info['city'].','.$order_info['district'];
        $region_list = M('region')->where("id in (".$ids.")")->getField("id,name");
        $invoice_no = M('DeliveryDoc')->where("order_id", $id)->getField('invoice_no',true);
        $order_info['invoice_no'] = implode(' , ', $invoice_no);
        //获取订单操作记录
        $order_action = M('order_action')->where(array('order_id'=>$id))->select();
        $this->assign('order_status',C('ORDER_STATUS'));
        $this->assign('shipping_status',C('SHIPPING_STATUS'));
        $this->assign('pay_status',C('PAY_STATUS'));
        $this->assign('region_list',$region_list);
        $this->assign('order_info',$order_info);
        $this->assign('order_action',$order_action);
        $this->assign('active','order_list');
        $this->assign('cate_info', D('Yydb')->getCateInfo());
        $this->assign('user_is_login', D('Yydb')->getUserInfo($user_yydb_id));
        $this->assign('not_display', 1);
        return $this->fetch();
    }

    /*
     * 取消订单
     */
    public function cancel_order(){
        $id = I('get.id/d');
        //检查是否有积分，余额支付
        $logic = new UsersLogic();
        $data = $logic->cancel_order($this->user_id,$id);
        if($data['status'] < 0)
            $this->error($data['msg']);
        $this->success($data['msg']);
    }

    /*
     * 用户地址列表
     */
    public function address_list(){
        $address_lists = get_user_address_list($this->user_id);
        $region_list = get_region_list();
        $this->assign('region_list',$region_list);
        $this->assign('lists',$address_lists);
        $this->assign('active','address_list');

        return $this->fetch();
    }
    /*
     * 添加地址
     */
    public function add_address(){
        header("Content-type:text/html;charset=utf-8");
        $user_yydb_id = intval(cookie('duobao_uid'));

        if(empty($user_yydb_id)){
            header("Location:/index.php/?/member/user/login");
            exit;
        }
        $this->user_id = $user_yydb_id;
        
        if(IS_POST){
            $logic = new UsersLogic();
            $data = $logic->add_address($this->user_id,0,I('post.'));
            if($data['status'] != 1)
                exit('<script>alert("'.$data['msg'].'");history.go(-1);</script>');
            $call_back = $_REQUEST['call_back'];
            echo "<script>parent.{$call_back}('success');</script>";
            exit(); // 成功 回调closeWindow方法 并返回新增的id
        }
        $p = M('region')->where(array('parent_id'=>0,'level'=> 1))->select();
        $this->assign('province',$p);
        return $this->fetch('edit_address');

    }

    /*
     * 地址编辑
     */
    public function edit_address(){
        header("Content-type:text/html;charset=utf-8");
        $user_yydb_id = intval(cookie('duobao_uid'));
        if(empty($user_yydb_id)){
            header("Location:/index.php/?/member/user/login");
            exit;
        }
        $this->user_id = $user_yydb_id;
        $id = I('get.id/d');
        $address = M('user_address')->where(array('address_id'=>$id,'user_id'=> $this->user_id))->find();
        if(IS_POST){
            $logic = new UsersLogic();
            $data = $logic->add_address($this->user_id,$id,I('post.'));
            if($data['status'] != 1)
                exit('<script>alert("'.$data['msg'].'");history.go(-1);</script>');

            $call_back = $_REQUEST['call_back'];
            echo "<script>parent.{$call_back}('success');</script>";
            exit(); // 成功 回调closeWindow方法 并返回新增的id
        }
        //获取省份
        $p = M('region')->where(array('parent_id'=>0,'level'=> 1))->select();
        $c = M('region')->where(array('parent_id'=>$address['province'],'level'=> 2))->select();
        $d = M('region')->where(array('parent_id'=>$address['city'],'level'=> 3))->select();
        if($address['twon']){
        	$e = M('region')->where(array('parent_id'=>$address['district'],'level'=>4))->select();
        	$this->assign('twon',$e);
        }


        $this->assign('province',$p);
        $this->assign('city',$c);
        $this->assign('district',$d);
        $this->assign('address',$address);
        return $this->fetch();
    }

    /*
     * 设置默认收货地址
     */
    public function set_default(){
        $id = I('get.id/d');
        M('user_address')->where(array('user_id'=>$this->user_id))->save(array('is_default'=>0));
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->save(array('is_default'=>1));
        if(!$row)
            $this->error('操作失败');
        $this->success("操作成功");
    }
    
    /*
     * 地址删除
     */
    public function del_address(){
        $id = I('get.id/d');
        
        $address = M('user_address')->where("address_id", $id)->find();
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->delete();                
        // 如果删除的是默认收货地址 则要把第一个地址设置为默认收货地址
        if($address['is_default'] == 1)
        {
            $address2 = M('user_address')->where("user_id", $this->user_id)->find();
            $address2 && M('user_address')->where("address_id", $address2['address_id'])->save(array('is_default'=>1));
        }        
        if(!$row)
            $this->error('操作失败',U('User/address_list'));
        else
            $this->success("操作成功",U('User/address_list'));
    }


    public function save_pickup()
    {
        $post = I('post.');
        if (empty($post['consignee'])) {
            return array('status' => -1, 'msg' => '收货人不能为空', 'result' => '');
        }
        if (!$post['province'] || !$post['city'] || !$post['district']) {
            return array('status' => -1, 'msg' => '所在地区不能为空', 'result' => '');
        }
        if(!check_mobile($post['mobile'])){
            return array('status'=>-1,'msg'=>'手机号码格式有误','result'=>'');
        }
        if(!$post['pickup_id']){
            return array('status'=>-1,'msg'=>'请选择自提点','result'=>'');
        }

        $user_logic = new UsersLogic();
        $res = $user_logic->add_pick_up($this->user_id, $post);
        if($res['status'] != 1){
            exit('<script>alert("'.$res['msg'].'");history.go(-1);</script>');
        }
        $call_back = $_REQUEST['call_back'];
        echo "<script>parent.{$call_back}({$post['province']},{$post['city']},{$post['district']});</script>";
        exit(); // 成功 回调closeWindow方法 并返回新增的id
    }
        
    /*
     * 评论晒单
     */
    public function comment(){
        $user_id = $this->user_id;
        $status = I('get.status',-1);
        $logic = new UsersLogic();
        $data = $logic->get_comment($user_id,$status); //获取评论列表
        $this->assign('page',$data['show']);// 赋值分页输出
        $this->assign('comment_list',$data['result']);
        $this->assign('active','comment');
        return $this->fetch();
    }

    /**
     * @time 2017/2/9
     * @author lxl
     * 订单商品评价列表
     */
    public function comment_list()
    {
        $order_id = I('order_id/d');
        $good_id = I('goods_id/d');
        if (empty($order_id) || empty($good_id)) {
            $this->error("参数错误");
        } else {
            //查找订单
            $order_comment_where['order_id'] = $order_id;
            $order_info = M('order')->field('order_sn,order_id,add_time') ->where($order_comment_where)->find();
            //查找评价商品
            $order_comment_where['goods_id'] = $good_id;
            $order_goods = M('order_goods')
                ->field('goods_id,is_comment,goods_name,goods_num,goods_price,spec_key_name')
                ->where($order_comment_where)
                ->find();
            $order_info = array_merge($order_info,$order_goods);
            $this->assign('order_info', $order_info);
            return $this->fetch();
        }
    }

    /*
     *添加评论
     */
    public function add_comment()
    {          
            $user_info = session('user');
            $comment_img = serialize(I('comment_img/a')); // 上传的图片文件
            $add['goods_id'] = I('goods_id/d');
            $add['email'] = $user_info['email'];
            $hide_username = I('hide_username');
            if (empty($hide_username)) {
                $add['username'] = $user_info['nickname'];
            }
            $add['is_anonymous'] = $hide_username;  //是否匿名评价:0不是\1是
            $add['order_id'] = I('order_id/d');
            $add['service_rank'] = I('service_rank');
            $add['deliver_rank'] = I('deliver_rank');
            $add['goods_rank'] = I('goods_rank');
            //$add['content'] = htmlspecialchars(I('post.content'));
            $add['content'] = I('content');
            $add['img'] = $comment_img;
            $add['add_time'] = time();
            $add['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $add['user_id'] = $this->user_id;
            $logic = new UsersLogic();
            //添加评论
            $row = $logic->add_comment($add);
            exit(json_encode($row));
    }

    /*
     * 个人信息
     */
    public function info(){
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        if(IS_POST){
            I('post.nickname') ? $post['nickname'] = I('post.nickname') : false; //昵称
            I('post.qq') ? $post['qq'] = I('post.qq') : false;  //QQ号码
            I('post.head_pic') ? $post['head_pic'] = I('post.head_pic') : false; //头像地址
            I('post.sex') ? $post['sex'] = I('post.sex') : $post['sex'] = 0;  // 性别
            I('post.birthday') ? $post['birthday'] = strtotime(I('post.birthday')) : false;  // 生日
            I('post.province') ? $post['province'] = I('post.province') : false;  //省份
            I('post.city') ? $post['city'] = I('post.city') : false;  // 城市
            I('post.district') ? $post['district'] = I('post.district') : false;  //地区
            if(!$userLogic->update_info($this->user_id,$post))
                $this->error("保存失败");
            setcookie('uname',urlencode($post['nickname']),null,'/');
            $this->success("操作成功");
            exit;
        }
        //  获取省份
        $province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
        //  获取订单城市
        $city =  M('region')->where(array('parent_id'=>$user_info['province'],'level'=>2))->select();
        //获取订单地区
        $area =  M('region')->where(array('parent_id'=>$user_info['city'],'level'=>3))->select();

        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
        $this->assign('user',$user_info);
        $this->assign('sex',C('SEX'));
        $this->assign('active','info');
        return $this->fetch();
    }

    /*
     * 邮箱验证
     */
    public function email_validate(){
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        $step = I('get.step',1);
        if(IS_POST){
            $email = I('post.email');
            $old_email = I('post.old_email',''); //旧邮箱
            $code = I('post.code');
            $info = session('validate_code');
            if(!$info)
                $this->error('非法操作');
            if($info['time']<time()){
            	session('validate_code',null);
            	$this->error('验证超时，请重新验证');
            }
            //检查原邮箱是否正确
            if($user_info['email_validated'] == 1 && $old_email != $user_info['email'])
                $this->error('原邮箱匹配错误');
            //验证邮箱和验证码
            if($info['sender'] == $email && $info['code'] == $code){
                session('validate_code',null);
                if(!$userLogic->update_email_mobile($email,$this->user_id))
                    $this->error('邮箱已存在');
                $this->success('绑定成功',U('Home/User/index'));
                exit;
            }
            $this->error('邮箱验证码不匹配');
        }
        $this->assign('user_info',$user_info);
        $this->assign('step',$step);
        return $this->fetch();
    }


    /*
    * 手机验证
    */
    public function mobile_validate()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); //获取用户信息
        $user_info = $user_info['result'];
        $config = tpCache('sms');
        $sms_time_out = $config['sms_time_out'];
        $step = I('get.step', 1);
        if (IS_POST) {
            $mobile = I('post.mobile');
            $old_mobile = I('post.old_mobile');
            $code = I('post.code');
            $scene = I('post.scene', 6);
            $session_id = I('unique_id', session_id());

            $logic = new UsersLogic();
            $res = $logic->check_validate_code($code, $mobile, 'phone', $session_id, $scene);

            if (!$res && $res['status'] != 1) $this->error($res['msg']);

            //检查原手机是否正确
            if ($user_info['mobile_validated'] == 1 && $old_mobile != $user_info['mobile'])
                $this->error('原手机号码错误');
            //验证手机和验证码

            if ($res['status'] == 1) {
                //验证有效期
                if (!$userLogic->update_email_mobile($mobile, $this->user_id, 2))
                    $this->error('手机已存在');
                $this->success('绑定成功', U('Home/User/index'));
                exit;
            } else {
                $this->error($res['msg']);
            }

        }
        $this->assign('time', $sms_time_out);
        $this->assign('step', $step);
        $this->assign('user_info', $user_info);
        return $this->fetch();
    }
    
    /**
     * 发送手机注册验证码
     */
    public function send_sms_reg_code(){
         
        $mobile = I('mobile');
        $userLogic = new UsersLogic();
        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误')));
        $code =  rand(1000,9999);
        $send = $userLogic->sms_log($mobile,$code,$this->session_id);
        if($send['status'] != 1)
            exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
        exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }
    /*
     *商品收藏
     */
    public function goods_collect(){
        $userLogic = new UsersLogic();
        $data = $userLogic->get_goods_collect($this->user_id);
        $this->assign('page',$data['show']);// 赋值分页输出
        $this->assign('lists',$data['result']);
        $this->assign('active','goods_collect');
        return $this->fetch();
    }

    /*
     * 删除一个收藏商品
     */
    public function del_goods_collect(){
        $id = I('get.id/d');
        if(!$id)
            $this->error("缺少ID参数");
        $row = M('goods_collect')->where(array('collect_id'=>$id,'user_id'=>$this->user_id))->delete();
        if(!$row)
            $this->error("删除失败");
        $this->success('删除成功');
    }

    /*
     * 密码修改
     */
    public function password(){
        //检查是否第三方登录用户
        $logic = new UsersLogic();
        $data = $logic->get_info($this->user_id);
        $user = $data['result'];
        if($user['mobile'] == ''&& $user['email'] == '')
            $this->error('请先绑定手机或邮箱',U('Home/User/info'));
        if(IS_POST){
            $userLogic = new UsersLogic();
            $data = $userLogic->password($this->user_id,I('post.old_password'),I('post.new_password'),I('post.confirm_password')); // 获取用户信息
            if($data['status'] == -1)
                $this->error($data['msg']);
            $this->success($data['msg']);
            exit;
        }
        return $this->fetch();
    }

    public function forget_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('Home/User/Index'));
        }
        if (IS_POST) {
            $username = I('username');
            if (!empty($username)) {
                $field = 'mobile';
                if (check_email($username)) {
                    $field = 'email';
                }
                $user = M('users')->where("email", $username)->whereOr('mobile', $username)->find();
                
                if ($user) {
                    session('find_password', array('user_id' => $user['user_id'], 'username' => $username,
                        'email' => $user['email'], 'mobile' => $user['mobile'], 'type' => $field));
                    header("Location: " . U('User/identity'));
                    exit;
                } else {
                   echo "用户名不存在，请检查";
                    $this->error("用户名不存在，请检查");
                }
            }
        }
        return $this->fetch();
    }
    
    public function set_pwd(){
    	if($this->user_id > 0){
            $this->redirect('Home/User/Index');
    	}
    	$check = session('validate_code');
    	$logic = new UsersLogic();
    	if(empty($check)){
            $this->redirect('Home/User/forget_pwd');
    	}elseif($check['is_check']==0){
    		$this->error('验证码还未验证通过',U('Home/User/forget_pwd'));
    	}    	
    	if(IS_POST){
    		$password = I('post.password');
    		$password2 = I('post.password2');
    		if($password2 != $password){
    			$this->error('两次密码不一致',U('Home/User/forget_pwd'));
    		}
    		if($check['is_check']==1){
    			//$user = get_user_info($check['sender'],1);
                $user = M('users')->where("mobile|email", '=', $check['sender'])->find();
    			M('users')->where("user_id", $user['user_id'])->save(array('password'=>encrypt($password)));
    			session('validate_code',null);
                $this->redirect('Home/User/finished');
    		}else{
    			$this->error('验证码还未验证通过',U('Home/User/forget_pwd'));
    		}
    	}
    	return $this->fetch();
    }
    
    public function finished(){
    	if($this->user_id > 0){
            $this->redirect('Home/User/Index');
    	}
    	return $this->fetch();
    }   
    
    public function check_captcha(){
    	$verify = new Verify();
    	$type = I('post.type','user_login');
    	if (!$verify->check(I('post.verify_code'), $type)) {
    		exit(json_encode(0));
    	}else{
    		exit(json_encode(1));
    	}
    }
    
    public function check_username(){
    	$username = I('post.username');
    	if(!empty($username)){
    		$count = M('users')->where("email", $username)->whereOr('mobile', $username)->count();
    		exit(json_encode(intval($count)));
    	}else{
    		exit(json_encode(0));
    	}  	
    }

    public function identity()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('Home/User/Index'));
        }
        $user = session('find_password');
        if (empty($user)) {
            $this->error("请先验证用户名", U('User/forget_pwd'));
        }
        $this->assign('userinfo', $user);
        return $this->fetch();
    }
      
    /**
     * 验证码验证
     * $id 验证码标示
     */
    private function verifyHandle($id)
    {
        $verify = new Verify();
        $result = $verify->check(I('post.verify_code'), $id ? $id : 'user_login');
        if (!$result) {
            $this->error("图像验证码错误");
        }
    }

    /**
     * 验证码获取
     */
    public function verify()
    {
        //验证码类型
        $type = I('get.type') ? I('get.type') : 'user_login';
        $config = array(
            'fontSize' => 40,
            'length' => 4,
            'useCurve' => true,
            'useNoise' => false,
        );
        $Verify = new Verify($config);
        $Verify->entry($type);
		exit();
    }

    /**
     * 订单确认收货
     */
    public function order_confirm(){
        $id = I('get.id/d',0);
        $data = confirm_order($id,$this->user_id);
        if($data['status'] != 1){
            $this->error($data['msg'] ,U('User/order_list'));
        } else	{
            $this->success($data['msg'],U('User/order_detail',['id'=>$id]));
        }
    }
    /**
     * 申请退货
     */
    public function return_goods()
    {
        $order_id = I('order_id/d',0);
        $order_sn = I('order_sn',0);
        $goods_id = I('goods_id/d',0);
	    $spec_key = I('spec_key');
        
        $order=M('order')->where(["order_id"=>$order_id,'user_id'=>$this->user_id])->find();  //检查是否有这个订单
        if(empty($order))
        {
            $this->error('非法操作');
            exit;
        }
        $order_goods_where = ['order_id'=>$order_id,'goods_id'=>$goods_id,'spec_key'=>$spec_key];
        $return_goods = M('return_goods')->where($order_goods_where)->find();
        if(!empty($return_goods))
        {
            $this->success('已经提交过退货申请!',U('Home/User/return_goods_info',array('id'=>$return_goods['id'])));
            exit;
        }       
        if(IS_POST)
        {
            $data['order_id'] = $order_id; 
            $data['order_sn'] = $order_sn; 
            $data['goods_id'] = $goods_id; 
            $data['addtime'] = time(); 
            $data['user_id'] = $this->user_id;            
            $data['type'] = I('type'); // 服务类型  退货 或者 换货
            $data['reason'] = I('reason'); // 问题描述
            $data['imgs'] = I('imgs'); // 用户拍照的相片
            $data['spec_key'] = I('spec_key'); // 商品规格			
            M('return_goods')->add($data);            
            $this->success('申请成功,客服第一时间会帮你处理',U('Home/User/order_list'));
            exit;
        }
        $region_id[] = tpCache('shop_info.province');        
        $region_id[] = tpCache('shop_info.city');        
        $region_id[] = tpCache('shop_info.district');
        $region_id[] = 0;        
        $return_address = M('region')->where("id in (".implode(',', $region_id).")")->getField('id,name');
        $order_goods = M('order_goods')->where($order_goods_where)->find();  //找到这个订单商品
        $order_info = array_merge($order,$order_goods);  //合并数组
        $this->assign('return_address', $return_address);
        $this->assign('goods',$order_info);
        $this->assign('order_id',$order_id);
        $this->assign('order_sn',$order_sn);
        $this->assign('goods_id',$goods_id);

        return $this->fetch();
    }
    
    /**
     * 退换货列表
     */
    public function return_goods_list()
    {
        $where = " user_id=$this->user_id ";
        // 搜索订单 根据商品名称 或者 订单编号
        $search_key = trim(I('search_key'));
        if($search_key)
        {
            $where .= " and order_sn=$search_key";
        }
        $count = M('return_goods')->where($where)->count();
        $page = new Page($count,10);
        $list = M('return_goods')->where($where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if(!empty($goods_id_arr))
            $goodsList = M('goods')->where("goods_id","in", implode(',',$goods_id_arr))->getField('goods_id,goods_name');
        $state = C('REFUND_STATUS');
        $this->assign('state',$state);
        $this->assign('goodsList', $goodsList);
        $this->assign('list', $list);
        $this->assign('page', $page->show());// 赋值分页输出
        return $this->fetch();
    }
    
    /**
     *  退货详情
     */
    public function return_goods_info()
    {
        $id = I('id/d',0);
        $return_goods = M('return_goods')->where("id", $id)->find();
        $return_goods['seller_delivery'] = unserialize($return_goods['seller_delivery']);  //订单的物流信息，服务类型为换货会显示
        if($return_goods['imgs'])
            $return_goods['imgs'] = explode(',', $return_goods['imgs']);        
        $goods = M('goods')->where("goods_id", $return_goods['goods_id'])->find();
        $state = C('REFUND_STATUS');
        $this->assign('state',$state);
        $this->assign('goods',$goods);
        $this->assign('return_goods',$return_goods);
        return $this->fetch();
    }
    
    /**
     * 安全设置
     */
    public function safety_settings()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];        
        $this->assign('user',$user_info);
        return $this->fetch();
    }
    
    /**
     * 申请提现记录
     */
    public function withdrawals(){
        
    	//C('TOKEN_ON',true);
    	if(IS_POST)
    	{
            $this->verifyHandle('withdrawals');                
    		$data = I('post.');
    		$data['user_id'] = $this->user_id;    		    		
    		$data['create_time'] = time();                
                $distribut_min = tpCache('basic.min'); // 最少提现额度
                if($data['money'] < $distribut_min)
                {
                        $this->error('每次最少提现额度'.$distribut_min);
                        exit;
                }
                if($data['money'] > $this->user['user_money'])
                {
                        $this->error("你最多可提现{$this->user['user_money']}账户余额.");
                        exit;
                }
            if(encrypt($data['paypwd']) != $this->user['paypwd']){
                $this->error("支付密码错误");
            }

    		if(M('withdrawals')->add($data)){
    			$this->success("已提交申请");
                        exit;
    		}else{
    			$this->error('提交失败,联系客服!');
                        exit;
    		}
    	}

        $Userlogic = new UsersLogic();
        $result= $Userlogic->get_withdrawals_log($this->user_id);  //用户资金变动记录
        $this->assign('show',$result['show']);// 赋值分页输出
        $this->assign('list',$result['result']); // 下线
        return $this->fetch();
    }
    
   public  function recharge(){
   		if(IS_POST){
   			$user = session('user');
   			$data['user_id'] = $this->user_id;
   			$data['nickname'] = $user['nickname'];
   			$data['account'] = I('account');
   			$data['order_sn'] = 'recharge'.get_rand_str(10,0,1);
   			$data['ctime'] = time();
   			$order_id = M('recharge')->add($data);
   			if($order_id){
   				$url = U('Payment/getPay',array('pay_radio'=>$_REQUEST['pay_radio'],'order_id'=>$order_id));
                $this->redirect($url);
   			}else{
   				$this->error('提交失败,参数有误!');
   			}
   		}
   		
	   	$paymentList = M('Plugin')->where("`type`='payment' and code!='cod' and status = 1 and  scene in(0,2)")->select();
	   	$paymentList = convert_arr_key($paymentList, 'code');	   	
	   	foreach($paymentList as $key => $val)
	   	{
	   		$val['config_value'] = unserialize($val['config_value']);
	   		if($val['config_value']['is_bank'] == 2)
	   		{
	   			$bankCodeList[$val['code']] = unserialize($val['bank_code']);
	   		}
	   	}
	   	$bank_img = include APP_PATH.'home/bank.php'; // 银行对应图片
	   	$this->assign('paymentList',$paymentList);
	   	$this->assign('bank_img',$bank_img);
	   	$this->assign('bankCodeList',$bankCodeList);

       $type = I('type');
       $Userlogic = new UsersLogic();
       if($type == 1){
           $result=$Userlogic->get_account_log($this->user_id);  //用户资金变动记录
       }else if($type == 2){
           $result=$Userlogic->get_withdrawals_log($this->user_id);  //提现记录
       }else{
           $result=$Userlogic->get_recharge_log($this->user_id);  //充值记录
       }
        $this->assign('page', $result['show']);
        $this->assign('lists', $result['result']);
   		return $this->fetch();
   } 

    /**
     *  用户消息通知
     * @author dyr
     * @time 2016/09/01
     */
    public function message_notice()
    {
        return $this->fetch('user/message_notice');
    }
    /**
     * ajax用户消息通知请求
     * @author dyr
     * @time 2016/09/01
     */
    public function ajax_message_notice()
    {
        $type = I('type',0);
        $user_logic = new UsersLogic();
        $message_model = new Message();
        if ($type == 1) {
            //系统消息
            $user_sys_message = $message_model->getUserMessageNotice();
            $user_logic->setSysMessageForRead();
        } else if ($type == 2) {
            //活动消息：后续开发
            $user_sys_message = array();
        } else {
            //全部消息：后续完善
            $user_sys_message = $message_model->getUserMessageNotice();
        }
        $this->assign('messages', $user_sys_message);
        return $this->fetch('user/ajax_message_notice');
    }

/**/
    public function paypwd()
    {
        //检查是否第三方登录用户
        $logic = new UsersLogic();
        $data = $logic->get_info($this->user_id);
        $user = $data['result'];
        if ($user['mobile'] == '' && $user['email'] == '')
            $this->error('请先绑定手机或邮箱', U('Home/User/info'));
        $step = I('step', 1);
        if ($step > 1) {
            $check = session('validate_code');
            if (empty($check)) {
                $this->error('验证码还未验证通过', U('Home/User/paypwd'));
            }
        }
        if (IS_POST && $step == 3) {
            $userLogic = new UsersLogic();
            $data = I('post.');
            $data = $userLogic->paypwd($this->user_id, I('new_password'), I('confirm_password'));
            if ($data['status'] == -1)
                $this->error($data['msg']);
            //$this->success($data['msg']);
            $this->redirect(U('Home/User/paypwd', array('step' => 3)));
            exit;
        }
        $this->assign('step', $step);
        return $this->fetch();
    }
    /**
     * 取消售后服务
     * @author lxl
     * @time 2017-4-19
     */
    public function return_goods_cancel(){
        $id = I('id',0);
        if(empty($id))$this->error('参数错误');
        $return_goods = M('return_goods')->where(array('id'=>$id,'user_id'=>$this->user_id))->find();
        if(empty($return_goods)) $this->error('参数错误');
        M('return_goods')->where(array('id'=>$id))->save(array('status'=>-2,'canceltime'=>time()));
        $this->success('取消成功',U('User/return_goods_list'));
        exit;
    }

    /**
     *  点赞
     * @author lxl
     * @time  17-4-20
     * 拷多商家Order控制器
     */
    public function ajaxZan()
    {
        $comment_id = I('post.comment_id/d');
        $user_id = $this->user_id;
        $comment_info = M('comment')->where(array('comment_id' => $comment_id))->find();  //获取点赞用户ID
        $comment_user_id_array = explode(',', $comment_info['zan_userid']);
        if (in_array($user_id, $comment_user_id_array)) {  //判断用户有没点赞过
            $result['success'] = 0;
        } else {
            array_push($comment_user_id_array, $user_id);  //加入用户ID
            $comment_user_id_string = implode(',', $comment_user_id_array);
            $comment_data['zan_num'] = $comment_info['zan_num'] + 1;  //点赞数量加1
            $comment_data['zan_userid'] = $comment_user_id_string;
            M('comment')->where(array('comment_id' => $comment_id))->save($comment_data);
            $result['success'] = 1;
        }
        exit(json_encode($result));
    }

    /**
     * 删除足迹
     * @author lxl
     * @time  17-4-20
     * 拷多商家User控制器
     */
    public function del_visit_log(){

        $visit_id = I('visit_id/d' , 0);
        $row = M('goods_visit')->where(['visit_id'=>$visit_id])->delete();
        if($row>0){
            return $this->ajaxReturn(['status'=>1 , 'msg'=> '删除成功']);
        }else{
            return $this->ajaxReturn(['status'=>-1 , 'msg'=> '删除失败']);
        }
    }

    /**
     * 我的足迹
     * @author lxl
     * @time  17-4-20
     * 拷多商家User控制器
     * */
    public function visit_log()
    {
        $cat_id = I('cat_id', 0);
        $map['user_id'] = $this->user_id;
        if ($cat_id > 0) $map['a.cat_id'] = $cat_id;
        $count = M('goods_visit a')->where($map)->count();
        $Page = new Page($count, 20);
        $visit_list = M('goods_visit a')->field("a.*,g.goods_name,g.shop_price")
            ->join('__GOODS__ g', 'a.goods_id = g.goods_id', 'LEFT')
            ->where($map)
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->order('a.visittime desc')
            ->select();
        $visit_log = $cates = array();
        $visit_total = 0;
        if ($visit_list) {
            $now = time();
            $endLastweek = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 7, date('Y'));
            $weekarray = array("日", "一", "二", "三", "四", "五", "六");
            foreach ($visit_list as $k => $val) {
                if ($now - $val['visittime'] < 3600 * 24 * 7) {
                    if (date('Y-m-d') == date('Y-m-d', $val['visittime'])) {
                        $val['date'] = '今天';
                    } else {
                        if ($val['visittime'] < $endLastweek) {
                            $val['date'] = "上周" . $weekarray[date("w", $val['visittime'])];
                        } else {
                            $val['date'] = "周" . $weekarray[date("w", $val['visittime'])];
                        }
                    }
                } else {
                    $val['date'] = '更早以前';
                }
                $cat_ids[] = $val['cat_id'];
                $visit_log[$val['date']][] = $val;
            }
            $cateArr = M('goods_category')->where(array('id' => array('in', array_unique($cat_ids))))->getField('id,name');
            $cates = M('goods_visit a')->field('cat_id,COUNT(cat_id) as csum')->where($map)->group('cat_id')->select();
            foreach ($cates as $k => $v) {
                if (isset($cateArr[$v['cat_id']])) $cates[$k]['name'] = $cateArr[$v['cat_id']];
                $visit_total += $v['csum'];
            }
        }
        $this->assign('visit_total', $visit_total);
        $this->assign('catids', $cates);
        $this->assign('page', $Page->show());
        $this->assign('visit_log', $visit_log); //浏览记录
        return $this->fetch();
    }

    /**
     * 换货商品确认收货
     * @author lxl
     * @time  17-4-25
     * */
    public function receiveConfirm(){
        $return_id=I('return_id/d');
        $return_info=M('return_goods')->field('order_id,order_sn,goods_id,spec_key')->where('id',$return_id)->find(); //查找退换货商品信息
        $update = M('return_goods')->where('id',$return_id)->save(['status'=>3]);  //要更新状态为已完成
        if($update) {
            M('order_goods')->where(array(
                'order_id' => $return_info['order_id'],
                'goods_id' => $return_info['goods_id'],
                'spec_key' => $return_info['spec_key']))->save(['is_send' => 2]);  //订单商品改为已换货
            $this->success("操作成功", U("User/return_goods_info", array('id' => $return_id)));
        }
        $this->error("操作失败");
    }
}