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
 * Author: dyr
 * Date: 2016-08-23
 */

namespace app\home\model;

use think\model;

/**
 * Class UserAddressModel
 * @package Home\Model
 */
class UserAddress extends model
{
    protected $tableName = 'user_address';

    /**
     * 获取用户自提点
     * @time 2016/08/23
     * @author
     * @param $user_id
     * @return mixed
     */
    public function getUserPickup($user_id)
    {
        $user_pickup_where = array(
            'ua.user_id' => $user_id,
            'ua.is_pickup' => 1
        );
        $user_pickup_list = M('user_address')
            ->alias('ua')
            ->field('ua.*,r1.name AS province_name,r2.name AS city_name,r3.name AS district_name')
            ->join('__REGION__ r1','r1.id = ua.province','LEFT')
            ->join('__REGION__ r2','r2.id = ua.city','LEFT')
            ->join('__REGION__ r3', 'r3.id = ua.district','LEFT')
            ->where($user_pickup_where)
            ->find();
        return $user_pickup_list;
    }

}