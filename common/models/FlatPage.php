<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \common\models\base\FlatPage as BaseFlatPage;
use common\models\traits\Translation;

/**
 * This is the model class for table "flat_page".
 */
class FlatPage extends BaseFlatPage
{
    use Translation;

    public function behaviors()
    {
        $newBehaviors = [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            [
            'class' => BlameableBehavior::className(),
            ],
        ];
        return array_merge(parent::behaviors(), $newBehaviors);
    }

    public static function getMappedArray(){
        $models = self::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'url');
    }

    public function __toString(){
        return $this->url;
    }
}
