<?php
/* TODO: Convert Html form "translation-save-form" to Yii Form */
/* TODO: Use LanguageTabs Widget */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Tabs;

$tabItems = [];
foreach ( array_keys(Yii::$app->params['frontendLanguages']) as $language ) {
    $translatedMessage = $model->getTranslationFor($language);
    $translation = isset($translatedMessage) ? $translatedMessage->translation : '';
    $emptyTranslationMark = empty($translation) ? '*' : '';

    $tabItems[] = [
        'label' => '<b>' . strtoupper($language) . "$emptyTranslationMark </b>",
        'content' => Html::textarea("TranslatedMessage[$language][translation]", $translation, [
            'id'    => "message-{$language}-translation",
            'class' => 'translation-textarea form-control',
            'rel'   => $language,
            'rows'  => 3,
        ]) . Html::hiddenInput("categories[$language]", $model->category),
        'active' => ($language == Yii::$app->language),
    ];
}

$formAction = Url::toRoute(['site/save-translation', 'id'=>$key]);
$csrf = yii::$app->request->csrfParam;
?>

<form method="POST" class="translation-save-form" action="<?= $formAction ?>">
    <?=
        Tabs::widget([
            'encodeLabels' => false,
            'items' => $tabItems,
        ])
    ?>
    <input type="hidden" name="_csrf" value="<?= $csrf ?>">
</form>