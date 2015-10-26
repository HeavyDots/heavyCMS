<?php
namespace common\models\traits;

trait Translation{
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
