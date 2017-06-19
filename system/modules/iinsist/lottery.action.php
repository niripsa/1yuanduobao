<?php
defined("G_IN_SYSTEM") || exit("no");
System::load_app_class("admin", G_ADMIN_DIR, "no");
class lottery extends admin{
    public function kj_record(){
        //status=2 代表已开奖 status = 1代表还未开奖
        $sql = "select * from `@#_lottery_stage` where `status` in (1,2) order by `end_time` desc limit 500";
        $mysql_model = System::load_sys_class("model");
        $aLotteryLists = $mysql_model->GetList($sql);
        
        $this->view->data('lottery_lists', $aLotteryLists);
        $this->view->show("user.lottery_kj_record_admin");
    }

    public function modify_lottery_no(){
        $iNumber = intval($_POST['number']);
        if($iNumber < 0 || $iNumber > 9){
            exit;
        }

        $sql =  "select * from `@#_lottery_stage` where `status` in (1) order by `end_time` desc limit 1";
        $mysql_model = System::load_sys_class("model");
        $aLotteryInfo = $mysql_model->GetOne($sql);
        if(empty($aLotteryInfo) || time() >= strtotime($aLotteryInfo['end_time']) + 3){
            exit();
        }

        $sNow = date("Y-m-d H:i:s");
        $id = intval($aLotteryInfo['id']);
        $sql = "update `@#_lottery_stage` set setting_number = $iNumber, setting_time = '$sNow' where id = $id";
        $mysql_model->Query($sql);

        $aRet = [];
        $aRet['errno'] = 0;
        exit(json_encode($aRet));
    }

    public function buy_record(){

    }
}
?>
