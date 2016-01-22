<?php
namespace common\widgets;

use Yii;
use yii\helpers\Url;
use yii\base\Widget;

use common\models\FlatPage;
use common\models\BlogPost;
use common\models\BlogCategory;

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
        $controllerName = Yii::$app->controller->getUniqueId();
        unset($params['language']);
        $routeYii = Yii::$app->controller->getRoute();
        $route = array_merge([$routeYii], $params);
        /*TODO: Refactor this code, it's not semantic an it's messy */
        if ($routeYii=='blog/view') {
            $blogPost = BlogPost::findBySlug($params['slug'], $currentLanguage);
            $params['slug'] = $blogPost->slug;
            if (BlogPost::findBySlug($params['slug'], Yii::$app->language)===null) {
                $routeYii = 'blog/index';
                $params = [];
            }
            $route = array_merge([$routeYii], $params);
        }
        elseif ($routeYii=='blog/category-index'){
            $blogCategory = BlogCategory::findBySlug($params['slug']);
            $blogCategory->setLanguage(Yii::$app->language);
            $params['slug'] = $blogCategory->slug;
            $route = array_merge([$routeYii], $params);
        }
        elseif ($controllerName=='flat-page'&&Yii::$app->id=='app-frontend'){
            $flatPage = FlatPage::findBySlugFallback($params['slug'], $currentLanguage);
            if (isset($flatPage)) {
                $params['slug'] = $flatPage->slug;
            }
            else{
                $params = [];
                $routeYii = 'site/index';
            }
            $route = array_merge([$routeYii], $params);
        }
        elseif ($routeYii=='site/error'){
            $routeYii = 'site/index';
            $params = [];
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
