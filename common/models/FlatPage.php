<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \common\models\base\FlatPage as BaseFlatPage;

/**
 * This is the model class for table "flat_page".
 */
class FlatPage extends BaseFlatPage
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

    public static function getMappedArray(){
        $models = self::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'name');
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

    public function __toString(){
        return $this->name;
    }
}
