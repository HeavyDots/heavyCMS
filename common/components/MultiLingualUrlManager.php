<?php
namespace common\components;

use Yii;
use yii\web\UrlManager;

class MultiLingualUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        $params['language'] = Yii::$app->language;
        //$params['language'] = 'es-ES';
        /*var_dump($params['language']);
        var_dump(parent::createUrl($params));*/
        return parent::createUrl($params);
    }
}