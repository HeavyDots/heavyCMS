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

    public static function findBySlug($slug, $language = null){
        $language = isset($language) ? $language : Yii::$app->language;
        return self::find()
            ->joinWith('translations')
            ->where(['flat_page_lang.slug'=>$slug])
            ->andWhere(['flat_page_lang.language'=>$language])
            ->one();
    }

    /* TODO: Enhance the algo, and refactor */
    public static function findBySlugFallback($slug, $language = null){
        $language = isset($language) ? $language : Yii::$app->language;
        $flatPageCurrentLanguage = self::find()
                ->joinWith('translations')
                ->where(['flat_page_lang.slug'=>$slug])
                ->andWhere(['flat_page_lang.language'=>$language])
                ->one();
        $flatPage = $flatPageCurrentLanguage;

        /*Fallback language*/
        if (!isset($flatPage)){
            $flatPage = FlatPage::find()
                ->joinWith('translations')
                ->where(['flat_page_lang.slug'=>$slug])
                ->andWhere(['flat_page_lang.language'=>Yii::$app->params['fallbackLanguage']])
                ->one();
        }

        /*Main language*/
        if (!isset($flatPage)){
            $flatPage = FlatPage::find()
                ->joinWith('translations')
                ->where(['flat_page_lang.slug'=>$slug])
                ->andWhere(['flat_page_lang.language'=>Yii::$app->params['appMainLanguage']])
                ->one();
        }

        return $flatPage;
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
