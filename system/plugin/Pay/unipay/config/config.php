<?php
class Config{
    private $cfg = array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'102551501051',
        'key'=>'fc01c573641bc228b030f4ddefd5c621',
        'version'=>'1.0'
    );
    
    public function C($cfgName){
        return $this->cfg[$cfgName];
    }
}
?>