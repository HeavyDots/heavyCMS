<?php
namespace common\widgets;

use Yii;
use yii\helpers\Url;
use yii\base\Widget;

class LanguageDropdown extends Widget{

    public $supportedLanguages = [];
    public $activeClass = '';

    public function init(){
        parent::init();
    }

    public function run(){
        $currentLanguage = Yii::$app->language;
        foreach (Yii::$app->params['supportedLanguages'] as $localeId => $languageName) {
            $this->changeLanguageToCreateUrlWithUrlManager($localeId);
            $this->supportedLanguages[$localeId]['name'] = $languageName;
            $this->supportedLanguages[$localeId]['url'] = $this->generateURLToSelectedLanguage();
            $this->supportedLanguages[$localeId]['class'] = $this->getClass($localeId, $currentLanguage);
        }
        $this->returnToCurrentLanguage($currentLanguage);

        return $this->render('_language-dropdown', ['supportedLanguages'=>$this->supportedLanguages]);
    }

    private function changeLanguageToCreateUrlWithUrlManager($localeId){
        Yii::$app->language = $localeId;
    }

    private function returnToCurrentLanguage($currentLanguage){
        Yii::$app->language = $currentLanguage;
    }

    private function generateURLToSelectedLanguage(){
        $params = Yii::$app->request->queryParams;
        unset($params['language']);
        $route = array_merge([Yii::$app->controller->getRoute()], $params);
        return Url::toRoute($route);
    }

    private function getClass($localeId, $currentLanguage){
        return ($localeId == $currentLanguage) ? $this->activeClass : '';
    }
}
