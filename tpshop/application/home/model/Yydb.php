<?php
namespace app\home\model;

use think\Model;
use think\Db;

class Yydb extends Model{
    const SECRET = "TPSHOP#@198712%adsadjfasadfsadf#$%@12";
    private function _rpcGetInfo($sUrl, $aPostInfo = array()){
        $ch = curl_init($sUrl);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_ENCODING , "gzip");

        if(!empty($aPostInfo)){
            $sSign = md5(self::SECRET . $aPostInfo['user_id']);
            $aPostInfo['sign'] = $sSign;
            curl_setopt( $ch, CURLOPT_POST, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $aPostInfo );
        }
        
        $output = curl_exec( $ch );
        curl_close( $ch );

        return json_decode($output, TRUE);
    }

    public function getCateInfo(){
        return $this->_rpcGetInfo("http://" . $_SERVER['HTTP_HOST'] . "/index.php/?/member/tpshop/get_cate_info");
    }

    public function getUserInfo($user_id){
        $sign = md5(self::SECRET .$user_id);
        $aRet = $this->_rpcGetInfo("http://" . $_SERVER['HTTP_HOST'] . "/index.php/?/member/tpshop/get_user_info&sign=$sign&uid=$user_id");

        $aRet['name'] = $aRet["username"];
        $aRet['url']  = WEB_PATH . "/member/home/userindex"; 
        return $aRet;
    }

    public function payByMoneyAndPoints($need_points, $need_money, $user_id){
        if(empty($need_points) && empty($need_money)){
            return false;
        }

        $aPostInfo = array();
        $aPostInfo['need_points'] = $need_points;
        $aPostInfo['need_money']  = $need_money;
        $aPostInfo['user_id']     = $user_id;

        $aRet = $this->_rpcGetInfo("http://" . $_SERVER['HTTP_HOST'] . "/index.php/?/member/tpshop/payby_money_points", $aPostInfo);


        if(isset($aRet['errno']) && empty($aRet['errno'])){
            return true;
        }

        return false;
    }
}