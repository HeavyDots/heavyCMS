<?php
/* TODO: Make Yii Form for translation-save-form */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Tabs;

$tabItems = [];
foreach ( array_keys(Yii::$app->params['frontendLanguages']) as $language ) {
    $translation = $model->getTranslationFor($language)->translation;
    $emptyTranslationMark = (!isset($translation)||empty($translation)) ? '*' : '';

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