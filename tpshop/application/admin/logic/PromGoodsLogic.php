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
use app\admin\model\PromGoods;
use think\Model;
use think\db;

/**
 * 促销商品逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
class PromGoodsLogic extends Model
{
    protected $promGoods;

    public function __construct($promGoodsId)
    {
        parent::__construct();
        $promGoodsModel = new PromGoods();
        $this->promGoods = $promGoodsModel::get($promGoodsId);
        if ($this->promGoods) {
            //每次初始化都检测活动是否失效，如果失效就更新活动和商品恢复成普通商品
            if (time() > $this->promGoods['end_time']) {
                Db::name('goods')->where(['prom_type' => 3, 'prom_id' => $promGoodsId])->save(['prom_type' => 0, 'prom_id' => 0]);
                $this->promGoods->is_close = 1;
                $this->promGoods->save();
            }
        }
    }

    /**
     * 获取促销优惠信息
     * @param int $user_id
     * @param int $goods_id
     * @return mixed
     */
    public function getPromotionInfo($user_id = 0, $goods_id = 0)
    {
        if (empty($this->promGoods)) {
            $promotionInfo['is_end'] = 1;//已结束
        } else {
            $promotionInfo['is_end'] = 0;
            $promotionInfo['prom_type'] = 3;
            $promotionInfo['prom_id'] = $this->promGoods['id'];
            $promotionInfo['start_time'] = $this->promGoods['start_time'];
            $promotionInfo['end_time'] = $this->promGoods['end_time'];
            $goods = Db::name('goods')->where('goods_id', $goods_id)->find();
            if (time() > $this->promGoods['start_time'] && time() < $this->promGoods['end_time']) {
                $promotionInfo['price'] = $this->getPromotionPrice($goods['shop_price']);
            } else {
                $promotionInfo['price'] = $goods['shop_price'];//原价
            }
        }
        return $promotionInfo;
    }

    public function getPromGoodsModel(){
        return $this->promGoods;
    }

    /**
     * 计算促销价格。
     * @param $Price|原价或者规格价格
     * @return float
     */
    public function getPromotionPrice($Price){
        switch ($this->promGoods['type']) {
            case 0:
                $promotionPrice = $Price * $this->promGoods['expression'] / 100;//打折优惠
                break;
            case 1:
                $promotionPrice = $Price - $this->promGoods['expression'];//减价优惠
                break;
            case 2:
                $promotionPrice = $this->promGoods['expression'];//固定金额优惠
                break;
            default:
                $promotionPrice = $Price;//原价
                break;
        }
        return $promotionPrice;
    }
}