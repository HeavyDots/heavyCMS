<?php
namespace common\models\traits;

use Yii;

trait Translation{
    public function saveTranslations($translations){
        foreach ($translations as $translation) {
            $translation->save(false);
        }
    }

    public function initializeTranslations(){
        $translations = [];
        foreach (Yii::$app->params['frontendLanguages'] as $languageCode => $languageName) {
            $translation = $this->getTranslation($languageCode);
            if ($languageCode == Yii::$app->params['appMainLanguage']) {
                $translation->scenario = 'mainLanguage';
            }
            $translations[] = $translation;
        }
        return $translations;
    }
}
