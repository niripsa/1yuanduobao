<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace app\admin\logic;

use app\admin\model\FlashSale;
use think\Model;
use think\db;

/**
 * 秒杀逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
class FlashSaleLogic extends Model
{
    protected $flashSale;

    public function __construct($falseSaleId)
    {
        parent::__construct();
        $flashSaleModel = new FlashSale();
        $this->flashSale = $flashSaleModel::get($falseSaleId);
        if ($this->flashSale) {
            //每次初始化都检测活动是否结束，如果失效就更新活动和商品恢复成普通商品
            if ($this->checkFlashSaleIsEnd()) {
                Db::name('goods')->where("goods_id", $this->flashSale['goods_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                $this->flashSale->is_end = 1;
                $this->flashSale->save();
            }
        }
    }

    /**
     * 活动是否正在进行
     * @return bool
     */
    public function checkFlashSaleIsAble(){
        if(empty($this->flashSale)){
            return false;
        }
        if(time() > $this->flashSale['start_time'] && time() < $this->flashSale['end_time']){
            return true;
        }
        return false;
    }

    /**
     * 活动是否结束
     * @return bool
     */
    public function checkFlashSaleIsEnd(){
        if(empty($this->flashSale)){
            return true;
        }
        if($this->flashSale['buy_num'] >= $this->flashSale['goods_num']){
            return true;
        }
        if(time() > $this->flashSale['end_time']){
            return true;
        }
        return false;
    }

    /**
     * 获取抢购优惠信息
     * @param int $user_id |用户ID
     * @param int $goods_id |商品id
     * @return mixed
     */
    public function getPromotionInfo($user_id = 0, $goods_id = 0)
    {
        if (empty($this->flashSale)) {
            $promotionInfo['is_end'] = 1;//已结束
        } else {
            $promotionInfo['is_end'] = 0;
            $promotionInfo['prom_type'] = 1;
            $promotionInfo['prom_id'] = $this->flashSale['id'];
            $promotionInfo['start_time'] = $this->flashSale['start_time'];
            $promotionInfo['start_time'] = $this->flashSale['start_time'];
            $promotionInfo['end_time'] = $this->flashSale['end_time'];
            $promotionInfo['store_count'] = $this->flashSale['goods_num'] - $this->flashSale['buy_num'];
            if ($promotionInfo['store_count'] <= 0) {
                $promotionInfo['is_end'] = 2;//已售罄
            } else {
                $promotionInfo['price'] = $this->flashSale['price'];
            }
        }
        return $promotionInfo;
    }

    /**
     * 获取用户抢购已购商品数量
     * @param $user_id
     * @return float|int
     */
    public function getUserFlashOrderGoodsNum($user_id){
        $orderWhere = [
            'user_id'=>$user_id,
            'order_status' => ['<>', 3],
            'add_time' => ['between', [$this->flashSale['start_time'], $this->flashSale['end_time']]]
        ];
        $order_id_arr = Db::name('order')->where($orderWhere)->getField('order_id', true);
        if ($order_id_arr) {
            $orderGoodsWhere = ['prom_id' => $this->flashSale['id'], 'prom_type' => 1, 'order_id' => ['in', implode(',', $order_id_arr)]];
            $goods_num = DB::name('order_goods')->where($orderGoodsWhere)->sum('goods_num');
            return $goods_num;
        } else {
            return 0;
        }
    }

    /**
     * 获取用户剩余抢购商品数量
     * @author lxl 2017-5-11
     * @param $user_id 用户ID
     * @param $goods_num 购买数量
     * @return mixed
     */
    public function getUserFlashResidueGoodsNum($user_id,$goods_num){
        $purchase_num = $this->getUserFlashOrderGoodsNum($user_id); //用户抢购已购商品数量
        $residue_num = $this->flashSale['goods_num'] - $this->flashSale['buy_num']; //剩余库存
        $cart_num = $goods_num + $purchase_num;  //现在购物车总购买数量，包括已买，购物车的
        //总共买的数量大于限购数量
        if($cart_num > $this->flashSale['buy_limit']){
            if($goods_num >= $this->flashSale['buy_limit']){
                $goods_num  = $this->flashSale['buy_limit'] - $purchase_num;
            }elseif($goods_num > $residue_num){ //要买的数量大于库存
                $goods_num  = $residue_num;
            }
        }else{
            //要买的数量大于库存
            if($goods_num > $residue_num){
                $goods_num  = $residue_num;
            }

        }
        return $goods_num;
    }

    /**
     * 获取单个抢购活动
     * @return static
     */
    public function getFlashSaleModel(){
        return $this->flashSale;
    }
}