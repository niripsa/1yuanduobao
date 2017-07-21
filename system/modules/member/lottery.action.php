<?php
System::load_app_class("UserAction", "common", "no");
class lottery extends UserAction{
	public function lottery_index(){
		$mysql_model = System::load_sys_class("model");
		$sStartTime = date('Y-m-d H:i:s');
		$sEndTime = $sStartTime;
		$sql = "select * from `@#_lottery_stage` where `begin_time` <= '${sStartTime}' AND `end_time` >= '{$sEndTime}' AND `status` = 1 order by stage_no desc limit 1";
		$aLotteryInfo = $mysql_model->GetOne($sql);
		$iDiffTime = strtotime($aLotteryInfo['end_time']) - time();

		//取上一次开奖信息
		$sql = "select * from `@#_lottery_stage` where `end_time` < '{$sStartTime}' AND `status` = 2 order by `begin_time` desc limit 1";
		$aLastLotteryInfo = $mysql_model->GetOne($sql);
		//如果setting_number存在 则采用setting_number
		$last_lottery_no = $aLastLotteryInfo['setting_number'] >=0 ? $aLastLotteryInfo['setting_number'] : $aLastLotteryInfo['lottery_number'];

		//取最近三次的开奖信息
		$sql = "select * from `@#_user_buy_lottery` where `user_id` = $this->Userid AND `status` > 0 order by `buy_time` desc limit 3";
		$aBuyLists = $mysql_model->GetList($sql);
		foreach ($aBuyLists as &$aBuyRecord) {
			if($aBuyRecord['status'] == 1){
				$aBuyRecord['cancel_url'] = "/?/member/lottery/cancel_order&order_id=". $aBuyRecord['order_sn'];
			}
		}

		$this->view->data('action_no', $aLotteryInfo['stage_no']);
		$this->view->data('last_action_no', $aLastLotteryInfo['stage_no']);
		$this->view->data('last_lottery_no', $last_lottery_no);
		$this->view->data('diffTime', $iDiffTime);
		$this->view->data('user_money', $this->UserInfo['money']);
		$this->view->data('user_points', $this->UserInfo['user_points']);
		$this->view->data('buy_lists', $aBuyLists);
		$this->view->show("user.lottery_index");
	}

	public function buy_lottery(){
		//buy1代表是单双 buy2代表是大小 multiple代表注数 buy_number代表购买的数字 use_points代表是否使用积分
		$buy1 = (intval($_POST['buy1']) >= 1 ? intval($_POST['buy1']): 0);
		$buy2 = (intval($_POST['buy2']) >= 1 ? intval($_POST['buy2']): 0);
		$multiple = (intval($_POST['multiple']) > 0 ? intval($_POST['multiple']): 1);
		$buy_number = ($_POST['buy_number'] >= 0 ? intval($_POST['buy_number']) : -1);
		$use_points = (intval($_POST['use_points']) == 1 ? 1 : 0);

		list($iNeedMoney, $buy_content) = $this->_calculate_lottery_info($buy1, $buy2, $buy_number, $multiple);

		if ($iNeedMoney == -1) {
			$aRet['errno'] = 3;
			$aRet['errmsg'] = $buy_content;
			exit(json_encode($aRet));
		}

		$mysql_model = System::load_sys_class("model");

		//查看当前时间是否满足本期彩票时间 最后5s内不让购买
		$sStartTime = date('Y-m-d H:i:s');
		$sEndTime = date('Y-m-d H:i:s', time()+5);
		$sql = "select `stage_no` from `@#_lottery_stage` where `begin_time` <= '${sStartTime}' AND `end_time` >= '{$sEndTime}' AND `status` = 1 order by stage_no desc limit 1";
		$aLotteryInfo = $mysql_model->GetOne($sql);

		$aRet = [];
		if(empty($aLotteryInfo['stage_no'])){
			$aRet['errno']  = 1;
			$aRet['errmsg'] = '还没有产生彩票数据';
			exit(json_encode($aRet));
		}

		if(!empty($this->Userid)){
			if ($use_points == 0) {
				$sql = "update `@#_user` set `money` = `money` - ${iNeedMoney} where `uid` = $this->Userid AND `money` >= ${iNeedMoney}";
				$mysql_model->Query($sql);
			}elseif ($use_points == 1) {
				$sql = "update `@#_user` set `user_points` = `user_points` - ${iNeedMoney} where `uid` = $this->Userid AND `user_points` >= ${iNeedMoney}";
				$mysql_model->Query($sql);
			}
		}

		$iAffectedRows = intval($mysql_model->affected_rows());

		if(empty($iAffectedRows)){
			$aRet['errno']  = 2;
			$aRet['errmsg'] = ($use_points == 1 ? "积分不足请充值" : "余额不足请充值");
			exit(json_encode($aRet));
		}

		//如果是使用积分,则存入yg_user_points积分明细表
		if ($use_points == 1) {
			$aData = [];
			$aData['uid'] 	  = $this->Userid;
			$aData['type'] 	  = -1;
			$aData['reason']  = 2;
			$aData['content'] = strval($aLotteryInfo['stage_no']);
			$aData['points']  = intval($iNeedMoney);
			$aData['time'] 	  = time();
			$mysql_model->Insert('user_points', $aData);
		}

		//走到此处说明购买成功了
		$aData = array();
		$aData['order_sn'] = $this->_generateOrderSN();
		$aData['buy_time'] = date('Y-m-d H:i:s');
		$aData['user_id']  = $this->Userid;
		$aData['stage_no'] = strval($aLotteryInfo['stage_no']);
		$aData['buy_content_id'] = $buy1 . $buy2;
		$aData['buy_content']    = $buy_content;
		$aData['buy_number']	 = $buy_number;
		$aData['buy_money']  = $iNeedMoney;
		$aData['use_points'] = $use_points;
		$aData['status']     = 1;

		$mysql_model->Insert('user_buy_lottery', $aData);
		$aRet['errno'] = 0;
		$aRet['errmsg'] = '';
		$aRet['data'] = $aData;
		echo json_encode($aRet);
	}

	//取消订单
	public function cancel_order(){
		$aRet['errno'] = 1;
		$aRet['errmsg'] = '撤单功能已取消';
		exit(json_encode($aRet));

		$sOrderSN = $_POST['order_sn'];
		$aRet = array();
		if(!preg_match("#\d+#", $sOrderSN)){
			$aRet['errno'] = 1;
			$aRet['errmsg'] = '订单id不合理';
			exit(json_encode($aRet));
		}

		$mysql_model = System::load_sys_class("model");

		//准备撤销订单 第一将订单状态置为撤销状态
		$sql = "select * from `@#_user_buy_lottery` where order_sn = '$sOrderSN' AND `user_id` = $this->Userid AND `status` = 1";
		$aBuyInfo = $mysql_model->GetOne($sql);

		$sNow = date('Y-m-d H:i:s');
		$sql = "update `@#_user_buy_lottery` set `status`=2,`cancel_time` = '$sNow' where order_sn = '$sOrderSN' AND `user_id` = $this->Userid AND `status` = 1";

		$mysql_model->Query($sql);
		$iAffectedRows = intval($mysql_model->affected_rows());
		if(empty($aBuyInfo) || empty($iAffectedRows)){
			$aRet['errno'] = 2;
			$aRet['errmsg'] = '订单信息不存在';
			exit(json_encode($aRet));
		}

		//将用户的余额补回来
		$fBuyMoney = $aBuyInfo['buy_money'];
		$sql = "update `@#_user` set money = money + ${fBuyMoney} where `uid` = $this->Userid";

		$mysql_model->Query($sql);

		$aRet['errno'] = 0;
		$aRet['errmsg'] = '';
		echo json_encode($aRet);
	}

	//查看所有购买记录
	public function buy_record(){
		$sql = "select * from `@#_user_buy_lottery` where `user_id` = $this->Userid AND `status` > 0 order by `buy_time` desc limit 100";
		$mysql_model = System::load_sys_class("model");
		$aBuyLists = $mysql_model->GetList($sql);

		//撤单功能已取消
		/*foreach ($aBuyLists as &$aBuyRecord) {
			if($aBuyRecord['status'] == 1){
				$aBuyRecord['cancel_url'] = "/?/member/lottery/cancel_order&order_id=".$aBuyRecord['order_sn'];
			}
		}*/

		$this->view->data('buy_lists', $aBuyLists);
		$this->view->show("user.lottery_record");
	}

	//查看所有积分记录
	public function points_record(){
		$sql = "select * from `@#_user_points` where `uid` = {$this->Userid} order by `time` desc limit 100";		
		$mysql_model = System::load_sys_class("model");
		$aPointsLists = $mysql_model->GetList($sql);

		foreach ($aPointsLists as &$aPointsRecord) {
			$aPointsRecord['time'] = date("Y-m-d H:i:s", $aPointsRecord['time']);

			$aPointsRecord['points'] = ($aPointsRecord['type'] == 1 ? "+" : "-") . $aPointsRecord['points'];

			switch ($aPointsRecord['reason']) {
				case 1:
					$aPointsRecord['reason'] = "管理员改动";
					break;
				case 2:
					$aPointsRecord['reason'] = "购买彩票";
					break;
				case 3:
					$aPointsRecord['reason'] = "彩票积分返利";
					break;					
				case 4:
					$aPointsRecord['reason'] = "积分商城";
					break;
			}
		}

		$this->view->data('points_lists', $aPointsLists);
		$this->view->show("user.points_record");		
	}

	//开奖记录
	public function lottery_record(){
		//status=2 代表已开奖
		$sql = "select * from `@#_lottery_stage` where `status` = 2 order by `end_time` desc limit 500";
		$mysql_model = System::load_sys_class("model");
		$aLotteryLists = $mysql_model->GetList($sql);

		foreach ($aLotteryLists as &$aLotteryRecord) {
			$aLotteryRecord['lottery_number'] = $aLotteryRecord['setting_number'] >=0 ? $aLotteryRecord['setting_number'] : $aLotteryRecord['lottery_number'];
			unset($aLotteryRecord['setting_number']);

			$aLotteryRecord['lottery_txt'] = '';
			if($aLotteryRecord['lottery_number']%2==1){
				$aLotteryRecord['lottery_txt'] .= '单';
			}elseif($aLotteryRecord['lottery_number']%2==0){
				$aLotteryRecord['lottery_txt'] .= '双';
			}

			if($aLotteryRecord['lottery_number']>=0
				&&$aLotteryRecord['lottery_number']<=4){
				$aLotteryRecord['lottery_txt'] .= '小';
			}elseif($aLotteryRecord['lottery_number']>=5&&$aLotteryRecord['lottery_number']<=9){
				$aLotteryRecord['lottery_txt'] .= '大';
			}
		}

		$this->view->data('lottery_lists', $aLotteryLists);
		$this->view->show("user.lottery_kj_record");
	}

	//获取中奖名单
	public function get_lucky_list(){
		$sql = "select * from `@#_user_buy_lottery` where `status` = 3 and `award_points` != '0.00' order by `buy_time` desc limit 50";
		$mysql_model = System::load_sys_class("model");
		$aLuckyList = $mysql_model->GetList($sql);

		foreach ($aLuckyList as &$value) {
			$uid = $value['user_id'];
			$sql = "select username,img from `@#_user` where `uid` = {$uid} limit 1";
			$sUsername = $mysql_model->GetOne($sql);
			$value['username'] = $sUsername['username'];
			$value['img'] = $sUsername['img'];
		}

		if (!empty($aLuckyList)) {
			echo json_encode($aLuckyList, JSON_UNESCAPED_UNICODE);
		}else{
			$aRet = [];
			$aRet['errno'] = 1;
			$aRet['errmsg'] = "暂时无法获取到数据，请稍候";
			echo json_encode($aRet, JSON_UNESCAPED_UNICODE);
		}

		exit();
	}

	//得到最新开奖数据
	public function get_lastkj_data(){
		//判断当前一期是否到开奖时间
		$sStageNo = strval($_POST['stage_no']);
		if (empty($sStageNo)) {
			exit();
		}

		//查询当前期号是否开奖
		$sql = "select * from `@#_lottery_stage` where `stage_no` = '$sStageNo' and `status` = 2 limit 1";
		$mysql_model = System::load_sys_class("model");
		$aKjData = $mysql_model->GetOne($sql);
		if(empty($aKjData)){
			exit();
		}

		$aRet = [];
		$aRet['errno']  = 0;
		$aRet['errmsg'] = '开奖成功！';
		exit(json_encode($aRet));
	}

	private function _generateOrderSN(){
		$member_id = $this->Userid;
		return mt_rand(10,99)
		      . sprintf('%010d',time() - 946656000)
		      . sprintf('%03d', (float) microtime() * 1000)
		      . sprintf('%03d', (int) $member_id % 1000);
	}

	//根据传入的信息计算购买的总金额与购买彩票的内容
	private function _calculate_lottery_info($buy1, $buy2, $buy_number, $multiple){

		$iNeedMoney = 0;
		$buy_content = '';
		//彩票数字与单双大小可以同时购买

		//购买数字，并判断传入是否合法
		if (array_search($buy_number, [-1,0,1,2,3,4,5,6,7,8,9]) !== false) {
			if ($buy_number != -1) {
				$iNeedMoney += (2 * $multiple);
				$buy_content .= ($buy_number . ' ');
			}
		}else{
			$iNeedMoney = -1;
			$buy_content = "传入数字不合法!";
			return array($iNeedMoney, $buy_content);
		}

		//购买单双大小
		//判断传入是否合法
		if ($buy1 < 0 || $buy1 > 2 || $buy2 < 0 || $buy2 > 2) {
			$iNeedMoney = -1;
			$buy_content = "传入数字不合法!";
			return array($iNeedMoney, $buy_content);
		}

		//$buy1 = 1 单,   $buy1 = 2 双
		if ($buy1 != 0 ) {
			$iNeedMoney += (2 * $multiple);
			$buy_content .= ($buy1 == 1 ? "单" : "双");
		}
		//$buy2 = 1 大,   $buy2 = 2 小
		if ($buy2 != 0) {
			$iNeedMoney += (2 * $multiple);
			$buy_content .= ($buy1 == 1 ? "大" : "小");
		}

		if ($iNeedMoney == 0) {
			$iNeedMoney = -1;
			$buy_content = "请选择购买的内容";
		}

		return array($iNeedMoney, $buy_content);
		
	}
}
