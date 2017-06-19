<?php
namespace app\admin\validate;
use think\Validate;
class GroupBuy extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require'],
        ['goods_id', 'require'],
        ['goods_name', 'require'],
        ['price','require|number'],
        ['goods_num','require|number'],
        ['virtual_num','number'],
        ['start_time','require'],
        ['end_time','require|checkEndTime'],
        ['intro','max:100'],
    ];
    //错误信息
    protected $message  = [
        'title.require'         => '团购标题必须',
        'start_time.require'    => '请选择开始时间',
        'end_time.require'      => '请选择结束时间',
        'end_time.checkEndTime' => '结束时间不能早于开始时间',
        'goods_name.require'    => '请填写商品名称',
        'goods_id.require'      => '请选择参与团购的商品',
        'price.require'         => '请填写团购价格',
        'price.number'          => '团购价格必须是数字',
        'goods_num.require'     => '请填写参加团购数量',
        'goods_num.number'      => '团购数量必须为数字',
        'virtual_num.number'    => '虚拟购买数量必须为数字',
        'intro.max'             => '活动介绍小于100字符',
    ];

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