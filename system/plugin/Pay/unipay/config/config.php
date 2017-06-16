<?php
class Config{
    private $cfg = array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'102551501051',
        'key'=>'fc01c573641bc228b030f4ddefd5c621',
        'version'=>'1.0',
        'appid' => 'wxdd992cf078094dbf',
        'appsecret' => '1cec390c874a97c1c12d777dde2d1456',
    );
    
    public function C($cfgName){
        return $this->cfg[$cfgName];
    }
}
?>