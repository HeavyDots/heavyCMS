<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \common\models\base\Content as BaseContent;
use common\models\traits\Translation;

/**
 * This is the model class for table "content".
 */
class Content extends BaseContent
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
}
