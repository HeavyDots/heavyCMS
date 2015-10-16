<?php
namespace common\components;

use Yii;
use yii\web\UrlManager;

class MultiLingualUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if ($this->selectedLanguageIsNotTheDefalutLanguage()
            && $this->isSelectedLanguageSupported())
        {
            $params['language'] = Yii::$app->language;
        }
        return parent::createUrl($params);
    }

    private function selectedLanguageIsNotTheDefalutLanguage(){
        return Yii::$app->language!=Yii::$app->params['appDefaultLanguage'];
    }

    private function isSelectedLanguageSupported(){
        return in_array(Yii::$app->language, array_keys(Yii::$app->params['supportedLanguages']));
    }
}