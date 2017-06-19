<?php
namespace app\admin\validate;
use think\Validate;
class FlashSale extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require'],
        ['goods_id', 'require'],
        ['price','require|number'],
        ['goods_num','require|number'],
        ['buy_limit','require|number|checkLimit'],
        ['start_time','require'],
        ['end_time','require|checkEndTime'],
    ];
    //错误信息
    protected $message  = [
        'title.require'         => '抢购标题必须',
        'goods_id.require'      => '请选择参与抢购的商品',
        'price.require'         => '请填写限时抢购价格',
        'price.number'          => '限时抢购价格必须是数字',
        'goods_num.require'     => '请填写参加抢购数量',
        'goods_num.number'      => '抢购数量必须为数字',
        'buy_limit.require'     => '请填写限购数量',
        'buy_limit.number'      => '限购数量必须为数字',
        'buy_limit.checkLimit'  => '限购数量不能超过抢购数量',
        'start_time.require'    => '请选择开始时间',
        'end_time.require'      => '请选择结束时间',
        'end_time.checkEndTime' => '结束时间不能早于开始时间',
    ];

    /**
     * 检查限购数量
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkLimit($value, $rule ,$data)
    {
        return ($value > $data['goods_num']) ? false : true;
    }
    /**
     * 检查结束时间
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkEndTime($value, $rule ,$data)
    {
        return ($value < $data['start_time']) ? false : true;
    }
}