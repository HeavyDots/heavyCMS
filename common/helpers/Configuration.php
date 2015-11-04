<?php
namespace common\helpers;

use common\models\GlobalConfiguration;

class Configuration{
    public static function get($configurationSlug){
        $configuration = GlobalConfiguration::find()
                        ->where(['slug'=>$configurationSlug])
                        ->one();

        return isset($configuration) ? $configuration->value : '';
    }
}
