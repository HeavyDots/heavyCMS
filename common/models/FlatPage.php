<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\base\FlatPage as BaseFlatPage;
use common\models\traits\Translation;

/**
 * This is the model class for table "flat_page".
 */
class FlatPage extends BaseFlatPage
{
    use Translation;

    public static function getMappedArray(){
        $models = self::find()->all();
        return ArrayHelper::map($models, 'id', 'title');
    }

    public static function getUrlFor($flatPageUrl){
        $flatPage = FlatPage::findOne(['url' => $flatPageUrl]);
        return isset($flatPage) ? $flatPage->getUrl() : '#';
    }

    public static function findBySlugFallback($slug, $currentLanguage = null) {
        $currentLanguage = isset($currentLanguage) ? $currentLanguage : Yii::$app->language;
        $flatPageCurrentLanguage = self::findBySlug($slug, $currentLanguage);
        if (isset($flatPageCurrentLanguage)) {
            return $flatPageCurrentLanguage;
        }

        $flatPageFallbackLanguage = self::findBySlug($slug, Yii::$app->params['fallbackLanguage']);
        if (isset($flatPageFallbackLanguage)&&!$flatPageFallbackLanguage->modelHasTranslation($currentLanguage, 'slug')) {
            return $flatPageFallbackLanguage;
        }

        $flatPageMainLanguage = self::findBySlug($slug, Yii::$app->params['appMainLanguage']);
        if (isset($flatPageMainLanguage)
            &&!$flatPageMainLanguage->modelHasTranslation($currentLanguage, 'slug')
            &&!$flatPageMainLanguage->modelHasTranslation(Yii::$app->params['fallbackLanguage'], 'slug')
        ) {
            return $flatPageMainLanguage;
        }

        return null;
    }

    public static function findBySlug($slug, $language = null){
        $language = isset($language) ? $language : Yii::$app->language;
        return self::find()
            ->joinWith('translations')
            ->where(['flat_page_lang.slug'=>$slug])
            ->andWhere(['flat_page_lang.language'=>$language])
            ->one();
    }

    public function matchRequestedRoute(){
        $requestedRouteCanBeFoundInThisFlatPage = Yii::$app->requestedRoute == $this->route;
        if (Yii::$app->controller->id=='blog'&&$this->url=='blog') {
            $requestedRouteCanBeFoundInThisFlatPage = true;
        }
        return $requestedRouteCanBeFoundInThisFlatPage;
    }

    public function getFullUrl(){
        return substr(Yii::$app->params['frontendURL'], 0, -1) . Yii::$app->urlManagerFrontend->createUrl($this->getRoute());
    }

    public function getUrl(){
        return Url::toRoute($this->getRoute());
    }

    public function getRoute(){
        $route = ['flat-page/select', 'slug' => $this->slug];
        if ($this->url == 'blog') {
            $route = ['blog/index'];
        }
        elseif ($this->url == 'index') {
            $route = ['site/index'];
        }
        return $route;
    }

    public function __toString(){
        return $this->url;
    }
}
