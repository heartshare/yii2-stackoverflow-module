<?php

namespace shamanzpua\module;

class Stackoverflow extends \yii\base\Module
{
    private $apiKey;
    
    public function setApiKey($value)
    {
        $this->apiKey = $value;
    }
   
    public function getApiKey()
    {
        return $this->apiKey;
    }


    public function init()
    {
        parent::init();
        if ($this->getApiKey() === null) {
            throw new \yii\base\InvalidConfigException('Module configuration failed. Api key is not set');
        }
        $config = require(__DIR__ . '/config.php');
        $config['components']['stackexchange']['apiKey'] = $this->getApiKey();
        \Yii::configure($this, $config);
    }
}
