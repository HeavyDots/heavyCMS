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
        $translations = $this->translations;
        if (!isset($translations)||empty($translations)) {
            $translations = [];
            foreach (Yii::$app->params['frontendLanguages'] as $languageCode => $languageName) {
                $langClass = $this->getLangFullyQualifiedClassName();
                $translation = new $langClass();
                if ($languageCode == Yii::$app->params['appDefaultLanguage']) {
                    $translation->scenario = 'mainLanguage';
                }
                $translation->{key($this->getObjectRelation()->link)} = $this->getPrimaryKey();
                $translation->language = $languageCode;
                $translations[] = $translation;
            }
        }
        return $translations;
    }

    private function getLangClassName(){
        $fullyQualifiedClassName = $this->getLangFullyQualifiedClassName();
        $fQCNArray = explode('\\', $fullyQualifiedClassName);
        return array_pop($fQCNArray);
    }

    private function getLangFullyQualifiedClassName(){
        return $this->getObjectRelation()->modelClass;
    }

    private function getObjectRelation(){
        return $this->getRelation($this->getRelationName());
    }

    private function getRelationName(){
        return $this->getBehavior('translatable')->relation;
    }
}
