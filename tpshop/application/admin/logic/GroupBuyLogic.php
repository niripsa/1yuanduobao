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

use app\admin\model\GroupBuy;
use think\Model;
use think\db;

/**
 * 团购逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
class GroupBuyLogic extends Model
{
    protected $GroupBuy;

    public function __construct($GroupBuyId)
    {
        parent::__construct();
        $GroupBuyModel = new GroupBuy();
        $this->GroupBuy = $GroupBuyModel::get($GroupBuyId);
        if ($this->GroupBuy) {
            //每次初始化都检测活动是否失效，如果失效就更新活动和商品恢复成普通商品
            if ($this->GroupBuy['buy_num'] >= $this->GroupBuy['goods_num'] || time() > $this->GroupBuy['end_time']) {
                Db::name('goods')->where("goods_id", $this->GroupBuy['goods_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                $this->GroupBuy->is_end = 1;
                $this->GroupBuy->save();
            }
        }
    }

    /**
     * 获取团购优惠信息
     * @param int $user_id |用户ID
     * @param int $goods_id |商品id
     * @return mixed
     */
    public function getPromotionInfo($user_id = 0, $goods_id = 0)
    {
        if (empty($this->GroupBuy)) {
            $promotionInfo['is_end'] = 1;//已结束
        } else {
            $promotionInfo['is_end'] = 0;
            $promotionInfo['prom_type'] = 2;
            $promotionInfo['prom_id'] = $this->GroupBuy['id'];
            $promotionInfo['start_time'] = $this->GroupBuy['start_time'];
            $promotionInfo['end_time'] = $this->GroupBuy['end_time'];
            $promotionInfo['store_count'] = $this->GroupBuy['goods_num'] - $this->GroupBuy['buy_num'];
            if ($promotionInfo['store_count'] <= 0) {
                $promotionInfo['is_end'] = 2;//已售罄
            } else {
                $promotionInfo['price'] = $this->GroupBuy['price'];
            }
        }
        return $promotionInfo;
    }
    /**
     * 获取团购剩余库存
     */
    public function getPromotionSurplus(){
        return $this->GroupBuy['goods_num'] - $this->GroupBuy['buy_num'];
    }
    public function getGroupBuyModel(){
        return $this->GroupBuy;
    }
}