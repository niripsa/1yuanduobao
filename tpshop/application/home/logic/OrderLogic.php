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

namespace app\home\logic;
use think\Model;
use app\home\logic\CartLogic;
use think\Db;
/**
 * 订单逻辑定义
 * Class CatsLogic
 * @package Home\Logic
 */
class OrderLogic extends Model
{
    /**
     * 添加一个订单
     * @param $user_id|用户id
     * @param $address_id|地址id
     * @param $shipping_code|物流编号
     * @param $invoice_title|发票
     * @param int $coupon_id|优惠券id
     * @param $car_price|各种价格
     * @param string $user_note|用户备注
     * @return array
     */
    public function addOrder($user_id,$address_id,$shipping_code,$invoice_title,$coupon_id = 0,$car_price,$user_note='')
    {

        // 仿制灌水 1天只能下 50 单  // select * from `tp_order` where user_id = 1  and order_sn like '20151217%'
        $order_count = M('Order')->where("user_id",$user_id)->where('order_sn', 'like', date('Ymd')."%")->count(); // 查找购物车商品总数量
        if($order_count >= 50)
            return array('status'=>-9,'msg'=>'一天只能下50个订单','result'=>'');

        // 0插入订单 order
        $address = M('UserAddress')->where("address_id", $address_id)->find();
        $shipping = M('Plugin')->where("code", $shipping_code)->cache(true,TPSHOP_CACHE_TIME)->find();
        $data = array(
            'order_sn'         => date('YmdHis').rand(1000,9999), // 订单编号
            'user_id'          =>$user_id, // 用户id
            'consignee'        =>$address['consignee'], // 收货人
            'province'         =>$address['province'],//'省份id',
            'city'             =>$address['city'],//'城市id',
            'district'         =>$address['district'],//'县',
            'twon'             =>$address['twon'],// '街道',
            'address'          =>$address['address'],//'详细地址',
            'mobile'           =>$address['mobile'],//'手机',
            'zipcode'          =>$address['zipcode'],//'邮编',
            'email'            =>$address['email'],//'邮箱',
            'shipping_code'    =>$shipping_code,//'物流编号',
            'shipping_name'    =>$shipping['name'], //'物流名称',                为照顾新手开发者们能看懂代码，此处每个字段加于详细注释
            'invoice_title'    =>$invoice_title, //'发票抬头',
            'goods_price'      =>$car_price['goodsFee'],//'商品价格',
            'shipping_price'   =>$car_price['postFee'],//'物流价格',
            'user_money'       =>$car_price['balance'],//'使用余额',
            'coupon_price'     =>$car_price['couponFee'],//'使用优惠券',
            'integral'         =>($car_price['pointsFee'] * tpCache('shopping.point_rate')), //'使用积分',
            'integral_money'   =>$car_price['pointsFee'],//'使用积分抵多少钱',
            'total_amount'     =>($car_price['goodsFee'] + $car_price['postFee']),// 订单总额
            'order_amount'     =>$car_price['payables'],//'应付款金额',
            'add_time'         =>time(), // 下单时间
            'order_prom_id'    =>$car_price['order_prom_id'],//'订单优惠活动id',
            'order_prom_amount'=>$car_price['order_prom_amount'],//'订单优惠活动优惠了多少钱',
            'user_note'        =>$user_note, // 用户下单备注
        );
        $data['order_id'] = $order_id = M("Order")->insertGetId($data);
        $order = $data;//M('Order')->where("order_id", $order_id)->find();
        if(!$order_id)
            return array('status'=>-8,'msg'=>'添加订单失败','result'=>NULL);

        // 记录订单操作日志
        $action_info = array(
            'order_id'        =>$order_id,
            'action_user'     =>$user_id,
            'action_note'     => '您提交了订单，请等待系统确认',
            'status_desc'     =>'提交订单', //''
            'log_time'        =>time(),
        );
        M('order_action')->insertGetId($action_info);

        // 1插入order_goods 表
        $cartList = M('Cart')->where(['user_id'=>$user_id,'selected'=>1])->select();
        foreach($cartList as $key => $val)
        {
            $goods = M('goods')->where("goods_id", $val['goods_id'])->cache(true,TPSHOP_CACHE_TIME)->find();
            $data2['order_id']           = $order_id; // 订单id
            $data2['goods_id']           = $val['goods_id']; // 商品id
            $data2['goods_name']         = $val['goods_name']; // 商品名称
            $data2['goods_sn']           = $val['goods_sn']; // 商品货号
            $data2['goods_num']          = $val['goods_num']; // 购买数量
            $data2['market_price']       = $val['market_price']; // 市场价
            $data2['goods_price']        = $val['goods_price']; // 商品价               为照顾新手开发者们能看懂代码，此处每个字段加于详细注释
            $data2['spec_key']           = $val['spec_key']; // 商品规格
            $data2['spec_key_name']      = $val['spec_key_name']; // 商品规格名称
            $data2['member_goods_price'] = $val['member_goods_price']; // 会员折扣价
            $data2['cost_price']         = $goods['cost_price']; // 成本价
            $data2['give_integral']      = $goods['give_integral']; // 购买商品赠送积分
            $data2['prom_type']          = $val['prom_type']; // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            $data2['prom_id']            = $val['prom_id']; // 活动id
            $order_goods_id              = M("OrderGoods")->insertGetId($data2);
        }

        // 2 扣除积分 扣除余额
        $need_points = $data['integral_money'];
        $need_money  = $data['order_amount'];
       
        $bIsPaySuccess = D("Yydb")->payByMoneyAndPoints($need_points, $need_money, $user_id);
        if(!$bIsPaySuccess){
            return array('status'=>-10,'msg'=>'余额或积分不足，提交订单失败','result'=>'');
        }

        //更新支付状态并且更新库存
        update_pay_status($order['order_sn']);

        // 4 删除已提交订单商品
        M('Cart')->where(['user_id' => $user_id,'selected' => 1])->delete();

        // 5 记录log 日志
        $data4['user_id'] = $user_id;
        $data4['user_money'] = -$car_price['balance'];
        $data4['pay_points'] = -($car_price['pointsFee'] * tpCache('shopping.point_rate'));
        $data4['change_time'] = time();
        $data4['desc'] = '下单消费';
        $data4['order_sn'] = $order['order_sn'];
        $data4['order_id'] = $order_id;
        // 如果使用了积分或者余额才记录
        ($data4['user_money'] || $data4['pay_points']) && M("AccountLog")->add($data4);

        // //分销开关全局
        // $distribut_switch = tpCache('distribut.switch');
        // if($distribut_switch  == 1 && file_exists(APP_PATH.'common/logic/DistributLogic.php'))
        // {
        //     $distributLogic = new \app\common\logic\DistributLogic();
        //     $distributLogic->rebate_log($order); // 生成分成记录
        // }
        // 如果有微信公众号 则推送一条消息到微信
       /* $user = M('users')->where("user_id", $user_id)->find();
        if($user['oauth']== 'weixin')
        {
            $wx_user = M('wx_user')->find();
            $jssdk = new \app\mobile\logic\Jssdk($wx_user['appid'],$wx_user['appsecret']);
            $wx_content = "你刚刚下了一笔订单:{$order['order_sn']} 尽快支付,过期失效!";
            $jssdk->push_msg($user['openid'],$wx_content);
        }*/
        //用户下单, 发送短信给商家
        // $res = checkEnableSendSms("3");
        // $sender = tpCache("shop_info.mobile");

        // if($res && $res['status'] ==1 && !empty($sender)){

        //     $params = array('consignee'=>$order['consignee'] , 'mobile' => $order['mobile']);
        //     $resp = sendSms("3", $sender, $params);
        // }
        return array('status'=>1,'msg'=>'提交订单成功','result'=>$order_id); // 返回新增的订单id
    }

    /**
     * 添加预售商品订单
     * @param $user_id
     * @param $address_id
     * @param $shipping_code
     * @param $invoice_title
     * @param $act_id
     * @param $pre_sell_price
     * @return array
     */
    public function addPreSellOrder($user_id,$address_id,$shipping_code,$invoice_title,$act_id,$pre_sell_price)
    {
        // 仿制灌水 1天只能下 50 单
        $order_count = M('Order')->where("user_id= $user_id and order_sn like '".date('Ymd')."%'")->count(); // 查找购物车商品总数量
        if($order_count >= 50){
            return array('status'=>-9,'msg'=>'一天只能下50个订单','result'=>'');
        }
        $address = M('UserAddress')->where(array('address_id' => $address_id))->find();
        $shipping = M('Plugin')->where(array('code' => $shipping_code))->find();
        $data = array(
            'order_sn'         => date('YmdHis').rand(1000,9999), // 订单编号
            'user_id'          =>$user_id, // 用户id
            'consignee'        =>$address['consignee'], // 收货人
            'province'         =>$address['province'],//'省份id',
            'city'             =>$address['city'],//'城市id',
            'district'         =>$address['district'],//'县',
            'twon'             =>$address['twon'],// '街道',
            'address'          =>$address['address'],//'详细地址',
            'mobile'           =>$address['mobile'],//'手机',
            'zipcode'          =>$address['zipcode'],//'邮编',
            'email'            =>$address['email'],//'邮箱',
            'shipping_code'    =>$shipping_code,//'物流编号',
            'shipping_name'    =>$shipping['name'], //'物流名称',
            'invoice_title'    =>$invoice_title, //'发票抬头',
            'goods_price'      =>$pre_sell_price['cut_price'] * $pre_sell_price['goods_num'],//'商品价格',
            'total_amount'     =>$pre_sell_price['cut_price'] * $pre_sell_price['goods_num'],// 订单总额
            'add_time'         =>time(), // 下单时间
            'order_prom_type'  => 4,
            'order_prom_id'    => $act_id
        );
        if($pre_sell_price['deposit_price'] == 0){
            //无定金
            $data['order_amount'] = $pre_sell_price['cut_price'] * $pre_sell_price['goods_num'];//'应付款金额',
        }else{
            //有定金
            $data['order_amount'] = $pre_sell_price['deposit_price'] * $pre_sell_price['goods_num'];//'应付款金额',
        }
        $order_id = Db::name('order')->insertGetId($data);
//        M('goods_activity')->where(array('act_id'=>$act_id))->setInc('act_count',$pre_sell_price['goods_num']);
        if($order_id === false){
            return array('status'=>-8,'msg'=>'添加订单失败','result'=>NULL);
        }
        logOrder($order_id,'您提交了订单，请等待系统确认','提交订单',$user_id);
        $order = M('Order')->where("order_id = $order_id")->find();
        $goods_activity = M('goods_activity')->where(array('act_id'=>$act_id))->find();
        $goods = M('goods')->where(array('goods_id'=>$goods_activity['goods_id']))->find();
        $data2['order_id']           = $order_id; // 订单id
        $data2['goods_id']           = $goods['goods_id']; // 商品id
        $data2['goods_name']         = $goods['goods_name']; // 商品名称
        $data2['goods_sn']           = $goods['goods_sn']; // 商品货号
        $data2['goods_num']          = $pre_sell_price['goods_num']; // 购买数量
        $data2['market_price']       = $goods['market_price']; // 市场价
        $data2['goods_price']        = $goods['shop_price']; // 商品团价
        $data2['cost_price']         = $goods['cost_price']; // 成本价
        $data2['member_goods_price'] = $pre_sell_price['cut_price']; //预售价钱
        $data2['give_integral']      = $goods_activity['integral']; // 购买商品赠送积分
        $data2['prom_type']          = 4; // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠 ,4 预售商品
        $data2['prom_id']    = $goods_activity['act_id'];
        Db::name('order_goods')->insert($data2);
        // 如果有微信公众号 则推送一条消息到微信
        $user = M('users')->where("user_id = $user_id")->find();
        if($user['oauth']== 'weixin')
        {
            $wx_user = M('wx_user')->find();
            $jssdk = new \app\mobile\logic\Jssdk($wx_user['appid'],$wx_user['appsecret']);
            $wx_content = "你刚刚下了一笔预售订单:{$order['order_sn']} 尽快支付,过期失效!";
            $jssdk->push_msg($user['openid'],$wx_content);
        }
        return array('status'=>1,'msg'=>'提交订单成功','result'=>$order_id); // 返回新增的订单id
    }
}

