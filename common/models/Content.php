<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \common\models\base\Content as BaseContent;

/**
 * This is the model class for table "content".
 */
class Content extends BaseContent
{
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

    public function saveTranslationsPOST($translationsPOST){
        foreach ($translationsPOST as $language => $fields) {
            foreach ($fields as $fieldName => $fieldValue) {
                $this->setLanguage($language);
                $this->{$fieldName} = $fieldValue;
                $this->saveTranslation();
            }
        }
    }
}
