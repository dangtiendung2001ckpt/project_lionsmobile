<?php


namespace Config;


class Config
{
    public function getConfig($key){
        return array_get($this->_setConfigs(),$key);
    }

    protected function _setConfigs(){
        $array = ['limit'=>6,'ord'=>'DESC'];
        return $array;
}

}