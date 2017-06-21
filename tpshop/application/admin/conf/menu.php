<?php
return	array(	
	'system'=>array('name'=>'系统','child'=>array(
				array('name' => '设置','child' => array(
						array('name'=>'商城设置','act'=>'index','op'=>'System'),
						//array('name'=>'支付方式','act'=>'index1','op'=>'System'),
						array('name'=>'地区&配送','act'=>'region','op'=>'Tools'),
						array('name'=>'短信模板','act'=>'index','op'=>'SmsTemplate'),
						//array('name'=>'接口对接','act'=>'index3','op'=>'System'),
						//array('name'=>'验证码设置','act'=>'index4','op'=>'System'),
						array('name'=>'自定义导航栏','act'=>'navigationList','op'=>'System'),
						array('name'=>'友情链接','act'=>'linkList','op'=>'Article'),
						array('name'=>'清除缓存','act'=>'cleanCache','op'=>'System'),
						array('name'=>'自提点','act'=>'index','op'=>'Pickup'),
				)),
				array('name' => '会员','child'=>array(
						array('name'=>'会员列表','act'=>'index','op'=>'User'),
						array('name'=>'会员等级','act'=>'levelList','op'=>'User'),
						array('name'=>'充值记录','act'=>'recharge','op'=>'User'),
						array('name'=>'提现申请','act'=>'withdrawals','op'=>'User'),
						array('name'=>'汇款记录','act'=>'remittance','op'=>'User'),
						//array('name'=>'会员整合','act'=>'integrate','op'=>'User'),
				)),
				array('name' => '广告','child' => array(
						array('name'=>'广告列表','act'=>'adList','op'=>'Ad'),
						array('name'=>'广告位置','act'=>'positionList','op'=>'Ad'),
				)),
				array('name' => '文章','child'=>array(
						array('name' => '文章列表', 'act'=>'articleList', 'op'=>'Article'),
						array('name' => '文章分类', 'act'=>'categoryList', 'op'=>'Article'),
						//array('name' => '帮助管理', 'act'=>'help_list', 'op'=>'Article'),
						//array('name'=>'友情链接','act'=>'linkList','op'=>'Article'),
						//array('name' => '公告管理', 'act'=>'notice_list', 'op'=>'Article'),
						array('name' => '专题列表', 'act'=>'topicList', 'op'=>'Topic'),
				)),
				array('name' => '权限','child'=>array(
						array('name' => '管理员列表', 'act'=>'index', 'op'=>'Admin'),
						array('name' => '角色管理', 'act'=>'role', 'op'=>'Admin'),
						array('name'=>'权限资源列表','act'=>'right_list','op'=>'System'),
						array('name' => '管理员日志', 'act'=>'log', 'op'=>'Admin'),
						array('name' => '供应商列表', 'act'=>'supplier', 'op'=>'Admin'),
				)),
			
				array('name' => '模板','child'=>array(
						array('name' => '模板设置', 'act'=>'templateList', 'op'=>'Template'),
				)),
				array('name' => '数据','child'=>array(
						array('name' => '数据备份', 'act'=>'index', 'op'=>'Tools'),
						array('name' => '数据还原', 'act'=>'restore', 'op'=>'Tools'),
						//array('name' => '数据恢复', 'act'=>'log', 'op'=>'Admin'),
						//array('name' => 'SQL查询', 'act'=>'log', 'op'=>'Admin'),
				))
	)),
		
	'shop'=>array('name'=>'商城','child'=>array(
				array('name' => '商品','child' => array(
					array('name' => '商品分类', 'act'=>'categoryList', 'op'=>'Goods'),
					array('name' => '商品列表', 'act'=>'goodsList', 'op'=>'Goods'),
				//	array('name' => '库存日志', 'act'=>'stock_list', 'op'=>'Goods'),
					array('name' => '商品模型', 'act'=>'goodsTypeList', 'op'=>'Goods'),
					array('name' => '商品规格', 'act' =>'specList', 'op' => 'Goods'),
					array('name' => '品牌列表', 'act'=>'brandList', 'op'=>'Goods'),
					array('name' => '商品属性', 'act'=>'goodsAttributeList', 'op'=>'Goods'),
                                    
			)),
			array('name' => '订单','child'=>array(
					array('name' => '订单列表', 'act'=>'index', 'op'=>'Order'),
					array('name' => '发货单', 'act'=>'delivery_list', 'op'=>'Order'),
					array('name' => '退货单', 'act'=>'return_list', 'op'=>'Order'),
					array('name' => '添加订单', 'act'=>'add_order', 'op'=>'Order'),
			        array('name' => '订单日志','act'=>'order_log','op'=>'Order'),
			)),
	)),
		
	'mobile'=>array('name'=>'模板','child'=>array(
			array('name' => '设置','child' => array(
					array('name' => '模板设置', 'act'=>'templateList', 'op'=>'Template'),
					array('name' => '手机支付', 'act'=>'templateList', 'op'=>'Template'),
					array('name' => '微信二维码', 'act'=>'templateList', 'op'=>'Template'),
					array('name' => '第三方登录', 'act'=>'templateList', 'op'=>'Template'),
					array('name' => '导航管理', 'act'=>'finance', 'op'=>'Report'),
					array('name' => '广告管理', 'act'=>'finance', 'op'=>'Report'),
					array('name' => '广告位管理', 'act'=>'finance', 'op'=>'Report'),
			)),
	)),
		
	'resource'=>array('name'=>'插件','child'=>array(
			array('name' => '云服务','child' => array(
				array('name' => '插件库', 'act'=>'index', 'op'=>'Plugin'),
				//array('name' => '数据备份', 'act'=>'index', 'op'=>'Tools'),
				//array('name' => '数据还原', 'act'=>'restore', 'op'=>'Tools'),
			)),
	)),
);