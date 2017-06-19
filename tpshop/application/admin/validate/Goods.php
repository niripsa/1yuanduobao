<?php
namespace app\admin\validate;
use think\Validate;
class Goods extends Validate
{
    
    // 验证规则
    protected $rule = [
        ['goods_name','require|unique:goods','商品名称必填|商品名称重复'],
        ['cat_id', 'number|gt:0', '商品分类必须填写|商品分类必须选择'],
        ['goods_sn', 'unique:goods', '商品货号重复'], // 更多 内置规则 http://www.kancloud.cn/manual/thinkphp5/129356
        ['shop_price','regex:\d{1,10}(\.\d{1,2})?$','本店售价格式不对。'],
        ['market_price','regex:\d{1,10}(\.\d{1,2})?$','市场价格式不对。'],
        ['weight','regex:\d{1,10}(\.\d{1,2})?$','重量格式不对。'],
        ['exchange_integral','checkExchangeIntegral','积分抵扣金额不能超过商品总额']
    ];
     
    
    /**
     * 检查积分兑换
     * @author dyr
     * @return bool
     */
    protected function checkExchangeIntegral($value, $rule)
    {
        $exchange_integral = $value;//I('exchange_integral', 0);
        $shop_price = I('shop_price', 0);
        $point_rate_value = tpCache('shopping.point_rate');
        $point_rate_value = empty($point_rate_value) ? 0 : $point_rate_value;
        if ($exchange_integral > ($shop_price * $point_rate_value)) {
            return '积分抵扣金额不能超过商品总额';
        } else {
            return true;
        }
    }    
}