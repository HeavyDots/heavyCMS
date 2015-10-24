<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \common\models\base\FlatPageLang as BaseFlatPageLang;

/**
 * This is the model class for table "flat_page_lang".
 */
class FlatPageLang extends BaseFlatPageLang
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            [
            'class' => BlameableBehavior::className(),
            ],
        ];
    }
}
