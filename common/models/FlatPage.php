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

    /*TODO: remove double slash i.e.: http://heavycms.dev//site/contact*/
    public function getFullUrl(){
        return Yii::$app->params['frontendURL'] . $this->getUrl();
    }

    public function getUrl(){
        return Url::toRoute($this->route);
    }

    public function getRoute(){
        $url = ($this->url == 'blog') ? ['blog/index'] : ['site/'.$this->url];
        return $url;
    }

    public function __toString(){
        return $this->url;
    }
}
