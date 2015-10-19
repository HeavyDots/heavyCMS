<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use \backend\models\base\SourceMessage as BaseSourceMessage;

/**
 * This is the model class for table "source_message".
 */
class SourceMessage extends BaseSourceMessage
{

    public static function getAllCategoriesAsArray(){
        $categories = self::find()
                        ->select('category')
                        ->distinct()
                        ->orderBy(['category' => SORT_ASC])
                        ->all();
        $categoriesArray = ArrayHelper::map($categories, 'category', 'category');

        return $categoriesArray;
    }

    public function getTranslationFor($language){
        return $this->getTranslatedMessages()
                    ->andWhere(['language' => $language])
                    ->one();
    }

    /* Relations https://github.com/uran1980/yii2-translate-panel/blob/master/models/SourceMessage.php */

    public function initTranslatedMessages()
    {
        $translatedMessages = [];
        foreach (array_keys(Yii::$app->params['frontendLanguages']) as $language) {
            $translation = $this->getTranslationFor($language);
            if (!isset($translation)) {
                $translatedMessage             = new TranslatedMessage;
                $translatedMessage->language   = $language;
                $translatedMessages[$language] = $translatedMessage;
            } else {
                $translatedMessages[$language] = $translation;
            }
        }
        $this->populateRelation('translatedMessages', $translatedMessages);
    }

    public function saveTranslatedMessages()
    {
        foreach ($this->translatedMessages as $translatedMessage) {
            $this->link('translatedMessages', $translatedMessage);
            $translatedMessage->save();
        }
    }
}
