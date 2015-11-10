<?php
namespace common\widgets;

use Yii;
use yii\helpers\Url;
use yii\base\Widget;

use common\models\BlogPost;

class LanguageDropdown extends Widget{

    public $supportedLanguages = [];
    public $activeClass = '';
    public $selectedLanguage = [];

    public function init(){
        parent::init();
    }

    public function run(){
        $currentLanguage = Yii::$app->language;
        foreach (Yii::$app->params['supportedLanguages'] as $localeId => $languageName) {
            $this->changeLanguageToCreateUrlWithUrlManager($localeId);
            $this->supportedLanguages[$localeId]['name'] = $languageName;
            $this->supportedLanguages[$localeId]['url'] = $this->generateURLForSelectedLanguage($currentLanguage);
            $this->supportedLanguages[$localeId]['class'] = $this->getClass($localeId, $currentLanguage);
            $this->setSelectedLanguage($localeId, $currentLanguage);
        }
        $this->returnToCurrentLanguage($currentLanguage);

        return $this->render('_language-dropdown', ['supportedLanguages'=>$this->supportedLanguages,
                                                    'selectedLanguage'=>$this->selectedLanguage]);
    }

    private function changeLanguageToCreateUrlWithUrlManager($localeId){
        Yii::$app->language = $localeId;
    }

    private function returnToCurrentLanguage($currentLanguage){
        Yii::$app->language = $currentLanguage;
    }

    private function generateURLForSelectedLanguage($currentLanguage){
        $params = Yii::$app->request->queryParams;
        unset($params['language']);
        $routeYii = Yii::$app->controller->getRoute();
        $route = array_merge([$routeYii], $params);
        /*TODO: Refactor this code, it's not semantic */
        if ($routeYii=='blog/view') {
            $blogPost = BlogPost::findBySlug($params['slug'], $currentLanguage);
            $params['slug'] = $blogPost->slug;
            if (BlogPost::findBySlug($params['slug'], Yii::$app->language)===null) {
                $routeYii = 'blog/index';
                $params = [];
            }
            $route = array_merge([$routeYii], $params);
        }
        return Url::toRoute($route);
    }

    private function getClass($localeId, $currentLanguage){
        return $this->isSelectedLanguage($localeId, $currentLanguage) ? $this->activeClass : null;
    }

    private function isSelectedLanguage($localeId, $currentLanguage){
        return ($localeId == $currentLanguage);
    }

    private function setSelectedLanguage($localeId, $currentLanguage){
        if ($this->isSelectedLanguage($localeId, $currentLanguage)) {
            $this->selectedLanguage = $this->supportedLanguages[$localeId];
        }
    }
}
