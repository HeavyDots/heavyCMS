<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\base\SourceMessage as BaseSourceMessage;
use common\models\traits\Translation;

/**
 * This is the model class for table "source_message".
 */
class SourceMessage extends BaseSourceMessage
{
    use Translation;

    public static function getAllCategoriesAsArray(){
        $categories = self::find()
                        ->select('category')
                        ->distinct()
                        ->orderBy(['category' => SORT_ASC])
                        ->all();
        $categoriesArray = ArrayHelper::map($categories, 'category', 'category');

        return $categoriesArray;
    }

    public static function getMessageTranslation($category, $message, $language){
        return TranslatedMessage::find()
            ->joinWith('sourceMessage')
            ->where(['source_message.category'=>$category])
            ->andWhere(['source_message.message'=>$message])
            ->andWhere(['language'=>$language])
            ->one();
    }
}
