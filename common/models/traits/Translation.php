<?php
namespace common\models\traits;

use Yii;

trait Translation{
    public function saveTranslations($translations){
        foreach ($translations as $translation) {
            if ($translation->isNewRecord) {
                $translation->{key($this->getObjectRelation()->link)} = $this->getPrimaryKey();
            }
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

    private function getObjectRelation(){
        return $this->getRelation($this->getRelationName());
    }

    private function getRelationName(){
        return $this->getBehavior('translatable')->relation;
    }

}
