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
use think\Db;
/**
 * 购物车 逻辑定义
 * Class CatsLogic
 * @package Home\Logic
 */
class CouponLogic extends Model
{

    /**
     * 获取用户可以使用的优惠券
     * @param $user_id|用户id
     * @param $coupon_id|优惠券id
     * @return int|mixed
     */
    public function getCouponMoney($user_id, $coupon_id)
    {
        if ($coupon_id == 0) {
            return 0;
        }
        $couponList = M('CouponList')->where("uid", $user_id)->where('id', $coupon_id)->find(); // 获取用户的优惠券
        if (empty($couponList)) {
            return 0;
        }
        $coupon = M('Coupon')->where("id", $couponList['cid'])->find(); // 获取 优惠券类型表
        $coupon['money'] = $coupon['money'] ? $coupon['money'] : 0;
        return $coupon['money'];
    }

    /**
     * 根据优惠券代码获取优惠券金额
     * @param $couponCode|优惠券代码
     * @param $orderMoney|订单金额
     * @return array
     */
    public function getCouponMoneyByCode($couponCode,$orderMoney)
    {
        $couponList = M('CouponList')->where("code", $couponCode)->find(); // 获取用户的优惠券
        if(empty($couponList))
            return array('status'=>-9,'msg'=>'优惠券码不存在','result'=>'');
        if($couponList['order_id'] > 0){
            return array('status'=>-20,'msg'=>'该优惠券已被使用','result'=>'');
        }
        $coupon = M('Coupon')->where("id", $couponList['cid'])->find(); // 获取优惠券类型表
        if(time() < $coupon['use_start_time'])
            return array('status'=>-13,'msg'=>'该优惠券开始使用时间'.date('Y-m-d H:i:s',$coupon['use_start_time']),'result'=>'');
        if(time() > $coupon['use_end_time'])
            return array('status'=>-10,'msg'=>'优惠券已经过期'.date('Y-m-d H:i:s',$coupon['use_start_time']),'result'=>'');
        if($orderMoney < $coupon['condition'])
            return array('status'=>-11,'msg'=>'金额没达到优惠券使用条件','result'=>'');
        if($couponList['order_id'] > 0)
            return array('status'=>-12,'msg'=>'优惠券已被使用','result'=>'');

        return array('status'=>1,'msg'=>'','result'=>$coupon['money']);
    }
}