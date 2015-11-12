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
        return Url::toRoute([$this->route]);
    }

    public function getRoute(){
        $url = ($this->url == 'blog') ? 'blog/index' : 'site/'.$this->url;
        return $url;
    }

    public function __toString(){
        return $this->url;
    }
}
