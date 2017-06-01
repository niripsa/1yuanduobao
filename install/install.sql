/*
Navicat MySQL Data Transfer

Source Server         : SVN—MYSQL
Source Server Version : 50520
Source Host           : 192.168.1.250:3306
Source Database       : busy_demo_v4

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-04-20 19:04:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `_admin`
-- ----------------------------
DROP TABLE IF EXISTS `####_admin`;
CREATE TABLE `####_admin` (
  `mid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `gid` tinyint(3) unsigned NOT NULL COMMENT '所属角色id',
  `username` char(15) NOT NULL COMMENT '管理员名称',
  `userpass` char(32) NOT NULL COMMENT '管理员密码',
  `useremail` varchar(100) DEFAULT NULL COMMENT '管理员邮箱',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `logintime` int(10) unsigned DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(15) DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`mid`),
  KEY `username` (`username`) USING BTREE,
  KEY `mid` (`mid`),
  KEY `gid` (`gid`),
  KEY `addtime` (`addtime`),
  KEY `loginip` (`loginip`),
  KEY `userpass` (`userpass`),
  KEY `logintime` (`logintime`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台管理员';

-- ----------------------------
-- Records of go_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `_admin_group`
-- ----------------------------
DROP TABLE IF EXISTS `####_admin_group`;
CREATE TABLE `####_admin_group` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(15) DEFAULT NULL COMMENT '角色名',
  `ids` text COMMENT '权限ID列表',
  `auth_content` text COMMENT '拥有权限列表',
  `disabled` tinyint(1) DEFAULT '1' COMMENT '是否启用',
  `description` text COMMENT '角色描述',
  PRIMARY KEY (`gid`),
  KEY `gid` (`gid`),
  KEY `name` (`name`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台角色表';

-- ----------------------------
-- Records of go_admin_group
-- ----------------------------
INSERT INTO `####_admin_group` VALUES ('1', '超级管理员', 'all', 'all', '1', '具有所有权限，不可更改');
INSERT INTO `####_admin_group` VALUES ('2', '普通管理员', '3,34,35,36,37,38,39,41,40,42,43,44,45,46,47,48,49,50,51', 'goods-goods_add,goods-goods_list,cate-lists-goods,goods-brand_lists,goods-brand_add,,goods-cloud_goods_add,goods-cloud_goods_lists,,dingdan-lists,dingdan-select,dingdan-lists,dingdan-lists-notsend,,goods-goods_list-xianshi,,shaidan_admin-init', '0', '组名称描述');

-- ----------------------------
-- Table structure for `_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `####_admin_log`;
CREATE TABLE `####_admin_log` (
  `id` int(10) NOT NULL,
  `mid` int(10) DEFAULT NULL COMMENT '管理员id号',
  `mname` varchar(20) DEFAULT NULL COMMENT '管理员名称',
  `content` text COMMENT '操作记录',
  `ip` varchar(15) DEFAULT NULL COMMENT '操作IP',
  `time` int(10) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `id` (`id`),
  KEY `mname` (`mname`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理员（操作，登陆）日志表';

-- ----------------------------
-- Records of go_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for `_ad_area`
-- ----------------------------
DROP TABLE IF EXISTS `####_ad_area`;
CREATE TABLE `####_ad_area` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '广告位标题',
  `width` smallint(6) unsigned DEFAULT NULL COMMENT '广告位宽',
  `height` smallint(6) unsigned DEFAULT NULL COMMENT '广告位高',
  `des` varchar(255) DEFAULT NULL COMMENT '广告位说明',
  `checked` tinyint(1) DEFAULT '0' COMMENT '开启关闭',
  PRIMARY KEY (`aid`),
  KEY `checked` (`checked`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='广告位置表';

-- ----------------------------
-- Records of go_ad_area
-- ----------------------------

-- ----------------------------
-- Table structure for `_ad_contents`
-- ----------------------------
DROP TABLE IF EXISTS `####_ad_contents`;
CREATE TABLE `####_ad_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL COMMENT '所属广告位置表ID',
  `title` varchar(100) NOT NULL COMMENT '广告标题',
  `type` char(10) DEFAULT NULL COMMENT 'code,text,img（广告所属代码类型，仅限以上类型）',
  `content` text COMMENT '广告内容',
  `checked` tinyint(1) DEFAULT '0' COMMENT '是否启用',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `endtime` int(10) unsigned NOT NULL COMMENT '终止时间',
  `uid` tinyint(4) NOT NULL COMMENT '管理员',
  PRIMARY KEY (`id`),
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='广告内容表';

-- ----------------------------
-- Records of go_ad_contents
-- ----------------------------
INSERT INTO `####_ad_contents` VALUES ('3', '1', 'dsfsdfsd', 'img', 'banner/20150420/u826.png', '1', '1429459200', '1429718400', '0');
INSERT INTO `####_ad_contents` VALUES ('4', '2', 'fghjfghfgh', 'img', 'banner/20150420/u826.png', '1', '1428768000', '1429545600', '0');

-- ----------------------------
-- Table structure for `_article`
-- ----------------------------
DROP TABLE IF EXISTS `####_article`;
CREATE TABLE `####_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `cateid` char(30) NOT NULL COMMENT '文章父ID',
  `author` char(20) DEFAULT NULL COMMENT '作者',
  `title` char(100) NOT NULL COMMENT '标题',
  `title_style` varchar(100) DEFAULT NULL COMMENT '标题样式',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `picarr` text COMMENT '多图',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `url` varchar(250) DEFAULT NULL COMMENT '文章链接',
  `content` mediumtext COMMENT '内容',
  `hit` int(10) unsigned DEFAULT '0' COMMENT '点击量',
  `sort` tinyint(3) unsigned DEFAULT NULL COMMENT '排序',
  `posttime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `cateid` (`cateid`) USING BTREE,
  KEY `title` (`title`),
  KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='文章列表';

-- ----------------------------
-- Records of go_article
-- ----------------------------
INSERT INTO `####_article` VALUES ('1', '2', null, '了解云购', '', '', 'a:2:{i:0;s:33:\"photo/20130902/41484375056924.jpg\";i:1;s:33:\"photo/20130902/26578125056924.jpg\";}', null, null, null, '<p>	</p><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1元购买是一种新型的网购模式，只需1元就有可能买到一件商品。1元购买网把一件商品平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后抽出一名幸运者，该幸运者即可获得此商品。</p><h3 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">规则：</h3><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、每件商品参考市场价平分成相应“等份”，每份1元，1份对应1个购买码。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、同一件商品可以购买多次或一次购买多份。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3、当一件商品所有“等份”全部售出后计算出“幸运云购码”，拥有“幸运购买码”者即可获得此商品。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">4、幸运云购码计算方式：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0px 36px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: -1em; \">1）取该商品最后购买时间前网站所有商品100条购买时间记录（限时揭晓商品取截止时间前网站所有商品100条购买时间记录）。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; \">2）时间按时、分、秒、毫秒依次排列组成一组数值。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; \">3）将这100组数值之和除以商品总需参与人次后取余数，余数加上10,000,001即为“幸运购买码”。</p><h3 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">流程：</h3><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \"><strong style=\"margin: 0px; padding: 0px; \">1、挑选商品</strong></p><p style=\"margin-bottom: 15px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">分类浏览或直接搜索商品，点击“立即1元购买”。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \"><strong style=\"margin: 0px; padding: 0px; \">2、支付1元</strong></p><p style=\"margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">通过在线支付平台，支付1元即购买1人次，获得1个“购买码”。同一件商品可购买多次或一次购买多份，购买的“购买码”越多，获得商品的几率越大。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \"><strong style=\"margin: 0px; padding: 0px; \">3、揭晓获得者</strong></p><p style=\"margin-bottom: 15px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">当一件商品达到总参与人次，抽出1名商品获得者，1元云购网会通过手机短信或邮件通知您领取商品。</p><h3 style=\"margin: 0px; padding: 0px 0px 0px 22px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">注：</h3><p style=\"margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; \">1）商品揭晓后您可登录&quot;我的1元购买&quot;查询详情，未获得商品的用户不会收到短信或邮件通知；</p><p style=\"margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; \">2）商品揭晓后，请及时登录&quot;我的1元购买&quot;完善个人资料，以便我们能够准确无误地为您配送商品。</p><p style=\"margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; \">3）所有已揭晓商品均不给予退款</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \"><strong style=\"margin: 0px; padding: 0px; \">4、晒单分享</strong><br style=\"margin: 0px; padding: 0px; \"/></p><p style=\"margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">晒出您收到的商品实物图片甚至您的靓照，说出您的云购心得，让大家一起分享您的快乐。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">在您收到商品后，您只需登录网站完成晒单，并通过审核，即可获得1000福分奖励。在您成功晒单后，您的晒单会出现在网站&quot;晒单分享&quot;区，与大家分享喜悦。</p><p><br/></p>', '1', '2', '1375862513');
INSERT INTO `####_article` VALUES ('2', '2', '', '常见问题', '', '', 'a:0:{}', '', '', null, '<p>	</p><p><strong>01、怎样查看我参与的商品有没有中奖？</strong></p><p>每件商品开奖结果公布之后，登录云购网，进入&quot;会员中心&quot;，在&quot;中奖商品&quot;中即可查询中奖情况。</p><p><br/></p><p><strong>2、我获得了商品，我还需要支付其他费用吗？</strong></p><p>不需要支付其他任何费用。</p><p><br/></p><p><strong>3、当我获得商品以后我该做什么？</strong></p><p>在您获得商品后您会收到站内信、短信和电子邮件的通知。在这之后，您必须在“会员中心”正确填写、真实的收货地址，完善或确认您的个人信息。我们会在您获得商品后3个工作日内通过电话方式与您取得联系。</p><p><br/></p><p><strong>4、云购网的商品是正品吗？怎么保证？</strong></p><p>云购网承诺，所有商品100%正品，可享受厂家所提供的全国联保服务，享受商品的保修、换货和退货的义务（国家三包政策）。</p><p><br/></p><p><strong>5、如何晒单分享？</strong></p><p>在您收到商品后，登录云购网，进入&quot;会员中心&quot;，在“商品晒单”区发布晒单信息，通过审核后，您还可获得1000积分奖励。在您成功晒单后，您的晒单会出现在网站“晒单分享”区，与大家分享喜悦。</p><p><br/></p><p><strong>6、我收到的商品可以换货或者退货吗？</strong></p><p>非质量问题，不在三包范围内，不给予退换货。</p><p><br/></p><p><strong>7、参与2元云购需要注意什么？</strong></p><p>请务必正确填写真实有效的联系电话、收货地址以便在您中奖时能及时与您取得联系。</p><p><br/></p><p><strong>8、网上银行充值未及时到帐怎么办？</strong></p><p>网上支付未及时到帐可能有以下几个原因造成：</p><p>第一，由于网速或者支付接口等问题，支付数据没有及时传送到支付系统造成的；</p><p>第二，网速过慢，数据传输超时，使银行后台支付信息不能成功对接，导致银行交易成功而支付后台显示失败；</p><p>第三，在网上支付如果使用某些防火墙软件，有时会屏蔽银行接口的弹出窗口，这时会造成在银行那边被扣费，但在我们网站上显示尚未支付。但请您放心，每天我们都会根据银行系统的帐务明细清单对前一天的订单进行逐笔核对，如遇问题订单，我们会做手工添加。</p><p><br/></p><p><strong>9、支付宝付款成功但是商品未购买成功怎么办？</strong><br/></p><p>失败原因:未等待支付宝同步返回，订单处理失败.&nbsp;</p><p>解决办法:请直接联系客服处理，告知客户支付宝交易号。</p><p><br/></p><p><strong>如您对我们“帮助中心”的说明有任何疑问或建议请告诉我们</strong></p><p><br/></p>', '0', '3', '1375862591');
INSERT INTO `####_article` VALUES ('3', '2', null, '服务协议', null, null, 'a:0:{}', null, null, null, '<p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">&nbsp; 欢迎您访问并使用充满互动乐趣的购物网站-云购(<a title=\"\" href=\"http://www.1ygm.com/\" target=\"_self\" textvalue=\"www.1ygm.com\" style=\"margin: 0px; padding: 0px; color: rgb(51, 51, 51); text-decoration: none; \">www.yungoucms.c</a>n)，作为为用户提供全新、有趣购物模式的互联网公司，云购通过在线网站为您提供各项相关服务。当使用云购的各项具体服务时，您和云购都将受到本服务协议所产生的制约，云购会不断推出新的服务，因此所有服务都将受此服务条款的制约。请您在注册前务必认真阅读此服务协议的内容并确认，如有任何疑问，应向云购咨询。一旦您确认本服务协议后，本服务协议即在用户和云购之间产生法律效力。您在注册过程中点击“同意以下条款提交注册信息”按钮即表示您完全接受本协议中的全部条款。随后按照页面给予的提示完成全部的注册步骤。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">云购将可能不定期的修改本服务协议的有关条款，并保留在必要时对此协议中的所有条款进行随时修改的权利。一旦协议内容有所修改，云购将会在网站重要页面或社区的醒目位置第一时间给予通知。如果您继续使用云购的服务，则视为您受协议的改动内容。如果不同意本站对协议内容所做的修改，云购会及时取消您的服务使用权限。本站保留随时修改或中断服务而不需告知用户的权利。本站行使修改或中断服务的权利，不需对用户或第三方负责。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">一、用户注册</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、用户注册是指用户登录云购，按要求填写相关信息并确认同意本服务协议的过程。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、云购用户必须是具有完全民事行为能力的自然人，或者是具有合法经营资格的实体组织。无民事行为能力人、限制民事行为能力人以及无经营或特定经营资格的组织不得注册为云购用户或超过其民事权利或行为能力范围与1元购买进行交易，如与云购进行交易的，则服务协议自始无效，云购有权立即停止与该用户的交易、注销该用户账户，并有权要求其承担相应法律责任。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">二、用户的帐号，密码和安全性</h4><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">用户一旦注册成功，成为本站的合法用户。用户将对用户名和密码安全负全部责任。此外，每个用户都要对以其用户名进行的所有活动和事件负全责。用户若发现任何非法使用用户帐号或存在安全漏洞的情况，请立即通告本站。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">三、1元购买原则</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">平等原则：用户和云购在交易过程中具有同等的法律地位。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">自由原则：用户享有自愿向云购参与购买商品的权利，任何人不得非法干预。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">公平原则：用户和云购行使权利、履行义务应当遵循公平原则。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">诚实信用原则：用户和云购行使权利、履行义务应当遵循诚实信用原则。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">履行义务原则：用户向云购参与商品分享购买时，用户和云购皆有有义务根据本服务协议的约定完成该等交易（法律或本协议禁止的交易除外）</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">四、用户的权利和义务</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、用户有权拥有其在云购的用户名及密码，并用该用户名和密码登录云购参与商品购买。用户不得以任何形式转让或授权他人使用自己的云购用户名。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、用户有权根据本协议的规定以及云购网站上发布的相关规则在云购上查询商品信息、发表使用体验、参与商品讨论、邀请关注好友、上传商品图片、参加云购的有关活动，以及享受1元购买提供的其它信息服务</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3、用户有义务在注册时提供自己的真实资料，并保证诸如电子邮件地址、联系电话、联系地址、邮政编码等内容的有效性及真实性，保证1元购买可以通过上述联系方式与用户本人进行联系。同时，用户也有义务在相关资料发生变更时及时更新有关注册资料。用户保证不以他人资料在1元购买进行注册和参与商品分享购买。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">4、用户应当保证在云购参与商品分享购买时遵守诚实信用原则，不扰乱网上交易的正常秩序。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">5、用户在成为云购的会员后，可按云购的福分规则享受福分获得。累积福分可用于福分商城中的相应福分商品兑换。福分规则连同与该规则相关的条款和条件，构成用户与云购之间的完整协议。接受本协议，即表明接受福分规则中的条款和条件。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">6、用户享有言论自由权利；并拥有适度修改、删除自己发表的文章的权利用户不得在云购发表包含以下内容的言论：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1) 反对宪法所确定的基本原则，煽动、抗拒、破坏宪法和法律、行政法规实施的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2) 煽动颠覆国家政权，推翻社会主义制度，煽动、分裂国家，破坏国家统一的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3) 损害国家荣誉和利益的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">4) 煽动民族仇恨、民族歧视，破坏民族团结的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">5) 任何包含对种族、性别、宗教、地域内容等歧视的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">6) 捏造或者歪曲事实，散布谣言，扰乱社会秩序的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">7) 宣扬封建迷信、邪教、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">8) 公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">9) 损害国家机关信誉的；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">10) 其他违反宪法和法律行政法规的。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">7、用户在发表使用体验、讨论图片等，除遵守本条款外，还应遵守该讨论区的相关规定。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">8、未经1元购买同意，禁止用户在网站发布任何形式的广告。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">五、1元购买的权利和义务</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、云购有义务在现有技术上维护整个网上交易平台的正常运行，并努力提升和改进技术，使用户网上交易活动得以顺利进行；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、对用户在注册和使用云购网上交易平台中所遇到的与交易或注册有关的问题及反映的情况，云购应及时作出回复；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3、对于用户在云购网站上作出下列行为的，云购有权作出删除相关信息、终止提供服务等处理，而无须征得用户的同意：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1) 云购有权对用户的注册信息及购买行为进行查阅，发现注册信息或购买行为中存在任何问题的，有权向用户发出询问及要求改正的通知或者作出删除等处理；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2) 用户违反本协议规定或有违反法律法规和地方规章的行为的，云购有权停止传输并删除其信息，禁止用户发言，注销用户账户并按照相关法律规定向相关主管部门进行披露。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3) 对于用户在云购进行的下列行为，云购有权对用户采取删除其信息、禁止用户发言、注销用户账户等限制性措施：包括发布或以电子邮件或以其他方式传送存在恶意、虚假和侵犯他人人身财产权利内容的信息，进行与分享购物无关或不是以分享购物为目的的活动，恶意注册、签到、评论等方式试图扰乱正常购物秩序，将有关干扰、破坏或限制任何计算机软件、硬件或通讯设备功能的软件病毒或其他计算机代码、档案和程序之资料，加以上载、发布、发送电子邮件或以其他方式传送，干扰或破坏1元购买网站和服务或与1元购买网站和服务相连的服务器和网络，或发布其他违反公共利益或可能严重损害1元购买和其它用户合法利益的信息。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">4、用户在此免费授予云购永久性的独家使用权(并有权对该权利进行再授权)，使云购有权在全球范围内(全部或部分地)使用、复制、修订、改写、发布、翻译和展示用户公示于云购网站的各类信息，或制作其派生作品，和或以现在已知或日后开发的任何形式、媒体或技术，将上述信息纳入其它作品内。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">5、对于云购网络平台已上架商品，云购有权根据市场变动修改商品价格，而无需提前通知客户。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">6、云购分享购物模式，秉着双方自愿原则，分享购物存在风险，云购不对抽取的“幸运编号”结果承担责任，望所有用户谨慎参与。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">7、90天未达到“总需参与人次”的商品，用户可通过客服申请退款，所退款项将在3个工作日内，退还至购买账户中。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">六、配送及费用</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">云购将会把产品送到您所指定的送货地址。全国免费配送（港澳台地区除外）。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">请清楚准确地填写您的真实姓名、送货地址及联系方式。因如下情况造成配送延迟或无法配送等，本站将不承担责任：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、客户提供错误信息和不详细的地址；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、货物送达无人签收，由此造成的重复配送所产生的费用及相关的后果。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3、不可抗力，例如：自然灾害、交通戒严、突发战争等。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">七、商品缺货规则</h4><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">用户通过参与云购所获得的商品如果发生缺货，用户和云购皆有权取消该交易，所花费的款云购将全部返还。或云购对缺货商品进行预售登记，云购会尽最大努力在最快时间内满足用户的购买需求，当缺货商品到货，云购将第一时间通过邮件、短信或电话通知用户，方便用户进行购买。预售登记并不做交易处理，不构成要约。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">八、责任限制</h4><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">在法律法规所允许的限度内，因使用云购服务而引起的任何损害或经济损失，云购承担的全部责任均不超过用户所购买的与该索赔有关的商品价格。这些责任限制条款将在法律所允许的最大限度内适用，并在用户资格被撤销或终止后仍继续有效。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">九、网络服务内容的所有权</h4><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">本站定义的网络服务内容包括：文字、软件、声音、图片、录象、图表、广告中的全部内容；电子邮件的全部内容；本站为用户提供的其他信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在本站和广告商授权下才能使用这些内容，而不能擅自复制、再造这些内容、或创造与内容有关的派生产品。本站所有的文章版权归原文作者和本站共同所有，任何人需要转载本站的文章，必须征得原文作者或本站授权。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">十、用户隐私制度</h4><p class=\"textindent\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">我们不会向任何第三方提供，出售，出租，分享和交易用户的个人信息。当在以下情况下，用户的个人信息将部分或全部被善意披露：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、经用户同意，向第三方披露；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、如用户是合资格的知识产权投诉人并已提起投诉，应被投诉人要求，向被投诉人披露，以便双方处理可能的权利纠纷；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3、根据法律的有关规定，或者行政或司法机构的要求，向第三方或者行政、司法机构披露；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">4、如果用户出现违反中国有关法律或者网站政策的情况，需要向第三方披露；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">5、为提供你所要求的产品和服务，而必须和第三方分享用户的个人信息；</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">6、其它本站根据法律或者网站政策认为合适的披露。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">十一、法律管辖和适用</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">1、本协议的订立、执行和解释及争议的解决均应适用中国法律。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">2、如发生本站服务条款与中国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它合法条款则依旧保持对用户产生法律效力和影响。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">3、本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; \">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">4、如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向本站所在地的人民法院提起诉讼。</p><p><br/></p>', '0', '0', '1375862644');
INSERT INTO `####_article` VALUES ('4', '3', null, '购保障体系', null, null, 'a:0:{}', null, null, null, '<p>	</p><p><br/></p><p><br/></p><h4 class=\"mat0\" style=\"margin: 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">100%正品保证</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">云购精心挑选优质服务品牌商家，保障全场商品100%品牌正品。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">100%公平公正</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">整个过程是完全透明，您可以随时查看每件商品参与人数，参与次数，参与名单及中奖信息等记录。</p><h4 style=\"margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; \">全国免费快递</h4><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; \">云购承诺全场所有商品全国免费快递。（港澳台地区除外）</p><p><br/></p>', '0', '0', '1375862690');
INSERT INTO `####_article` VALUES ('5', '3', null, '正品保障', null, null, 'a:0:{}', null, null, null, '<p>	</p><p class=\"textindent\">云购严格控制供应渠道，全部商品均从品牌官方以及品牌经销商直接采购供货，并取得品牌官方网络销售授权书，如果您认为云购的商品是假货，并能提供国家\r\n相关质检机构的证明文件，经确认后，在返还商品金额的同时并提供假一赔十服务保障。为了保障您的利益，对云购的商品，做如下说明：</p><p><br/></p><p class=\"bottom-space16px\">1、云购对所有商品均保证正品行货，正规渠道发货，所有商品都可以享受生产厂家的全国联保服务，按照国家三包政策，针对所售商品履行保修、换货和退货的义务。</p><p><br/></p><p class=\"bottom-space16px\">2、出现国家三包所规定的功能性故障时，经由生产厂家指定或特约售后服务中心检测确认故障属实，您可以选择换货或者维修；超过15日且在保修期内，您只能\r\n在保修期内享受免费维修服务。为了不耽误您使用，缩短故障商品的维修时间，我们建议您直接联系生产厂家售后服务中心进行处理。您也可以直接在商品的保修卡\r\n中查找该商品对应的全国各地生产厂家售后服务中心联系处理。</p><p><br/></p><p class=\"bottom-space16px\">3、云购真诚提醒广大幸运者在您收到商品的时候，请尽量亲自签收并当面拆箱验货，如果有问题(运输途中的损坏)请不要签收!与快递员交涉，拒签，退回!</p><p><br/></p><p class=\"bottom-space16px\">4、在收到商品后发现有质量问题，请您不要私自处理，妥善保留好原包装，第一时间联系云购客服人员，由云购同发货商城协商在48小时内解决。如有破损或丢失，我们将无法为您办理退货。</p><p><br/></p><p class=\"textindent\">如对协商处理结果存在异议，请您自行到当地生产厂家售后服务中心进行检测，并开据正规检测报告（对于有些生产厂家售后服务中心无法提供检测报告的，需提供\r\n维修检验单据），如果检测报告确认属于质量问题，然后将检测报告、问题商品及完整包装附件，一并返还发货商城办理换货手续，产生的相关费用由云购追究\r\n相关责任方承担。</p><p><br/></p><p class=\"textindent\">云购上的电子产品及配件因为生成工艺或仓储物流原因，可能会存在收到或使用过程中出现故障的几率，云购不能保证所有的商品都没有故障，但我们保证\r\n所售商品都是全新正品行货，能够提供正规的售后保障。我们保证商品的正规进货渠道和质量，如果您对收到的商品质量表示怀疑，请提供生产厂家或官方出具的书\r\n面鉴定，我们会按照国家法律规定予以处理。但对于任何欺诈性行为，云购将保留依法追究法律责任的权利。</p><p><br/></p>', '0', '0', '1375862702');
INSERT INTO `####_article` VALUES ('6', '3', null, '安全支付', null, null, 'a:0:{}', null, null, null, '<p>&nbsp; 云购作为平安银行、网银在线、快钱、银联在线支付、财付通的认证商家，严格遵循网络购物的安全准则，通过网银在线、快钱、银联在线支付、财付通等安全度高的支付方式，充分保证您在线支付的安全性。</p>', '0', '0', '1375862712');
INSERT INTO `####_article` VALUES ('7', '4', null, '商品配送', null, null, 'a:0:{}', null, null, null, '<p>&nbsp;&nbsp; 所有商品全国免费配送。（港澳地区除外）</p>', '0', '0', '1375862725');
INSERT INTO `####_article` VALUES ('8', '4', null, '配送费用', null, null, 'a:0:{}', null, null, null, '<p>&nbsp;&nbsp; 所有商品全国免费配送。（港澳地区除外）</p>', '0', '0', '1375862737');
INSERT INTO `####_article` VALUES ('9', '4', null, '商品验货与签收', null, null, 'a:0:{}', null, null, null, '<p class=\"bottom-space16px\">1、您在签收商品时请慎重，请尽量不要让人代签，并务必先仔细检查商品（外包装是否被开封、商品是否破损、配件是否缺失、功能是否正常），确保无误后再签\r\n收，以免产生不必要的纠纷。若有任何疑问，请及时拨打客服电话反馈信息。若因用户未仔细检查商品即签收后产生的纠纷，云购概不负责，仅承担协调处理的\r\n义务。</p><p>	</p><p class=\"bottom-space16px\">2、若因您的地址填写错误、联系方式填写有误等情况造成商品无法完成投递或被退回，所产生的额外费用及后果由用户负责。</p><p>	</p><p>3、如因不可抗拒的自然原因（地震、洪水等等）所造成的商品配送延迟，云购不承担责任。</p><p>	</p><h4>温馨提醒</h4><p class=\"textindent\">若您或您的委托人已签收，则说明订单商品正确无误且不存在影响使用的因素，云购有权不受理因包装或商品破损、商品错漏发、商品表面质量问题、商品附带品及赠品少发为由的换货申请。</p><p><br/></p>', '0', '0', '1375862747');
INSERT INTO `####_article` VALUES ('10', '4', null, '长时间未收到商品', null, null, 'a:0:{}', null, null, null, '<p>长时间未收到商品可能出现的问题：</p><p>1、请您确保您的收货地址、邮编、电话、Email地址等各项信息的准确性，以便商品及时、准确地发出。</p><p>2、配送过程中如果我们联络您的时间超过7天未得到回复，此商品将被默认为您已经放弃。</p><p><br/></p>', '0', '0', '1375862760');
INSERT INTO `####_article` VALUES ('11', '3', null, '隐私声明', null, null, 'a:0:{}', null, null, null, '<p>	</p><p>欢迎使用云购系统</p><p>隐私声明</p>', '0', '1', '1378451819');
INSERT INTO `####_article` VALUES ('18', '18', null, '基金的建立', null, null, 'a:0:{}', null, null, null, '<p>云购基金是YunGouCMS — 惊喜无线创始人发起成立的以公益事业为主要方向的爱心基金。云购基金本着“我为人人，人人为我”的社会责任，向需要帮助的困难人们提供爱心捐助。</p>', '0', null, '1378451819');
INSERT INTO `####_article` VALUES ('19', '18', null, '基金筹款办法', null, null, 'a:0:{}', null, null, null, '<p>每位在YunGouCMS — 惊喜无线进行分享购物的朋友，您的每次参与都将是为我们的公益事业做出一份贡献。当您每参与1人次云购，将由1元云购出资为云购基金筹款0.01元，所筹款项将全部用于云购基金。</p>', '0', null, '1378451819');
INSERT INTO `####_article` VALUES ('20', '18', null, '基金的去向', null, null, 'a:0:{}', null, null, null, '<p>云购基金将会以第1种途径或第2种途径进行使用：<br/>	1、YunGouCMS — 惊喜无线全体员工将组织向身边的公益事业进行捐赠与关怀活动。活动内容包括：资金、所需用品以及探望与协助等，每次捐赠与关怀活动结束后云购基金将公布活动详情以及基金详细使用报告。<br/>	2、云购基金通过腾讯公益或壹基金等公益组织进行爱心捐赠。</p>', '0', null, '1378451819');

-- ----------------------------
-- Table structure for `_brand`
-- ----------------------------
DROP TABLE IF EXISTS `####_brand`;
CREATE TABLE `####_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` varchar(255) DEFAULT NULL COMMENT '所属栏目ID',
  `status` char(1) DEFAULT 'Y' COMMENT '显示隐藏',
  `name` varchar(255) DEFAULT NULL COMMENT '品牌名',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `url` varchar(255) DEFAULT NULL COMMENT ' 品牌链接',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `status` (`status`) USING BTREE,
  KEY `order` (`sort`) USING BTREE,
  KEY `cateid` (`cateid`),
  KEY `name` (`name`),
  KEY `url` (`url`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Records of go_brand
-- ----------------------------
INSERT INTO `####_brand` VALUES ('1', '5', 'Y', '联想', '', '', '16');
INSERT INTO `####_brand` VALUES ('2', '5', 'Y', '诺基亚', '', '', '2');
INSERT INTO `####_brand` VALUES ('3', '13', 'Y', '苹果', '', '', '1');
INSERT INTO `####_brand` VALUES ('4', '13', 'Y', '三星', '', '', '14');
INSERT INTO `####_brand` VALUES ('6', '12', 'Y', '小米', '', '', '1');
INSERT INTO `####_brand` VALUES ('7', '12', 'Y', 'oppo', '', '', '1');
INSERT INTO `####_brand` VALUES ('8', '42', 'Y', 'HTC', '', '', '15');
INSERT INTO `####_brand` VALUES ('10', '43', 'Y', '海尔', '', '', '1');
INSERT INTO `####_brand` VALUES ('11', '41', 'Y', '美的', '', '', '1');
INSERT INTO `####_brand` VALUES ('12', '41', 'Y', '台电', '', '', '13');
INSERT INTO `####_brand` VALUES ('13', '12', 'Y', '尼康', '', '', '3');
INSERT INTO `####_brand` VALUES ('14', '40,5', 'Y', '华为', '', '', '1');

-- ----------------------------
-- Table structure for `_cate`
-- ----------------------------
DROP TABLE IF EXISTS `####_cate`;
CREATE TABLE `####_cate` (
  `cateid` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `parentid` smallint(6) DEFAULT NULL COMMENT '栏目父ID',
  `cids` varchar(100) DEFAULT NULL,
  `channel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '频道',
  `html` tinyint(4) DEFAULT NULL,
  `typeid` tinyint(1) DEFAULT NULL,
  `model` tinyint(1) DEFAULT NULL COMMENT '栏目模型',
  `name` varchar(255) DEFAULT NULL COMMENT '栏目名称',
  `catdir` char(20) DEFAULT NULL COMMENT '英文名',
  `url` varchar(255) DEFAULT NULL COMMENT 'l栏目链接',
  `info` text COMMENT '栏目配置(关键字，说明)',
  `sort` smallint(6) unsigned DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`cateid`),
  KEY `name` (`name`) USING BTREE,
  KEY `cateid` (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `cids` (`cids`),
  KEY `sort` (`sort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of go_cate
-- ----------------------------
INSERT INTO `####_cate` VALUES ('1', '0', '0,', '0', '0', '1', '2', '帮助', 'help', '', 'a:9:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:0:\"\";s:7:\"content\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:13:\"template_list\";s:22:\"article_list.list.html\";s:13:\"template_show\";s:22:\"article_show.show.html\";}', '1');
INSERT INTO `####_cate` VALUES ('2', '1', '0,1,2,', '0', '0', '1', '2', '新手指南', 'xinshouzhinan', '', 'a:9:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";N;s:7:\"content\";N;s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:13:\"template_list\";s:22:\"article_list.list.html\";s:13:\"template_show\";s:22:\"article_show.help.html\";}', '1');
INSERT INTO `####_cate` VALUES ('3', '1', '0,1,3,', '0', '0', '1', '2', '云购保障', 'yunbaozhang', '', 'a:9:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:30:\"司法所发射点发射得分\";s:8:\"template\";N;s:7:\"content\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:13:\"template_list\";s:22:\"article_list.list.html\";s:13:\"template_show\";s:22:\"article_show.help.html\";}', '1');
INSERT INTO `####_cate` VALUES ('4', '1', '0,1,4,', '0', '0', '1', '2', '商品配送', 'peisong', '', 'a:9:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";N;s:7:\"content\";N;s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:13:\"template_list\";s:22:\"article_list.list.html\";s:13:\"template_show\";s:22:\"article_show.help.html\";}', '3');
INSERT INTO `####_cate` VALUES ('5', '0', '0,', '0', '0', '1', '1', '手机平板', 'shoujipingban', '', 'a:4:{s:10:\"meta_title\";s:12:\"手机平板\";s:13:\"meta_keywords\";s:12:\"手机平板\";s:16:\"meta_description\";s:12:\"手机平板\";s:5:\"thumb\";s:29:\"photo/20150420/3a2f4e7671.png\";}', '6');
INSERT INTO `####_cate` VALUES ('7', '0', '0,', '0', '0', '-1', '3', '新手指南', 'newbie', '', 'a:7:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:22:\"single_web.newbie.html\";s:7:\"content\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";}', '1');
INSERT INTO `####_cate` VALUES ('8', '0', '0,', '0', '0', '-1', '3', '合作专区', 'business', '', 'a:7:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:24:\"single_web.business.html\";s:7:\"content\";s:34:\"<p>输入栏目内容...567678</p>\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";}', '1');
INSERT INTO `####_cate` VALUES ('9', '0', '0,', '0', '0', '-1', '3', '友情链接', 'link', '', 'a:7:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:20:\"single_web.link.html\";s:7:\"content\";s:34:\"<p>输入栏目内容...567678</p>\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";}', '1');
INSERT INTO `####_cate` VALUES ('10', '0', '0,', '0', '0', '-1', '3', '云购QQ群', 'qqgroup', '', 'a:7:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:23:\"single_web.qqgroup.html\";s:7:\"content\";s:40:\"PHA+6L6T5YWl5qCP55uu5YaF5a65Li4uPC9wPg==\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";}', '1');
INSERT INTO `####_cate` VALUES ('11', '0', '0,', '0', '0', '-1', '3', '邀请注册', 'pleasereg', '', 'a:7:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:25:\"single_web.pleasereg.html\";s:7:\"content\";s:28:\"<p>输入栏目内容...</p>\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";}', '1');
INSERT INTO `####_cate` VALUES ('12', '0', '0,', '0', '0', '1', '1', '数码影像', 'shuma', '', 'a:4:{s:10:\"meta_title\";s:12:\"数码影像\";s:13:\"meta_keywords\";s:12:\"数码影像\";s:16:\"meta_description\";s:12:\"数码影像\";s:5:\"thumb\";s:29:\"photo/20150420/c3f0757ebc.png\";}', '3');
INSERT INTO `####_cate` VALUES ('13', '0', '0,', '0', '0', '1', '1', '电脑', 'diannao', '', 'a:4:{s:10:\"meta_title\";s:6:\"电脑\";s:13:\"meta_keywords\";s:6:\"电脑\";s:16:\"meta_description\";s:6:\"电脑\";s:5:\"thumb\";s:29:\"photo/20150420/1a291d65a4.png\";}', '5');
INSERT INTO `####_cate` VALUES ('18', '1', '', '0', '0', '1', '2', '云购基金', 'jijin', '', 'a:9:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:0:\"\";s:7:\"content\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:13:\"template_list\";s:22:\"article_list.list.html\";s:13:\"template_show\";s:22:\"article_show.help.html\";}', '2');
INSERT INTO `####_cate` VALUES ('23', '0', null, '0', null, '1', '2', '官方公告', 'notice', null, 'a:7:{s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:13:\"template_list\";s:0:\"\";s:13:\"template_show\";s:25:\"article_show.gonggao.html\";}', '3');
INSERT INTO `####_cate` VALUES ('38', '0', '', '0', '0', '-1', '3', '邀请', 'pleasereg', null, 'a:7:{s:5:\"thumb\";s:0:\"\";s:3:\"des\";s:0:\"\";s:8:\"template\";s:20:\"single_web.pleasereg.html\";s:7:\"content\";s:28:\"<p>输入栏目内容...</p>\";s:10:\"meta_title\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";}', '1');
INSERT INTO `####_cate` VALUES ('39', '0', null, '0', '0', '1', '1', '女性时尚', 'Womensfashion', null, 'a:4:{s:10:\"meta_title\";s:12:\"女性时尚\";s:13:\"meta_keywords\";s:12:\"女性时尚\";s:16:\"meta_description\";s:12:\"女性时尚\";s:5:\"thumb\";s:29:\"photo/20150420/85173d4299.png\";}', '1');
INSERT INTO `####_cate` VALUES ('40', '0', null, '0', '0', '1', '1', '饮食天地', 'diet', null, 'a:4:{s:10:\"meta_title\";s:12:\"饮食天地\";s:13:\"meta_keywords\";s:12:\"饮食天地\";s:16:\"meta_description\";s:12:\"饮食天地\";s:5:\"thumb\";s:29:\"photo/20150420/11c8ad00bd.png\";}', '1');
INSERT INTO `####_cate` VALUES ('41', '0', null, '0', '0', '1', '1', '潮流新品', 'Newtrend', null, 'a:4:{s:10:\"meta_title\";s:12:\"潮流新品\";s:13:\"meta_keywords\";s:12:\"潮流新品\";s:16:\"meta_description\";s:12:\"潮流新品\";s:5:\"thumb\";s:29:\"photo/20150420/db0f5b25c0.png\";}', '1');
INSERT INTO `####_cate` VALUES ('42', '0', null, '0', '0', '1', '1', '综合购物', 'Integratedshopping', null, 'a:4:{s:10:\"meta_title\";s:12:\"综合购物\";s:13:\"meta_keywords\";s:12:\"综合购物\";s:16:\"meta_description\";s:12:\"综合购物\";s:5:\"thumb\";s:29:\"photo/20150420/0e9e8d36a6.png\";}', '1');
INSERT INTO `####_cate` VALUES ('43', '0', null, '0', '0', '1', '1', '其他商品', 'Othercommodities', null, 'a:4:{s:10:\"meta_title\";s:12:\"其他商品\";s:13:\"meta_keywords\";s:12:\"其他商品\";s:16:\"meta_description\";s:12:\"其他商品\";s:5:\"thumb\";s:29:\"photo/20150420/beff3baed5.png\";}', '1');

-- ----------------------------
-- Table structure for `_cloud_codes_1`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_codes_1`;
CREATE TABLE `####_cloud_codes_1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cg_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `cg_cid` smallint(5) unsigned NOT NULL COMMENT '云购码存储条数',
  `cg_len` smallint(5) DEFAULT NULL COMMENT '云购码剩余长度',
  `cg_codes` text COMMENT '商品剩余云购码',
  `cg_codes_tmp` text COMMENT '商品全部云购码',
  PRIMARY KEY (`id`),
  KEY `s_id` (`cg_id`) USING BTREE,
  KEY `s_cid` (`cg_cid`) USING BTREE,
  KEY `s_len` (`cg_len`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1998 DEFAULT CHARSET=utf8 COMMENT='云购码记录表及结构表';

-- ----------------------------
-- Records of go_cloud_codes_1
-- ----------------------------

-- ----------------------------
-- Table structure for `_cloud_g`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_g`;
CREATE TABLE `####_cloud_g` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for `_cloud_goods`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_goods`;
CREATE TABLE `####_cloud_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) unsigned NOT NULL COMMENT '商品表id',
  `price` decimal(10,2) unsigned DEFAULT '1.00' COMMENT '云购单份价格',
  `zongrenshu` int(10) unsigned DEFAULT '0' COMMENT '总需人数',
  `canyurenshu` int(10) unsigned DEFAULT '0' COMMENT '已参与人数',
  `shenyurenshu` int(10) unsigned DEFAULT NULL COMMENT '剩余人数',
  `qishu` smallint(6) unsigned DEFAULT '1' COMMENT '期数',
  `maxqishu` smallint(5) unsigned DEFAULT '1' COMMENT ' 最大期数',
  `codes_table` char(20) DEFAULT NULL COMMENT '云购码所属表',
  `record_table` varchar(25) DEFAULT NULL,
  `xsjx_time` int(10) unsigned DEFAULT NULL COMMENT '限时揭晓时间',
  `time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `q_uid` int(10) unsigned DEFAULT NULL COMMENT '中奖人ID',
  `q_user` text COMMENT '中奖人信息',
  `q_user_code` char(20) DEFAULT NULL COMMENT '中奖码',
  `q_content` mediumtext COMMENT '揭晓内容',
  `q_counttime` char(20) DEFAULT NULL COMMENT '总时间相加',
  `q_end_time` char(20) DEFAULT NULL COMMENT '最后购买时间',
  `q_external_time` char(20) DEFAULT NULL COMMENT '最后揭晓时间',
  `q_showtime` char(1) DEFAULT 'N' COMMENT 'Y/N揭晓动画的状态',
  `q_external_code` char(20) DEFAULT NULL COMMENT '开奖外部数据采集',
  `q_external_content` varchar(255) DEFAULT NULL COMMENT '外部数据采集内容',
  PRIMARY KEY (`id`),
  KEY `price` (`price`) USING BTREE,
  KEY `q_uid` (`q_uid`) USING BTREE,
  KEY `shenyurenshu` (`shenyurenshu`) USING BTREE,
  KEY `q_showtime` (`q_showtime`) USING BTREE,
  KEY `gid` (`gid`),
  KEY `id` (`id`),
  KEY `q_end_time` (`q_end_time`),
  KEY `qishu` (`qishu`),
  KEY `zongrenshu` (`zongrenshu`),
  KEY `canyurenshu` (`canyurenshu`),
  KEY `time` (`time`),
  KEY `q_user_code` (`q_user_code`),
  KEY `q_counttime` (`q_counttime`)
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8 COMMENT='云购商品列表';

-- ----------------------------
-- Records of go_cloud_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `_cloud_id`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_id`;
CREATE TABLE `####_cloud_id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of go_cloud_id
-- ----------------------------


-- ----------------------------
-- Table structure for `_cloud_info`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_info`;
CREATE TABLE `####_cloud_info` (
  `oid` int(11) unsigned NOT NULL,
  `ogid` int(11) DEFAULT NULL,
  `ogocode` longtext,
  `oremark` varchar(500) DEFAULT NULL,
  `otext` text COMMENT '订单附加信息',
  KEY `oid` (`oid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单附表';

-- ----------------------------
-- Records of go_cloud_info
-- ----------------------------

-- ----------------------------
-- Table structure for `_cloud_order`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_order`;
CREATE TABLE `####_cloud_order` (
  `oid` int(10) unsigned NOT NULL,
  `ogid` int(11) DEFAULT NULL COMMENT '订单类型(1充值订单,2商品订单,3云购订单,其他)',
  `og_title` varchar(200) DEFAULT NULL,
  `oqishu` smallint(6) DEFAULT NULL,
  `ouid` int(10) unsigned NOT NULL COMMENT '会员id',
  `ou_name` varchar(50) DEFAULT NULL,
  `ocode` char(20) NOT NULL COMMENT '订单号',
  `omoney` decimal(10,2) unsigned NOT NULL COMMENT '订单金额',
  `ofstatus` tinyint(4) DEFAULT '0' COMMENT '发货状态(1未发货,2已发货,3已收货)',
  `ostatus` tinyint(4) DEFAULT NULL COMMENT '付款状态(1未付款,2已付款,3退款中.4退款成功)',
  `opay` char(10) NOT NULL COMMENT '支付方式',
  `owin` varchar(50) DEFAULT NULL,
  `onum` int(5) DEFAULT NULL COMMENT '购买次数',
  `oip` varchar(20) DEFAULT NULL COMMENT '订单IP',
  `otime` decimal(13,3) unsigned DEFAULT NULL COMMENT '订单添加时间',
  PRIMARY KEY (`oid`),
  KEY `ogid` (`ogid`),
  KEY `ouid` (`ouid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of go_cloud_order
-- ----------------------------

-- ----------------------------
-- Table structure for `_cloud_select`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_select`;
CREATE TABLE `####_cloud_select` (
  `oid` int(10) unsigned NOT NULL,
  `ogid` int(11) DEFAULT NULL COMMENT '订单类型(1充值订单,2商品订单,3云购订单,其他)',
  `og_title` varchar(200) DEFAULT NULL,
  `oqishu` smallint(6) DEFAULT NULL,
  `ouid` int(10) unsigned NOT NULL COMMENT '会员id',
  `ou_name` varchar(50) DEFAULT NULL,
  `ocode` char(20) NOT NULL COMMENT '订单号',
  `omoney` decimal(10,2) unsigned NOT NULL COMMENT '订单金额',
  `ofstatus` tinyint(4) DEFAULT '0' COMMENT '发货状态(1未发货,2已发货,3已收货)',
  `ostatus` tinyint(4) DEFAULT NULL COMMENT '付款状态(1未付款,2已付款,3退款中.4退款成功)',
  `opay` char(10) NOT NULL COMMENT '支付方式',
  `owin` varchar(50) DEFAULT NULL,
  `onum` int(5) DEFAULT NULL COMMENT '购买次数',
  `oip` varchar(20) DEFAULT NULL COMMENT '订单IP',
  `otime` decimal(13,3) unsigned DEFAULT NULL COMMENT '订单添加时间',
  PRIMARY KEY (`oid`),
  KEY `ogid` (`ogid`) USING BTREE,
  KEY `ouid` (`ouid`) USING BTREE
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC INSERT_METHOD=LAST UNION=(`####_cloud_order`);

-- ----------------------------
-- Records of go_cloud_select
-- ----------------------------

-- ----------------------------
-- Table structure for `_cloud_select_i`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_select_i`;
CREATE TABLE `####_cloud_select_i` (
  `oid` int(11) unsigned NOT NULL,
  `ogid` int(11) DEFAULT NULL,
  `ogocode` longtext,
  `oremark` varchar(500) DEFAULT NULL,
  `otext` text COMMENT '订单附加信息',
  KEY `oid` (`oid`) USING BTREE
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC INSERT_METHOD=LAST UNION=(`####_cloud_info`);

-- ----------------------------
-- Records of go_cloud_select_i
-- ----------------------------

-- ----------------------------
-- Table structure for `_cloud_u`
-- ----------------------------
DROP TABLE IF EXISTS `####_cloud_u`;
CREATE TABLE `####_cloud_u` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91693 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `_club`
-- ----------------------------
DROP TABLE IF EXISTS `####_club`;
CREATE TABLE `####_club` (
  `cid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` char(15) NOT NULL COMMENT '标题',
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `chengyuan` mediumint(8) unsigned DEFAULT '0' COMMENT '成员数',
  `tiezi` mediumint(8) unsigned DEFAULT '0' COMMENT '帖子数',
  `guanli` mediumint(8) unsigned NOT NULL COMMENT '管理员',
  `jinhua` smallint(5) unsigned DEFAULT NULL COMMENT '精华帖',
  `jianjie` varchar(255) DEFAULT '暂无介绍' COMMENT '简介',
  `gongao` varchar(255) DEFAULT '暂无' COMMENT '公告',
  `jiaru` char(1) DEFAULT 'Y' COMMENT '申请加入',
  `glfatie` char(1) DEFAULT 'N' COMMENT '发帖权限',
  `huifu` char(1) DEFAULT 'Y' COMMENT '回复权限',
  `shenhe` char(1) DEFAULT 'N' COMMENT '审核',
  `time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='圈子列表';

-- ----------------------------
-- Records of go_club
-- ----------------------------

-- ----------------------------
-- Table structure for `_club_post`
-- ----------------------------
DROP TABLE IF EXISTS `####_club_post`;
CREATE TABLE `####_club_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cid` int(10) unsigned DEFAULT NULL COMMENT '圈子ID匹配',
  `type` tinyint(4) unsigned DEFAULT NULL COMMENT '类型(1帖子,2回复)',
  `huiyuan` varchar(255) DEFAULT NULL COMMENT '会员信息',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '帖子内容或回复内容',
  `huifu` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `huifu_id` int(10) unsigned DEFAULT NULL COMMENT '回复帖子ID',
  `dianji` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `zhiding` char(1) DEFAULT 'N' COMMENT '是否置顶',
  `jinghua` char(1) DEFAULT 'N' COMMENT '是否精华',
  `shenhe` char(1) NOT NULL DEFAULT 'Y' COMMENT '是否通过',
  `endtime` varchar(255) DEFAULT NULL COMMENT '最后回复',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='圈子帖子';

-- ----------------------------
-- Records of go_club_post
-- ----------------------------

-- ----------------------------
-- Table structure for `_config`
-- ----------------------------
DROP TABLE IF EXISTS `####_config`;
CREATE TABLE `####_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modules` char(20) DEFAULT NULL COMMENT '所属模型',
  `name` varchar(30) NOT NULL,
  `value` mediumtext,
  `zhushi` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `modules` (`modules`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of go_config
-- ----------------------------
INSERT INTO `####_config` VALUES ('1', 'base', 'web_name', 'YunGouCMS v4.0.1 — 惊喜无线', '网站名');
INSERT INTO `####_config` VALUES ('2', 'base', 'web_key', '', '网站关键字');
INSERT INTO `####_config` VALUES ('3', 'base', 'web_des', '', '网站介绍');
INSERT INTO `####_config` VALUES ('4', 'base', 'web_path', 'http://www.yungoucms.com/', '网站地址');
INSERT INTO `####_config` VALUES ('5', 'base', 'templates_edit', '1', '是否允许在线编辑模板');
INSERT INTO `####_config` VALUES ('6', 'base', 'templates_name', 'yungou', '当前模板方案');
INSERT INTO `####_config` VALUES ('7', 'base', 'charset', 'utf-8', '网站字符集');
INSERT INTO `####_config` VALUES ('8', 'base', 'timezone', 'Asia/Shanghai', '网站时区');
INSERT INTO `####_config` VALUES ('9', 'base', 'error', '1', '1、保存错误日志到 cache/error_log.php | 0、在页面直接显示');
INSERT INTO `####_config` VALUES ('10', 'base', 'gzip', '0', '是否Gzip压缩后输出,服务器没有gzip请不要启用');
INSERT INTO `####_config` VALUES ('11', 'base', 'lang', 'zh_cn', '网站语言包');
INSERT INTO `####_config` VALUES ('12', 'base', 'cache', '3600', '默认缓存时间');
INSERT INTO `####_config` VALUES ('13', 'base', 'web_off', '1', '网站是否开启');
INSERT INTO `####_config` VALUES ('14', 'base', 'web_off_text', '网站关闭。升级中....', '关闭原因');
INSERT INTO `####_config` VALUES ('15', 'base', 'tablepre', 'QCM=', null);
INSERT INTO `####_config` VALUES ('16', 'base', 'index_name', '?', '隐藏首页文件名');
INSERT INTO `####_config` VALUES ('17', 'base', 'expstr', '/', 'url分隔符号');
INSERT INTO `####_config` VALUES ('18', 'base', 'admindir', 'admin', '后台管理文件夹');
INSERT INTO `####_config` VALUES ('19', 'base', 'qq', '4006810039', 'qq');
INSERT INTO `####_config` VALUES ('20', 'base', 'cell', '4006810039', '联系电话');
INSERT INTO `####_config` VALUES ('21', 'base', 'web_logo', 'banner/logo.png', 'logo');
INSERT INTO `####_config` VALUES ('23', 'base', 'web_name_two', 'YunGouCMS', '短网站名');
INSERT INTO `####_config` VALUES ('24', 'base', 'qq_qun', '123456|456789', 'QQ群');
INSERT INTO `####_config` VALUES ('25', 'base', 'goods_end_time', '180', '开奖动画秒数(单位秒)');
INSERT INTO `####_config` VALUES ('26', null, 'searchtag', '苹果| iPhone| 智能手机|3G手机|宝马|单反', null);
INSERT INTO `####_config` VALUES ('27', null, 'goods_count_num', '766', '全站总云购次数');
INSERT INTO `####_config` VALUES ('32', 'reg', 'nickname', '123，fwefwef', null);
INSERT INTO `####_config` VALUES ('33', 'reg', 'reg_email', '1', null);
INSERT INTO `####_config` VALUES ('34', 'reg', 'reg_mobile', '1', null);
INSERT INTO `####_config` VALUES ('35', 'reg', 'reg_num', '20', null);
INSERT INTO `####_config` VALUES ('36', 'reg', 'submit', '提交', null);
INSERT INTO `####_config` VALUES ('37', 'fufen', 'f_overziliao', '10', null);
INSERT INTO `####_config` VALUES ('38', 'fufen', 'z_overziliao', '100', null);
INSERT INTO `####_config` VALUES ('39', 'fufen', 'f_shoppay', '20', null);
INSERT INTO `####_config` VALUES ('40', 'fufen', 'z_shoppay', '20', null);
INSERT INTO `####_config` VALUES ('41', 'fufen', 'f_phonecode', '20', null);
INSERT INTO `####_config` VALUES ('42', 'fufen', 'z_phonecode', '20', null);
INSERT INTO `####_config` VALUES ('43', 'fufen', 'f_visituser', '100', null);
INSERT INTO `####_config` VALUES ('44', 'fufen', 'z_visituser', '100', null);
INSERT INTO `####_config` VALUES ('45', 'fufen', 'fufen_yuan', '100', null);
INSERT INTO `####_config` VALUES ('46', 'fufen', 'fufen_yongjin', '0.06', null);
INSERT INTO `####_config` VALUES ('47', 'fufen', 'fufen_yongjintx', '2', null);
INSERT INTO `####_config` VALUES ('48', 'seo', 'web_path', 'http://www.yungoucms.com/', null);
INSERT INTO `####_config` VALUES ('50', 'seo', 'web_name', 'YunGouCMS v4.0.1 — 惊喜无线', null);
INSERT INTO `####_config` VALUES ('51', 'seo', 'web_name_two', 'yungoucms', null);
INSERT INTO `####_config` VALUES ('52', 'seo', 'web_key', 'd', null);
INSERT INTO `####_config` VALUES ('53', 'seo', 'web_des', 'e', null);
INSERT INTO `####_config` VALUES ('54', 'seo', 'web_copyright', 'f', null);
INSERT INTO `####_config` VALUES ('55', 'watermark', 'watermark_off', '1', null);
INSERT INTO `####_config` VALUES ('56', 'watermark', 'watermark_type', 'text', null);
INSERT INTO `####_config` VALUES ('57', 'watermark', 'watermark_text', 'sdfwef', null);
INSERT INTO `####_config` VALUES ('58', 'watermark', 'watermark_color', '#ff0000', null);
INSERT INTO `####_config` VALUES ('59', 'watermark', 'watermark_size', '18', null);
INSERT INTO `####_config` VALUES ('60', 'watermark', 'watermark_width', '', null);
INSERT INTO `####_config` VALUES ('61', 'watermark', 'watermark_height', '', null);
INSERT INTO `####_config` VALUES ('62', 'watermark', 'watermark_image', '', null);
INSERT INTO `####_config` VALUES ('63', 'watermark', 'watermark_apache', '', null);
INSERT INTO `####_config` VALUES ('64', 'watermark', 'watermark_good', '', null);
INSERT INTO `####_config` VALUES ('68', 'domain', 'domain', 'a:2:{s:8:\"m.qq.com\";a:4:{s:6:\"domain\";s:8:\"m.qq.com\";s:6:\"module\";s:6:\"mobile\";s:6:\"action\";s:6:\"mobile\";s:4:\"func\";s:5:\"init1\";}s:1:\"a\";a:4:{s:6:\"domain\";s:1:\"a\";s:6:\"module\";s:1:\"b\";s:6:\"action\";s:1:\"c\";s:4:\"func\";s:1:\"d\";}}', null);
INSERT INTO `####_config` VALUES ('72', 'email', 'big', 'utf-8', null);
INSERT INTO `####_config` VALUES ('73', 'email', 'user', '123456789@qq.com', null);
INSERT INTO `####_config` VALUES ('74', 'email', 'pass', 'mima', null);
INSERT INTO `####_config` VALUES ('84', 'email', 'fromName', 'YunGouCMS', null);
INSERT INTO `####_config` VALUES ('96', 'base', 'cryptkey', 'zsczs', null);
INSERT INTO `####_config` VALUES ('97', 'base', 'sqlsafe', 'off', null);
INSERT INTO `####_config` VALUES ('98', 'base', 'session_storage', 'file', null);
INSERT INTO `####_config` VALUES ('99', 'base', 'session_ttl', '1800', null);
INSERT INTO `####_config` VALUES ('100', 'base', 'session_savepath', 'sessions/', null);
INSERT INTO `####_config` VALUES ('101', 'base', 'cookie_domain', '', null);
INSERT INTO `####_config` VALUES ('102', 'base', 'cookie_path', '/', null);
INSERT INTO `####_config` VALUES ('103', 'base', 'cookie_pre', 'wc_', null);
INSERT INTO `####_config` VALUES ('104', 'base', 'cookie_ttl', '0', null);
INSERT INTO `####_config` VALUES ('105', 'base', 'cookie_hash', 'Dv8Xs4', null);
INSERT INTO `####_config` VALUES ('106', 'upload', 'upsize', '1024000', null);
INSERT INTO `####_config` VALUES ('107', 'upload', 'up_image_type', 'jpg,gif,png', null);
INSERT INTO `####_config` VALUES ('108', 'upload', 'up_soft_type', 'zip,gz,rar,iso,doc,ppt,wps,xls', null);
INSERT INTO `####_config` VALUES ('109', 'upload', 'up_media_type', 'swf,flv,mp3,wav,wma,rmvb', null);
INSERT INTO `####_config` VALUES ('110', 'base', 'lottery_type', 'default', '云购计算方式（勿删）');
INSERT INTO `####_config` VALUES ('111', 'contact', 'contact', '重庆韬龙网络科技有限公司', null);
INSERT INTO `####_config` VALUES ('112', 'contact', 'tel', '400-6810-039', null);
INSERT INTO `####_config` VALUES ('113', 'contact', 'email', 'yy@tao-long.com', null);
INSERT INTO `####_config` VALUES ('114', 'contact', 'addr', '重庆市渝中区中山二路174号（文化宫综合楼）307室20间', null);
INSERT INTO `####_config` VALUES ('115', 'email', 'nohtml', '不支持HTML格式', null);
INSERT INTO `####_config` VALUES ('116', 'email', 'from', '123456789@qq.com', null);
INSERT INTO `####_config` VALUES ('117', 'email', 'stmp_host', 'smtp.qq.com', null);
INSERT INTO `####_config` VALUES ('118', 'seo', 'home_title', '', null);
INSERT INTO `####_config` VALUES ('119', 'seo', 'home_keywords', '', null);
INSERT INTO `####_config` VALUES ('120', 'seo', 'home_desc', '', null);
INSERT INTO `####_config` VALUES ('121', 'seo', 'goods_title', '{Web_name}', null);
INSERT INTO `####_config` VALUES ('122', 'seo', 'goods_keywords', '{Web_name}', null);
INSERT INTO `####_config` VALUES ('123', 'seo', 'goods_desc', '{Web_name}', null);
INSERT INTO `####_config` VALUES ('124', 'seo', 'goods_detail_title', '{Goods_name}', null);
INSERT INTO `####_config` VALUES ('125', 'seo', 'goods_detail_keywords', '{Goods_name}，{Goods_brand}', null);
INSERT INTO `####_config` VALUES ('126', 'seo', 'goods_detail_desc', '{Goods_desc}', null);
INSERT INTO `####_config` VALUES ('127', 'seo', 'user_title', '{User_name}', null);
INSERT INTO `####_config` VALUES ('128', 'seo', 'user_keywords', '{User_name},{User_sign}', null);
INSERT INTO `####_config` VALUES ('129', 'seo', 'user_desc', '{User_name}，{User_sign}', null);
INSERT INTO `####_config` VALUES ('130', 'seo', 'article_title', '{Article_title}', null);
INSERT INTO `####_config` VALUES ('131', 'seo', 'article_keywords', '{Article_keyword}', null);
INSERT INTO `####_config` VALUES ('132', 'seo', 'article_desc', '{Article_desc}', null);
INSERT INTO `####_config` VALUES ('133', 'template', 'e_reg_temp', '你好,请在24小时内激活注册邮件，点击连接激活邮件：{地址}', null);
INSERT INTO `####_config` VALUES ('134', 'template', 'e_shop_temp', '恭喜您：{用户名}，你在云购网够买的商品：{商品名称} 已中奖，中奖码是:{中奖码}', null);
INSERT INTO `####_config` VALUES ('135', 'template', 'e_pwd_temp', '请在24小时内激活邮件，点击连接激活邮件：{地址}', null);
INSERT INTO `####_config` VALUES ('136', 'template', 'm_reg_temp', '您的验证码是:【000000】。请不要把验证码泄露给其他人。', null);
INSERT INTO `####_config` VALUES ('137', 'template', 'm_shop_temp', '恭喜你云购用户！您在1元云购网够买的商品已中奖,获得的云购码为：00000000 请登陆网站查看详情！请尽快联系管理员发货！', null);
INSERT INTO `####_config` VALUES ('138', 'template', 'm_pwd_temp', '你好,你现在正在找回密码，你的验证码是【000000】。', null);
INSERT INTO `####_config` VALUES ('139', 'app', 'name_1', '安卓下载', null);
INSERT INTO `####_config` VALUES ('140', 'app', 'img_1', 'banner/a1ce6ef713.png', null);
INSERT INTO `####_config` VALUES ('141', 'app', 'name_2', 'IOS下载', null);
INSERT INTO `####_config` VALUES ('142', 'app', 'img_2', 'banner/a1ce6ef713.png', null);
INSERT INTO `####_config` VALUES ('143', 'app', 'name_3', 'WIN下载', null);
INSERT INTO `####_config` VALUES ('144', 'app', 'img_3', 'banner/a1ce6ef713.png', null);
INSERT INTO `####_config` VALUES ('145', 'app', 'img_wx', 'banner/a1ce6ef713.png', null);
INSERT INTO `####_config` VALUES ('146','base', 'pay_bank_type', 'cbpay', '银行列表');

-- ----------------------------
-- Table structure for `_ems`
-- ----------------------------
DROP TABLE IF EXISTS `####_ems`;
CREATE TABLE `####_ems` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ecode` varchar(20) NOT NULL COMMENT '配送方式的字符串代号',
  `ename` char(20) NOT NULL COMMENT '邮递公司名',
  `edesc` varchar(140) NOT NULL COMMENT '配送说明',
  `einsure` varchar(10) NOT NULL DEFAULT '0' COMMENT '保价费用，单位元，或者是百分数，该值直接输出为报价费用',
  `ecod` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支持货到付款，1，支持；0，不支持',
  `enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '该配送方式是否被禁用，1，可用；0，禁用',
  PRIMARY KEY (`eid`),
  KEY `eid` (`eid`) USING BTREE,
  KEY `ecode` (`ecode`,`enabled`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='配送方式配置信息表';

-- ----------------------------
-- Records of go_ems
-- ----------------------------
INSERT INTO `####_ems` VALUES ('2', 'sto', '申通', '申通', '0', '0', '0');
INSERT INTO `####_ems` VALUES ('3', 'zto', '中通', '中通', '0', '0', '0');

-- ----------------------------
-- Table structure for `_files`
-- ----------------------------
DROP TABLE IF EXISTS `####_files`;
CREATE TABLE `####_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `time` (`time`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COMMENT='上传文件库';

-- ----------------------------
-- Records of go_files
-- ----------------------------

-- ----------------------------
-- Table structure for `_fund`
-- ----------------------------
DROP TABLE IF EXISTS `####_fund`;
CREATE TABLE `####_fund` (
  `fund_off` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `fund_money` decimal(10,2) unsigned NOT NULL COMMENT '基金单次贡献数',
  `fund_ymoney` varchar(20) DEFAULT NULL COMMENT '预存',
  `fund_cmoney` decimal(12,2) DEFAULT NULL COMMENT '云购基金总数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='基金表';

-- ----------------------------
-- Records of go_fund
-- ----------------------------
INSERT INTO `####_fund` VALUES ('2', '142.00', '100132', '10215.00');

-- ----------------------------
-- Table structure for `_goods`
-- ----------------------------
DROP TABLE IF EXISTS `####_goods`;
CREATE TABLE `####_goods` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_cateid` smallint(6) DEFAULT NULL COMMENT '所属栏目',
  `g_brandid` smallint(6) DEFAULT NULL COMMENT '所属品牌',
  `g_type` smallint(6) DEFAULT NULL COMMENT '商品所属类别（3云购，1普通）',
  `g_style` smallint(6) DEFAULT '0' COMMENT '商品属性（1人气,2推荐,3人气+推荐）',
  `g_status` tinyint(4) DEFAULT '-1' COMMENT '状态(-1未审核,0,删除,1上线,2下线,)',
  `g_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `g_thumb` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `g_keyword` varchar(100) DEFAULT NULL COMMENT '关键字',
  `g_description` varchar(200) DEFAULT NULL COMMENT '说明',
  `g_title_style` varchar(100) DEFAULT NULL COMMENT '标题样式',
  `g_money` decimal(10,2) unsigned DEFAULT NULL COMMENT '列表价格',
  `g_sales` mediumint(8) unsigned DEFAULT '0' COMMENT '总销量',
  `g_ispoints` tinyint(1) DEFAULT '0' COMMENT '是否支持积分购买',
  `g_add_uid` int(10) unsigned DEFAULT NULL COMMENT '操作用户',
  `g_add_time` int(10) DEFAULT NULL COMMENT '添加时间',
  `g_sort` int(10) DEFAULT NULL,
  PRIMARY KEY (`gid`),
  KEY `g_sales` (`g_sales`) USING BTREE,
  KEY `g_money` (`g_money`) USING BTREE,
  KEY `g_status` (`g_status`) USING BTREE,
  KEY `gid` (`gid`),
  KEY `g_title` (`g_title`),
  KEY `g_thumb` (`g_thumb`),
  KEY `g_cateid` (`g_cateid`),
  KEY `g_brandid` (`g_brandid`),
  KEY `g_type` (`g_type`),
  KEY `g_style` (`g_style`),
  KEY `g_add_time` (`g_add_time`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8 COMMENT='商品主表';

-- ----------------------------
-- Records of go_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `_goods_info`
-- ----------------------------
DROP TABLE IF EXISTS `####_goods_info`;
CREATE TABLE `####_goods_info` (
  `gid` int(10) unsigned NOT NULL DEFAULT '0',
  `g_picarr` varchar(500) DEFAULT NULL COMMENT '图片集',
  `g_content` mediumtext COMMENT '内容',
  PRIMARY KEY (`gid`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品附表';

-- ----------------------------
-- Records of go_goods_info
-- ----------------------------

-- ----------------------------
-- Table structure for `_link`
-- ----------------------------
DROP TABLE IF EXISTS `####_link`;
CREATE TABLE `####_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接ID',
  `type` tinyint(1) unsigned NOT NULL COMMENT '链接类型',
  `name` char(20) NOT NULL COMMENT '名称',
  `logo` varchar(250) NOT NULL COMMENT '图片',
  `url` varchar(50) NOT NULL COMMENT '地址',
  PRIMARY KEY (`id`),
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of go_link
-- ----------------------------


-- ----------------------------
-- Table structure for `_ments`
-- ----------------------------
DROP TABLE IF EXISTS `####_ments`;
CREATE TABLE `####_ments` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(10) unsigned DEFAULT '0' COMMENT '上层ID',
  `type` tinyint(1) DEFAULT '0' COMMENT '是否是导航',
  `is_enable` tinyint(1) DEFAULT '1' COMMENT '是否启用',
  `name` char(10) DEFAULT NULL COMMENT '显示名称',
  `m` char(20) DEFAULT NULL COMMENT '模块',
  `c` char(20) DEFAULT NULL COMMENT '控制器',
  `a` char(20) DEFAULT NULL COMMENT '动作',
  `d` varchar(150) DEFAULT NULL COMMENT '函数的参数',
  `url` varchar(150) DEFAULT NULL COMMENT '自定义url',
  `desc` varchar(140) DEFAULT NULL COMMENT '权限说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COMMENT='后台ments列表,与权限位';

-- ----------------------------
-- Records of go_ments
-- ----------------------------
INSERT INTO `####_ments` VALUES ('1', '0', '1', '1', '系统设置', '', '', '', null, null, null);
INSERT INTO `####_ments` VALUES ('2', '0', '1', '1', '内容管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('3', '0', '1', '1', '商品管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('4', '0', '1', '1', '用户管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('5', '0', '1', '1', '界面管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('6', '0', '1', '1', '云应用', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('7', '1', '1', '1', '站点设置', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('8', '7', '1', '1', '基本设置', 'admin', 'setting', 'base', null, '', null);
INSERT INTO `####_ments` VALUES ('9', '7', '0', '1', 'SEO设置', 'admin', 'setting', 'seo', '', '', null);
INSERT INTO `####_ments` VALUES ('10', '7', '0', '1', '上传设置', 'admin', 'setting', 'upload', '', '', null);
INSERT INTO `####_ments` VALUES ('11', '7', '0', '1', '水印设置', 'admin', 'setting', 'watermark', '', '', null);
INSERT INTO `####_ments` VALUES ('12', '7', '0', '1', '邮箱设置', 'admin', 'setting', 'email', '', '', null);
INSERT INTO `####_ments` VALUES ('13', '7', '0', '1', '短信设置', 'admin', 'setting', 'mobile', '', '', null);
INSERT INTO `####_ments` VALUES ('14', '7', '0', '1', '模块域名绑定', 'admin', 'setting', 'domain', '', '', null);
INSERT INTO `####_ments` VALUES ('15', '1', '1', '1', '运营管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('16', '15', '1', '1', '网站统计', 'admin', 'sys', 'webtongji', null, '', null);
INSERT INTO `####_ments` VALUES ('17', '15', '0', '1', '网站地图', 'admin', 'sys', 'websitemap', '', '', null);
INSERT INTO `####_ments` VALUES ('18', '2', '1', '1', '文章管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('19', '18', '0', '1', '添加文章', 'admin', 'article', 'article_add', '', '', null);
INSERT INTO `####_ments` VALUES ('20', '18', '1', '1', '文章列表', 'admin', 'article', 'article_list', null, '', null);
INSERT INTO `####_ments` VALUES ('21', '18', '1', '1', '文章分类', 'admin', 'cate', 'lists', 'article', '', null);
INSERT INTO `####_ments` VALUES ('22', '2', '1', '1', '单页管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('23', '22', '0', '1', '添加单页', 'admin', 'cate', 'addcate', 'web', '', null);
INSERT INTO `####_ments` VALUES ('24', '22', '1', '1', '单页列表', 'admin', 'cate', 'lists', 'web', '', null);
INSERT INTO `####_ments` VALUES ('25', '2', '1', '1', '附件管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('26', '25', '1', '1', '上传文件管理', 'admin', 'other', 'upload', null, '', null);
INSERT INTO `####_ments` VALUES ('30', '2', '1', '1', '模块管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('31', '30', '1', '1', '圈子模块', 'admin', 'other', 'club', null, '', null);
INSERT INTO `####_ments` VALUES ('32', '30', '1', '1', '友情链接', 'admin', 'other', 'links', null, '', null);
INSERT INTO `####_ments` VALUES ('33', '30', '1', '1', '广告模块', 'admin', 'other', 'ad_pos', null, '', null);
INSERT INTO `####_ments` VALUES ('34', '3', '1', '1', '商品管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('35', '34', '0', '1', '添加新商品', 'admin', 'goods', 'goods_add', '', '', null);
INSERT INTO `####_ments` VALUES ('36', '34', '1', '1', '商品列表', 'admin', 'goods', 'goods_list', null, '', null);
INSERT INTO `####_ments` VALUES ('37', '34', '1', '1', '商品分类', 'admin', 'cate', 'lists', 'goods', '', null);
INSERT INTO `####_ments` VALUES ('38', '34', '1', '1', '品牌管理', 'admin', 'goods', 'brand_lists', null, '', null);
INSERT INTO `####_ments` VALUES ('39', '34', '0', '1', '添加品牌', 'admin', 'goods', 'brand_add', '', '', null);
INSERT INTO `####_ments` VALUES ('40', '41', '0', '1', '添加云购商品', 'admin', 'goods', 'cloud_goods_add', '', '', null);
INSERT INTO `####_ments` VALUES ('41', '3', '1', '1', '云购商品', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('42', '41', '1', '1', '商品管理', 'admin', 'goods', 'cloud_goods_lists', null, '', null);
INSERT INTO `####_ments` VALUES ('43', '3', '1', '1', '订单管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('44', '43', '1', '1', '订单列表', 'admin', 'order', 'lists', null, '', null);
INSERT INTO `####_ments` VALUES ('45', '43', '1', '1', '订单查询', 'admin', 'order', 'select', null, '', null);
INSERT INTO `####_ments` VALUES ('46', '43', '0', '1', '中奖订单', 'admin', 'order', 'lists', 'win', '', null);
INSERT INTO `####_ments` VALUES ('47', '43', '0', '1', '未发货订单', 'admin', 'order', 'lists', 'notsend', '', null);
INSERT INTO `####_ments` VALUES ('48', '3', '1', '1', '促销管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('49', '48', '1', '1', '限时揭晓商品', 'admin', 'goods', 'cloud_goods_lists', 'xianshi', '', null);
INSERT INTO `####_ments` VALUES ('50', '3', '1', '1', '其他', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('51', '50', '1', '1', '晒单查看', 'admin', 'order', 'share', null, '', null);
INSERT INTO `####_ments` VALUES ('52', '4', '1', '1', '用户管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('53', '52', '1', '1', '会员列表', 'admin', 'member', 'lists', null, '', null);
INSERT INTO `####_ments` VALUES ('54', '52', '0', '1', '查找会员', 'admin', 'member', 'select', '', '', null);
INSERT INTO `####_ments` VALUES ('55', '52', '0', '1', '添加会员', 'admin', 'member', 'insert', '', '', null);
INSERT INTO `####_ments` VALUES ('56', '52', '1', '1', '会员配置', 'admin', 'member', 'config', null, '', null);
INSERT INTO `####_ments` VALUES ('57', '52', '1', '1', '充值记录', 'admin', 'member', 'recharge', null, '', null);
INSERT INTO `####_ments` VALUES ('58', '52', '1', '1', '消费记录', 'admin', 'member', 'pay_list', null, '', null);
INSERT INTO `####_ments` VALUES ('59', '52', '1', '1', '会员组', 'admin', 'member', 'member_group', null, '', null);
INSERT INTO `####_ments` VALUES ('61', '5', '1', '1', '界面管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('62', '61', '1', '1', '导航条管理', 'admin', 'other', 'nav', null, '', null);
INSERT INTO `####_ments` VALUES ('63', '61', '1', '1', '幻灯管理', 'admin', 'other', 'slide', null, '', null);
INSERT INTO `####_ments` VALUES ('65', '5', '1', '1', '模板风格', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('66', '65', '1', '1', '模板设置', 'admin', 'other', 'template', null, '', null);
INSERT INTO `####_ments` VALUES ('75', '74', '1', '1', '管理员分组', 'admin', 'auth', 'group', null, '', null);
INSERT INTO `####_ments` VALUES ('68', '65', '1', '1', '模板TAG标签', 'admin', 'htmlcustom', 'lists', null, '', null);
INSERT INTO `####_ments` VALUES ('69', '5', '1', '1', '后台界面', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('70', '69', '1', '1', '后台地图', 'admin', 'index', 'map', null, '', null);
INSERT INTO `####_ments` VALUES ('71', '6', '1', '1', '插件管理', null, null, null, null, null, null);
INSERT INTO `####_ments` VALUES ('83', '7', '0', '1', '联系方式', 'admin', 'setting', 'contact', '', '', '');
INSERT INTO `####_ments` VALUES ('84', '7', '0', '1', '模板设置', 'admin', 'setting', 'template', '', '', '');
INSERT INTO `####_ments` VALUES ('74', '1', '1', '1', '权限管理', null, null, null, null, '', null);
INSERT INTO `####_ments` VALUES ('76', '74', '1', '1', '管理员列表', 'admin', 'auth', 'admin', null, '', null);
INSERT INTO `####_ments` VALUES ('77', '74', '1', '1', '功能列表', 'admin', 'auth', 'fun', null, '', null);
INSERT INTO `####_ments` VALUES ('78', '7', '0', '1', '支付方式', 'admin', 'setting', 'pay', '', '', null);
INSERT INTO `####_ments` VALUES ('79', '7', '0', '1', '上传设置', 'admin', 'setting', 'upload', '', '', '');
INSERT INTO `####_ments` VALUES ('86', '71', '1', '1', '在线升级', 'admin', 'upfile', 'init', '', null, null);
INSERT INTO `####_ments` VALUES ('80', '71', '1', '1', '应用中心', '', '', '', null, 'plugin-Manager-showview', null);
INSERT INTO `####_ments` VALUES ('88', '43', '1', '1', '普通订单列表', 'admin', 'order', 'nlists', null, '', null);
INSERT INTO `####_ments` VALUES ('89', '7', '0', '1', '快递公司', 'admin', 'setting', 'ship', null, '', null);
INSERT INTO `####_ments` VALUES ('90', '41', '0', '1', '获取品牌', 'admin', 'goods', 'json_brand', null, '', null);
-- ----------------------------
-- Table structure for `_nav`
-- ----------------------------
DROP TABLE IF EXISTS `####_nav`;
CREATE TABLE `####_nav` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned DEFAULT NULL COMMENT '父导航ID',
  `name` varchar(255) DEFAULT NULL COMMENT '导航名称',
  `type` char(10) DEFAULT NULL COMMENT '类型（头部，尾部）',
  `url` varchar(255) DEFAULT NULL COMMENT '链接',
  `status` char(1) DEFAULT 'Y' COMMENT '状态(显示/隐藏)',
  `sort` smallint(6) unsigned DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`cid`),
  KEY `status` (`status`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `sort` (`sort`) USING BTREE,
  KEY `cid` (`cid`),
  KEY `parentid` (`parentid`),
  KEY `name` (`name`),
  KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='导航表';

-- ----------------------------
-- Records of go_nav
-- ----------------------------
INSERT INTO `####_nav` VALUES ('1', '0', '云购商品', 'index', '/cgoods_list', 'Y', '2');
INSERT INTO `####_nav` VALUES ('2', '0', '新手指南', 'foot', '/article-2.html', 'Y', '2');
INSERT INTO `####_nav` VALUES ('3', '0', '圈子', 'foot', '/index/club/init', 'Y', '2');
INSERT INTO `####_nav` VALUES ('4', '0', '关于云购', 'foot', '/article-1.html', 'Y', '1');
INSERT INTO `####_nav` VALUES ('5', '0', '隐私声明', 'foot', '/article-11.html', 'Y', '1');
INSERT INTO `####_nav` VALUES ('6', '0', '合作专区', 'foot', '/single/business', 'Y', '1');
INSERT INTO `####_nav` VALUES ('7', '0', '友情链接', 'foot', '/single/link', 'Y', '1');
INSERT INTO `####_nav` VALUES ('8', '0', '联系我们', 'foot', '/article-1.html', 'Y', '1');
INSERT INTO `####_nav` VALUES ('10', '0', '晒单分享', 'index', '/index/share/init', 'Y', '1');
INSERT INTO `####_nav` VALUES ('12', '0', '最新揭晓', 'index', '/cgoods_lottery', 'Y', '1');
INSERT INTO `####_nav` VALUES ('13', '0', '邀请', 'foot', '/single/pleasereg', 'Y', '1');
INSERT INTO `####_nav` VALUES ('14', '0', '限时揭晓', 'index', '/autolottery', 'Y', '1');
INSERT INTO `####_nav` VALUES ('15', '0', '普通商品', 'index', '/goods_list', 'Y', '1');
INSERT INTO `####_nav` VALUES ('16', '0', '上传头像', 'index', '/member/user/userphoto', 'N', '1');

-- ----------------------------
-- Table structure for `_orders`
-- ----------------------------
DROP TABLE IF EXISTS `####_orders`;
CREATE TABLE `####_orders` (
  `oid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `otype` tinyint(4) DEFAULT NULL COMMENT '订单类型(1充值订单,2商品订单,3云购订单,其他)',
  `ouid` int(10) unsigned NOT NULL COMMENT '会员id',
  `ocode` char(20) NOT NULL COMMENT '订单号',
  `omoney` decimal(10,2) unsigned NOT NULL COMMENT '订单金额',
  `ofstatus` tinyint(4) DEFAULT '0' COMMENT '发货状态(1未发货,2已发货,3已收货)',
  `ostatus` tinyint(4) DEFAULT NULL COMMENT '付款状态(1未付款,2已付款,3退款中.4退款成功)',
  `opay` char(10) NOT NULL COMMENT '支付方式',
  `oremark` varchar(500) DEFAULT NULL COMMENT '主订单备注',
  `otime` decimal(13,3) unsigned DEFAULT NULL COMMENT '订单添加时间',
  PRIMARY KEY (`oid`),
  KEY `opay` (`opay`) USING BTREE,
  KEY `ostatus` (`ostatus`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of go_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `_orders_info`
-- ----------------------------
DROP TABLE IF EXISTS `####_orders_info`;
CREATE TABLE `####_orders_info` (
  `oid` int(10) unsigned NOT NULL,
  `otext` text COMMENT '订单附加信息',
  KEY `oid` (`oid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单附表';

-- ----------------------------
-- Records of go_orders_info
-- ----------------------------

-- ----------------------------
-- Table structure for `_order_table`
-- ----------------------------
DROP TABLE IF EXISTS `####_order_table`;
CREATE TABLE `####_order_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `start_id` int(11) DEFAULT NULL,
  `end_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of go_order_table
-- ----------------------------
INSERT INTO `####_order_table` VALUES ('1', 'cloud_order', '0', '1428400820', '1', '3600');
INSERT INTO `####_order_table` VALUES ('2', 'go_cloud_order_1', '1428400820', null, '3601', null);

-- ----------------------------
-- Table structure for `_payment`
-- ----------------------------
DROP TABLE IF EXISTS `####_payment`;
CREATE TABLE `####_payment` (
  `pay_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_name` char(20) NOT NULL COMMENT '支付方式名称',
  `pay_class` char(20) NOT NULL COMMENT '支付类',
  `pay_type` tinyint(3) NOT NULL COMMENT '支付类型（及时到账等）',
  `pay_thumb` varchar(255) DEFAULT NULL COMMENT '支付方式缩略图',
  `pay_start` tinyint(4) NOT NULL COMMENT '是否开启',
  `pay_key` varchar(100) DEFAULT NULL COMMENT '支付密匙',
  `pay_account` varchar(100) DEFAULT NULL COMMENT '商户帐号',
  `pay_uid` varchar(50) DEFAULT NULL COMMENT '商户ID',
  `pay_mobile` varchar(5) DEFAULT NULL COMMENT 'PC或者手机',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='支付方式表';

-- ----------------------------
-- Records of go_payment
-- ----------------------------
INSERT INTO `####_payment` VALUES ('1', '财付通', 'tenpay', '1', 'photo/20150420/cftpay.jpg', '0', '', '', '', '1');
INSERT INTO `####_payment` VALUES ('2', '支付宝', 'alipay', '1', 'photo/20150420/zfbpay.jpg', '0', '', '', '1231', '1');
INSERT INTO `####_payment` VALUES ('3', '网银在线', 'cbpay', '1', 'photo/20150420/wypay.jpg', '0', '', '', '', '1');
INSERT INTO `####_payment` VALUES ('4', '微信支付', 'wxpay', '1', 'photo/20150420/wxpay.jpg', '0', '', '', '', '1');
INSERT INTO `####_payment` VALUES ('5', '手机银联支付', 'munionpay', '1', 'photo/20150420/mylpay.jpg', '0', null, null, null, '2');
INSERT INTO `####_payment` VALUES ('6', '分润支付宝', 'uqdalipay', '1', 'photo/20150420/zfbpay.jpg', '0', '', '', '', '1');
INSERT INTO `####_payment` VALUES ('7', '汇潮支付', 'hcpay', '1', 'photo/20150420/hcpay.jpg', '0', '', '', null, '1');
INSERT INTO `####_payment` VALUES ('8', '国付宝支付', 'gopay', '1', 'photo/20150420/gopay.jpg', '0', '', '', '', '1,2');
INSERT INTO `####_payment` VALUES ('9', '易宝支付', 'yeepay', '1', 'photo/20150420/ybpay.jpg', '0', null, null, null, '1');
INSERT INTO `####_payment` VALUES ('10', '银联支付', 'unionpay', '1', 'photo/20150420/ylpay.jpg', '0', null, null, null, null);
INSERT INTO `####_payment` VALUES ('11', '京东支付', 'cbjpay', '1', 'photo/20150420/wypay.jpg', '0', null, null, null,'2');
INSERT INTO `####_payment` VALUES ('12', '手机支付宝', 'malipay', '1', 'photo/20150420/zfbpay.jgg', '0', null, null, null,'2');

-- ----------------------------
-- Table structure for `_qqgroup`
-- ----------------------------
DROP TABLE IF EXISTS `####_qqgroup`;
CREATE TABLE `####_qqgroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq` varchar(11) DEFAULT NULL COMMENT 'qqh号码',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `type` varchar(20) DEFAULT NULL COMMENT '类型(直属群等)',
  `province` varchar(50) DEFAULT NULL COMMENT '省',
  `city` varchar(50) DEFAULT NULL COMMENT '市',
  `county` varchar(50) DEFAULT NULL COMMENT '县',
  `qqurl` varchar(250) DEFAULT NULL COMMENT 'qq群链接',
  `full` varchar(6) DEFAULT NULL COMMENT '是否已满',
  `subtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='QQ群表';

-- ----------------------------
-- Records of go_qqgroup
-- ----------------------------

-- ----------------------------
-- Table structure for `_send_log`
-- ----------------------------
DROP TABLE IF EXISTS `####_send_log`;
CREATE TABLE `####_send_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `gid` int(10) unsigned NOT NULL COMMENT '商品id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `goodstitle` varchar(200) NOT NULL COMMENT '商品标题',
  `send_type` tinyint(4) NOT NULL COMMENT '发送类型',
  `send_time` int(10) unsigned NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `gid` (`gid`) USING BTREE,
  KEY `send_type` (`send_type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='发送记录表';

-- ----------------------------
-- Records of go_send_log
-- ----------------------------

-- ----------------------------
-- Table structure for `_share`
-- ----------------------------
DROP TABLE IF EXISTS `####_share`;
CREATE TABLE `####_share` (
  `sd_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '晒单id',
  `sd_userid` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  `sd_shopid` int(10) unsigned DEFAULT NULL COMMENT '商品ID',
  `sd_ip` varchar(255) DEFAULT NULL COMMENT '晒单IP',
  `sd_title` varchar(255) DEFAULT NULL COMMENT '晒单标题',
  `sd_thumbs` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `sd_content` text COMMENT '晒单内容',
  `sd_photolist` text COMMENT '晒单图片',
  `sd_zhan` int(10) unsigned DEFAULT '0' COMMENT '点赞',
  `sd_ping` int(10) unsigned DEFAULT '0' COMMENT '评论',
  `sd_time` int(10) unsigned DEFAULT NULL COMMENT '晒单时间',
  PRIMARY KEY (`sd_id`),
  KEY `sd_userid` (`sd_userid`) USING BTREE,
  KEY `sd_shopid` (`sd_shopid`) USING BTREE,
  KEY `sd_zhan` (`sd_zhan`) USING BTREE,
  KEY `sd_ping` (`sd_ping`) USING BTREE,
  KEY `sd_time` (`sd_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='晒单列表';

-- ----------------------------
-- Records of go_share
-- ----------------------------

-- ----------------------------
-- Table structure for `_share_post`
-- ----------------------------
DROP TABLE IF EXISTS `####_share_post`;
CREATE TABLE `####_share_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sdhf_id` int(11) NOT NULL COMMENT '晒单ID',
  `sdhf_userid` int(11) DEFAULT NULL COMMENT '晒单回复会员ID',
  `sdhf_content` text COMMENT '晒单回复内容',
  `sdhf_time` int(11) DEFAULT NULL COMMENT '晒单时间',
  `sdhf_username` char(20) DEFAULT NULL COMMENT '晒单用户名',
  `sdhf_img` varchar(255) DEFAULT NULL COMMENT '晒单图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='晒单回复表';

-- ----------------------------
-- Records of go_share_post
-- ----------------------------

-- ----------------------------
-- Table structure for `_ship`
-- ----------------------------
DROP TABLE IF EXISTS `####_ship`;
CREATE TABLE `####_ship` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `etype` tinyint(1) DEFAULT '0' COMMENT '1 - 普通商品订单，3 - 云购订单',
  `oid` int(11) DEFAULT NULL COMMENT '订单号',
  `eid` int(11) DEFAULT NULL COMMENT '快递公司ID',
  `ecode` varchar(50) DEFAULT NULL COMMENT '快递单号',
  `emoney` float(5,2) DEFAULT NULL COMMENT '快递费用',
  `etime` int(11) DEFAULT NULL COMMENT '发货时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of go_ship
-- ----------------------------

-- ----------------------------
-- Table structure for `_slide`
-- ----------------------------
DROP TABLE IF EXISTS `####_slide`;
CREATE TABLE `####_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(50) DEFAULT NULL COMMENT '幻灯片',
  `title` varchar(30) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '类型:1-PC,2-手机',
  PRIMARY KEY (`id`),
  KEY `img` (`img`),
  KEY `title` (`title`),
  KEY `link` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='幻灯片表';

-- ----------------------------
-- Records of go_slide
-- ----------------------------
INSERT INTO `####_slide` VALUES ('1', 'banner/slide1.jpg', 'slide1', '', '1');
INSERT INTO `####_slide` VALUES ('2', 'banner/slide2.jpg', 'slide2', '', '1');
INSERT INTO `####_slide` VALUES ('3', 'banner/slide3.jpg', 'slide3', '', '1');
INSERT INTO `####_slide` VALUES ('4', 'banner/slide4.jpg', 'slide4', '', '2');
INSERT INTO `####_slide` VALUES ('5', 'banner/slide5.jpg', 'slide5', '', '2');
INSERT INTO `####_slide` VALUES ('6', 'banner/slide6.jpg', 'slide6', '', '2');

-- ----------------------------
-- Table structure for `_user`
-- ----------------------------
DROP TABLE IF EXISTS `####_user`;
CREATE TABLE `####_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(7) NOT NULL COMMENT '用户名',
  `email` varchar(50) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(11) DEFAULT NULL COMMENT '用户手机',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `user_ip` varchar(255) DEFAULT NULL COMMENT '用户登录ip',
  `img` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `qianming` varchar(255) DEFAULT NULL COMMENT '用户签名',
  `addclub` varchar(255) DEFAULT NULL COMMENT '用户加入的圈子组1|2|3',
  `money` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '账户金额',
  `emailcode` char(21) DEFAULT '-1' COMMENT '邮箱认证码',
  `mobilecode` char(21) DEFAULT '-1' COMMENT '手机认证码',
  `passcode` char(21) DEFAULT '-1' COMMENT '找会密码认证码-1,1,码',
  `reg_key` varchar(100) DEFAULT NULL COMMENT '注册参数',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '福分',
  `jingyan` int(10) unsigned DEFAULT '0' COMMENT '经验值',
  `yaoqing` int(10) unsigned DEFAULT NULL COMMENT '邀请人uid',
  `record_table` varchar(25) DEFAULT NULL,
  `time` int(10) unsigned DEFAULT '0' COMMENT '注册时间',
  `login_time` int(10) unsigned DEFAULT '0' COMMENT '登录时间',
  `groupid` tinyint(4) DEFAULT NULL COMMENT '用户所属会员组',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=1452 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of go_user
-- ----------------------------

-- ----------------------------
-- Table structure for `_user_account`
-- ----------------------------
DROP TABLE IF EXISTS `####_user_account`;
CREATE TABLE `####_user_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT NULL COMMENT '充值1/消费-1',
  `pay` char(20) DEFAULT NULL COMMENT '支付（账户，福分）',
  `content` varchar(255) DEFAULT NULL COMMENT '详情',
  `money` mediumint(8) NOT NULL DEFAULT '0' COMMENT '金额',
  `time` char(20) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员账户明细';

-- ----------------------------
-- Records of go_user_account
-- ----------------------------

-- ----------------------------
-- Table structure for `_user_addr`
-- ----------------------------
DROP TABLE IF EXISTS `####_user_addr`;
CREATE TABLE `####_user_addr` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `sheng` varchar(15) DEFAULT NULL COMMENT '省',
  `shi` varchar(15) DEFAULT NULL COMMENT '市',
  `xian` varchar(15) DEFAULT NULL COMMENT '县',
  `jiedao` varchar(255) DEFAULT NULL COMMENT '街道地址',
  `youbian` mediumint(8) DEFAULT NULL COMMENT '邮编',
  `shouhuoren` varchar(15) DEFAULT NULL COMMENT '收货人',
  `mobile` char(11) DEFAULT NULL COMMENT '手机',
  `tell` varchar(15) DEFAULT NULL COMMENT '座机号',
  `default` char(1) DEFAULT 'N' COMMENT '是否默认',
  `time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `qq` char(11) DEFAULT NULL COMMENT 'QQ',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员收货地址表';

-- ----------------------------
-- Records of go_user_addr
-- ----------------------------

-- ----------------------------
-- Table structure for `_user_band`
-- ----------------------------
DROP TABLE IF EXISTS `####_user_band`;
CREATE TABLE `####_user_band` (
  `b_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `b_type` char(10) DEFAULT NULL COMMENT '绑定登陆类型',
  `b_code` varchar(100) DEFAULT NULL COMMENT '返回数据1',
  `b_data` varchar(100) DEFAULT NULL COMMENT '返回数据2',
  `b_time` int(10) DEFAULT NULL COMMENT '绑定时间',
  PRIMARY KEY (`b_id`),
  KEY `b_uid` (`b_uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员账户绑定表';

-- ----------------------------
-- Records of go_user_band
-- ----------------------------

-- ----------------------------
-- Table structure for `_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `####_user_group`;
CREATE TABLE `####_user_group` (
  `groupid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组id',
  `name` char(15) NOT NULL COMMENT '会员组名',
  `jingyan_start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '需要的经验值最低数',
  `jingyan_end` int(10) NOT NULL COMMENT '需要的经验值最高数',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `type` char(1) NOT NULL DEFAULT 'N' COMMENT '是否是系统组',
  PRIMARY KEY (`groupid`),
  KEY `jingyan` (`jingyan_start`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员组';

-- ----------------------------
-- Records of go_user_group
-- ----------------------------
INSERT INTO `####_user_group` VALUES ('1', '一级', '0', '1000', null, 'N');
INSERT INTO `####_user_group` VALUES ('2', '二级', '1001', '5001', null, 'N');

-- ----------------------------
-- Table structure for `_user_money_record`
-- ----------------------------
DROP TABLE IF EXISTS `####_user_money_record`;
CREATE TABLE `####_user_money_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `code` char(20) NOT NULL COMMENT '订单号',
  `money` decimal(10,2) DEFAULT NULL,
  `status` char(20) NOT NULL COMMENT '付款状态(1未付款,2已付款,3退款中.4退款成功)',
  `time` int(10) NOT NULL,
  `scookies` text COMMENT '购物车cookie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='云购支付索引表';

-- ----------------------------
-- Records of go_user_money_record
-- ----------------------------

-- ----------------------------
-- Table structure for _user_recodes
-- ----------------------------
DROP TABLE IF EXISTS `####_user_recodes`;
CREATE TABLE `####_user_recodes` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) NOT NULL COMMENT '收取1//充值-2/提现-3',
  `content` varchar(255) NOT NULL COMMENT '详情',
  `shopid` int(11) DEFAULT NULL COMMENT '商品id',
  `money` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  `time` char(20) NOT NULL,
  `ygmoney` decimal(8,2) NOT NULL COMMENT '云购金额',
  `cashoutid` int(11) DEFAULT NULL COMMENT '申请提现记录表id',
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员佣金明细';

-- ----------------------------
-- Records of _user_recodes
-- ----------------------------
