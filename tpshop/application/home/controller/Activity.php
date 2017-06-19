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
 * $Author: IT宇宙人 2015-08-10 $
 */
namespace app\home\controller;

use app\home\logic\CartLogic;
use app\home\logic\GoodsLogic;
use think\AjaxPage;
use think\Controller;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Db;

class Activity extends Base
{
    /**
     * 商品详情页
     */
    public function group()
    {
        //form表单提交
        C('TOKEN_ON', true);

        $goodsLogic = new GoodsLogic();
        $goods_id = I("get.id/d");

        $group_buy_info = M('GroupBuy')->where(['goods_id' => $goods_id, 'start_time' => ['<=', time()], 'end_time' => ['>=', time()]])->find(); // 找出这个商品
        if (empty($group_buy_info)) {
            $this->error("此商品没有团购活动", U('Home/Goods/goodsInfo', array('id' => $goods_id)));
            exit;
        }

        $goods = M('Goods')->where("goods_id", $goods_id)->find();
        $goods_images_list = M('GoodsImages')->where("goods_id", $goods_id)->select(); // 商品 图册

        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where("goods_id", $goods_id)->select(); // 查询商品属性表

        // 商品规格 价钱 库存表 找出 所有 规格项id
        $keys = M('SpecGoodsPrice')->where("goods_id", $goods_id)->getField("GROUP_CONCAT(`key` SEPARATOR '_') ");
        if ($keys) {
            $specImage = M('SpecImage')->where("goods_id = :goods_id and src != '' ")->bind(['goods_id' => $goods_id])->getField("spec_image_id,src");// 规格对应的 图片表， 例如颜色
            $keys = str_replace('_', ',', $keys);
            $sql = "SELECT a.name,a.order,b.* FROM __PREFIX__spec AS a INNER JOIN __PREFIX__spec_item AS b ON a.id = b.spec_id WHERE b.id IN($keys) ORDER BY a.order";
            $filter_spec2 = DB::query($sql);
            foreach ($filter_spec2 as $key => $val) {
                $filter_spec[$val['name']][] = array(
                    'item_id' => $val['id'],
                    'item' => $val['item'],
                    'src' => $specImage[$val['id']],
                );
            }
        }
        $spec_goods_price = M('spec_goods_price')->where("goods_id", $goods_id)->getField("key,price,store_count"); // 规格 对应 价格 库存表
        M('Goods')->where("goods_id", $goods_id)->save(array('click_count' => $goods['click_count'] + 1)); // 统计点击数
        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计
        $navigate_goods = navigate_goods($goods_id, 1); // 面包屑导航
        $point_rate = tpCache('shopping.point_rate');
        $this->assign('point_rate', $point_rate);
        $this->assign('group_buy_info', $group_buy_info);
        $this->assign('spec_goods_price', json_encode($spec_goods_price, true)); // 规格 对应 价格 库存表
        $this->assign('navigate_goods', $navigate_goods);
        $this->assign('commentStatistics', $commentStatistics);
        $this->assign('goods_attribute', $goods_attribute);
        $this->assign('goods_attr_list', $goods_attr_list);
        $this->assign('filter_spec', $filter_spec);
        $this->assign('goods_images_list', $goods_images_list);
        $this->assign('goods', $goods);
        $this->assign('look_see', $goodsLogic->get_look_see($goods)); //看了又看 2017-2-28 lxl
        return $this->fetch();
    }


    /**
     * 团购活动列表
     */
    public function group_list()
    {
        $count = M('GroupBuy')->where(time() . " >= start_time and " . time() . " <= end_time ")->count();// 查询满足要求的总记录数
        $Page = new Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $list = M('GroupBuy')->where(time() . " >= start_time and " . time() . " <= end_time ")->limit($Page->firstRow . ',' . $Page->listRows)->select(); // 找出这个商品
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 预售列表页
     */
    public function pre_sell_list()
    {
        $model = D('goods_activity');
        $pre_sell_list = $model->where(array('act_type' => 1, 'is_finished' => 0))->select();
        foreach ($pre_sell_list as $key => $val) {
            $pre_sell_list[$key] = array_merge($pre_sell_list[$key]->toArray(), unserialize($pre_sell_list[$key]['ext_info']));
            $pre_sell_list[$key]['act_status'] = $model->getPreStatusAttr($pre_sell_list[$key]);
            $pre_count_info = $model->getPreCountInfo($pre_sell_list[$key]['act_id'], $pre_sell_list[$key]['goods_id']);
            $pre_sell_list[$key] = array_merge($pre_sell_list[$key], $pre_count_info);
            $pre_sell_list[$key]['price'] = $model->getPrePrice($pre_sell_list[$key]['total_goods'], $pre_sell_list[$key]['price_ladder']);
        }
        $this->assign('pre_sell_list', $pre_sell_list);
        return $this->fetch();
    }

    /**
     *   预售详情页
     */
    public function pre_sell()
    {
        $id = I('id/d', 0);
        $pre_sell_info = M('goods_activity')->where(array('act_id' => $id, 'act_type' => 1))->find();
        if (empty($pre_sell_info)) {
            $this->error('对不起，该预售商品不存在或者已经下架了', U('Home/Activity/pre_sell_list'));
            exit();
        }
        $goods = M('goods')->where(array('goods_id' => $pre_sell_info['goods_id']))->find();
        if (empty($goods)) {
            $this->error('对不起，该预售商品不存在或者已经下架了', U('Home/Activity/pre_sell_list'));
            exit();
        }

        $pre_sell_info = array_merge($pre_sell_info, unserialize($pre_sell_info['ext_info']));
        $pre_count_info = D('goods_activity')->getPreCountInfo($pre_sell_info['act_id'], $pre_sell_info['goods_id']);//预售商品的订购数量和订单数量
        $pre_sell_info['price'] = D('goods_activity')->getPrePrice($pre_count_info['total_goods'], $pre_sell_info['price_ladder']);//预售商品价格
        $pre_sell_info['amount'] = D('goods_activity')->getPreAmount($pre_count_info['total_goods'], $pre_sell_info['price_ladder']);//预售商品数额ing
        if ($goods['brand_id']) {
            $brand = M('brand')->where(array('id' => $goods['brand_id']))->find();
            $goods['brand_name'] = $brand['name'];
        }
        $goods_images_list = M('GoodsImages')->where(array('goods_id' => $goods['goods_id']))->select(); // 商品 图册
        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where(array('goods_id' => $goods['goods_id']))->select(); // 查询商品属性表
        $goodsLogic = new GoodsLogic();
        $filter_spec = $goodsLogic->get_spec($goods['goods_id']);
        $spec_goods_price = M('spec_goods_price')->where(array('goods_id' => $goods['goods_id']))->getField("key,price,store_count"); // 规格 对应 价格 库存表
        $commentStatistics = $goodsLogic->commentStatistics($goods['goods_id']);// 获取某个商品的评论统计
        $this->assign('pre_count_info', $pre_count_info);//预售商品的订购数量和订单数量
        $this->assign('commentStatistics', $commentStatistics);//评论概览
        $this->assign('goods_attribute', $goods_attribute);//属性值
        $this->assign('goods_attr_list', $goods_attr_list);//属性列表
        $this->assign('filter_spec', $filter_spec);//规格参数
        $this->assign('goods_images_list', $goods_images_list);//商品缩略图
        $this->assign('spec_goods_price', json_encode($spec_goods_price, true)); // 规格 对应 价格 库存表\
        $this->assign('siblings_cate', $goodsLogic->get_siblings_cate($goods['cat_id']));//相关分类
        $this->assign('look_see', $goodsLogic->get_look_see($goods));//看了又看
        $this->assign('pre_sell_info', $pre_sell_info);
        $this->assign('goods', $goods);
        return $this->fetch();
    }

    // 促销活动页面
    public function promoteList()
    {
        $goods_where['p.start_time']  = array('lt',time());
        $goods_where['p.end_time']  = array('gt',time());
        $goods_where['g.prom_type']  = 3;
        $goodsList = M('goods')
            ->alias('g')
            ->join('__PROM_GOODS__ p', 'g.prom_id = p.id')
            ->where($goods_where)
            ->select();
        $brandList = M('brand')->getField("id,name,logo");
        $this->assign('brandList',$brandList);
        $this->assign('goodsList',$goodsList);
        return $this->fetch();
    }
    /**
     * 抢购活动列表
     */
    public function flash_sale_list()
    {
        $time_space = flash_sale_time_space();
        $this->assign('time_space', $time_space);
        return $this->fetch();
    }
    /**
     * 抢购活动列表ajax
     */
    public function ajax_flash_sale()
    {
        $p = I('p',1);
        $start_time = I('start_time');
        $end_time = I('end_time');
        $where = array(
            'f.start_time'=>array('egt',$start_time),
            'f.end_time'=>array('elt',$end_time)
        );
        $flash_sale_goods = M('flash_sale')
            ->field('f.end_time,f.goods_name,f.price,f.goods_id,f.price,g.shop_price,100*(FORMAT(f.buy_num/f.goods_num,2)) as percent')
            ->alias('f')
            ->join('__GOODS__ g','g.goods_id = f.goods_id')
            ->where($where)
            ->page($p,10)
            ->select();
        $this->assign('flash_sale_goods',$flash_sale_goods);
        $this->assign('now',time());
        return $this->fetch();
    }

    public function coupon_list()
    {
        $atype = I('atype', 1);
        $where = array('type' => 2,'send_start_time'=>['elt',time()],'send_end_time'=>['egt',time()]);
        $order = array('id' => 'desc');
        if ($atype == 2) {
            //即将过期
            $order = ['spacing_time' => 'asc'];
            $where['send_end_time-UNIX_TIMESTAMP()'] = ['egt', 0];
        }
        if ($atype == 3) {
            //面值最大
            $order = ['money' => 'desc'];
        }
        $count = M('coupon')->where($where)->where('createnum-send_num >0')->count();
        $Page = new Page($count, 15);
        $coupon_list = M('coupon')->alias('c')
            ->field(C('database.prefix') . 'coupon.*,send_end_time-UNIX_TIMESTAMP() as spacing_time')
            ->where($where)
            ->where('c.createnum-c.send_num >0')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->order($order)->select();
        if (is_array($coupon_list) && count($coupon_list) > 0) {
            $user = session('user');
            if ($user) {
                $user_coupon = M('coupon_list')->where(array('uid' => $user['user_id'], 'type' => 2))->getField('cid');
            }
            if (!empty($user_coupon)) {
                foreach ($coupon_list as $k => $val) {
                    if (!empty($user_coupon[$val['id']])) {
                        $coupon_list[$k]['isget'] = 1;
                    }
                }
            }
        }
        $this->assign('atype', $atype);
        $this->assign('coupon_list', $coupon_list);
        $this->assign('listRows', $Page->listRows);
        $this->assign('page', $Page->show());
        return $this->fetch();
    }

    /**
     * 领券
     */
    public function get_coupon()
    {
        $id = I('coupon_id/d');
        if (empty($id)){
            $this->error('参数错误');
        }
        if (session('?user')) {
            $user = session('user');
            $_SERVER['HTTP_REFERER'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U('Home/Activity/coupon_list');
            $coupon_info = M('coupon')->where(array('id' => $id))->find();
            if (empty($coupon_info)) {
                $result =['status' => 0, 'msg' => '活动已结束或不存在，看下其他活动吧~','return_url'=>$_SERVER['HTTP_REFERER']];
            } elseif ($coupon_info['send_end_time'] < time()) {
                //来晚了，过了领取时间
                $result =['status' => 0, 'msg' => '抱歉，已经过了领取时间','return_url'=>$_SERVER['HTTP_REFERER']];
            } elseif ($coupon_info['send_num'] >= $coupon_info['createnum']) {
                //来晚了，优惠券被抢完了
                $result =['status' => 0, 'msg' => '来晚了，优惠券被抢完了','return_url'=>$_SERVER['HTTP_REFERER']];
            } else {
                if (M('coupon_list')->where(array('cid' => $id, 'uid' => $user['user_id']))->count() > 0) {
                    //已经领取过
                    $result = ['status'=>2,'msg'=>'您已领取过该优惠券','return_url'=>$_SERVER['HTTP_REFERER']];
                } else {
                    $data = array('uid' => $user['user_id'], 'cid' => $id, 'type' => 2, 'send_time' => time());
                    M('coupon_list')->add($data);
                    M('coupon')->where(array('id' => $id))->setInc('send_num');
                    $result = ['status'=>1,'msg'=>'恭喜您，抢到'.$coupon_info['money'].'元优惠券!','return_url'=>$_SERVER['HTTP_REFERER']];
                }
            }
        } else {
            $this->redirect(U('User/login'));
        }
        $this->assign('res',$result);
        return $this->fetch();
    }
}