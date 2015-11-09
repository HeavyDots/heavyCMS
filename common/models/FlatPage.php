<?php

namespace common\models;

use Yii;
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

    public function __toString(){
        return $this->url;
    }
}
