<?php
namespace common\widgets;

use Yii;
use yii\helpers\Url;
use yii\base\Widget;

class LanguageDropdown extends Widget{

    public $supportedLanguages = [];

    public function init(){
        parent::init();
    }

    public function run(){
        $currentLanguage = Yii::$app->language;
        foreach (Yii::$app->params['supportedLanguages'] as $localeId => $languageName) {
            $this->changeLanguageToCreateUrlWithUrlManager($localeId);
            $this->supportedLanguages[$localeId]['name'] = $languageName;
            $this->supportedLanguages[$localeId]['url'] = Url::toRoute(Yii::$app->controller->getRoute());
        }
        Yii::$app->language = $currentLanguage;
        return $this->render('_language-dropdown', ['supportedLanguages'=>$this->supportedLanguages]);
    }

    private function changeLanguageToCreateUrlWithUrlManager($localeId){
        Yii::$app->language = $localeId;
    }
}
