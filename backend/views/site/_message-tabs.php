<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;

$tabItems = [];
foreach ( array_keys(Yii::$app->params['frontendLanguages']) as $language ) {
    $translation = $model->getTranslationFor($language)->translation;
    $emptyTranslationMark = (!isset($translation)||empty($translation)) ? '*' : '';

    $tabItems[] = [
        'label' => '<b>' . strtoupper($language) . "$emptyTranslationMark </b>",
        'content' => Html::textarea("Message[$language][translation]", $translation, [
            'id'    => "message-{$language}-translation",
            'class' => 'translation-textarea form-control',
            'rel'   => $language,
            'rows'  => 3,
        ]) . Html::hiddenInput("categories[$language]", $model->category),
        'active' => ($language == Yii::$app->language),
    ];
}
?>

<form method="POST" class="translation-save-form">
<?=
    Tabs::widget([
        'encodeLabels' => false,
        'items' => $tabItems,
    ])
?>
</form>