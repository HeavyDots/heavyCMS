<?php
namespace common\components;

use Yii;
use yii\web\UrlManager;

class MultiLingualUrlManager extends UrlManager
{
    /* FIXME: If I'm on this page: http://admin.heavycms.dev/slider/update?id=3 when changing the language on the drop down, the URL is not correct, it lacks of ?id parameter */
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