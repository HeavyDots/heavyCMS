<?php

namespace common\components;

use Yii;
use yii\i18n\MissingTranslationEvent;
use backend\models\SourceMessage;


class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        $fallbackTranslation = SourceMessage::getMessageTranslation($event->category, $event->message, Yii::$app->params['fallbackLanguage']);
        if (isset($fallbackLanguage)&&!empty($fallbackLanguage->translation)) {
            return $event->translatedMessage = $fallbackLanguage->translation;
        }

        $mainLanguageTranslation = SourceMessage::getMessageTranslation($event->category, $event->message, Yii::$app->params['appMainLanguage']);
        if (isset($mainLanguageTranslation)&&!empty($mainLanguageTranslation->translation)) {
            return $event->translatedMessage = $mainLanguageTranslation->translation;
        }
    }

}